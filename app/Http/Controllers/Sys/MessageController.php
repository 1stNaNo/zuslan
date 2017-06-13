<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysClient;
use App\Models\Sys\Views\Vw_sys_thr_user;
use App\Models\Sys\Views\Vw_sys_message_users;
use App\Models\Sys\SysThrMessageUser;
use App\Models\Sys\SysThreadMessage;
use App\Models\Sys\SysMessage;
use App\Models\Views\Vw_users;
use App\Events\MessagePosted;
use Datatables;
use Validator;

class MessageController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(Request $request){

    $user_id = \Auth::user()->user_id;
    $thread_id = 0;

    if(!empty($request->reciever_id)){

        $idKey = '';

        if($request->reciever_id < $user_id){
          $idKey = $request->reciever_id.",".$user_id;
        }else if($request->reciever_id > $user_id){
          $idKey = $user_id.",".$request->reciever_id;
        }

        $thread = Vw_sys_thr_user::where('user_ids',$idKey)->first();

        if(count($thread) == 0){
          $thread = new SysThreadMessage;
          $thread->created_at = \DB::raw('NOW()');
          $thread->updated_at = \DB::raw('NOW()');
          $thread->save();

          $thread_msg = new SysThrMessageUser;
          $thread_msg->thread_id = $thread->id;
          $thread_msg->user_id = $request->reciever_id;
          $thread_msg->save();

          $thread_msg = new SysThrMessageUser;
          $thread_msg->thread_id = $thread->id;
          $thread_msg->user_id = $user_id;
          $thread_msg->save();
        }

        $thread_id = $thread->id;
    }

    $thr_user = Vw_sys_thr_user::byUserId($user_id)->orderBy('thr_updated_at','desc')->get();

    $userIds = array();

    foreach ($thr_user as $item) {
       $userIds = array_merge($userIds, array_diff(array_slice(explode(",", $item->user_ids), 0,4), array(\Auth::user()->user_id)));
    }
    $userIds = array_unique($userIds);

    $users = Vw_users::whereIn('user_id', $userIds)->get();

    return view('sys.message')->with(compact('thr_user','users','thread_id'));
  }

  public function showMessages(Request $request){

      $msgs = Vw_sys_message_users::byThreadId($request->thread_id)->orderBy('created_at', 'asc')->get();

      return $msgs;
  }

  public function postMessage(Request $request){

      $message = new SysMessage;
      $message->sender_id = \Auth::user()->user_id;
      $message->message = $request->message;
      $message->thread_id = $request->thread_id;

      $message->save();

      $vw_message = Vw_sys_message_users::find($message->id);

      $users = SysThrMessageUser::where('thread_id', $vw_message->thread_id)->get();

      $thread = SysThreadMessage::find($vw_message->thread_id);
      $thread->name = '';
      $thread->updated_at = \DB::raw('NOW()');
      $thread->save();

      foreach($users as $user){
        event(
          new MessagePosted($vw_message, $user->user_id)
        );
      }


      return $vw_message;
  }

}
