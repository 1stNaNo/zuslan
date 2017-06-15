<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class MailController extends Controller
{
  public function __construct(){
  }

  public function index(){
    return view('web.mail');
  }

  public function sendmail(Request $request){
    $data = array(
      'subject' => $request->title,
      'message' => $request->message,
      'pics' => $request->pics
    );

    Mail::send('web.mailbody', array('title'=>$request->title, 'bodymessage'=>$request->message), function($m) use ($request){
      $m->from('njn046@gmail.com');
      $m->to('njn046@me.com')->subject($request->subject);
      if(count($request->pics) != 0){
        foreach($request->pics as $pic)
          $m->attach($pic, array('as'=>$pic->getClientOriginalName()));
      }
    });
    return redirect('/mail');
  }
}
