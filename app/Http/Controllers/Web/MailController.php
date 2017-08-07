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

  public function contact(){
    \Debugbar::disable();
    return view('phone.contact');
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

  public function sendmailPhone(Request $request){

    // ini_set('upload_max_filesize','100M');
    // ini_set('post_max_size','100M');

    // var_dump(phpinfo());

    var_dump($request->title);

    // Mail::send('web.mailbody', array('title'=>$request->title, 'bodymessage'=>$request->message, 'pics'=>$request->pics), function($m) use ($request){
    //   $m->from('njn046@gmail.com');
    //   $m->to('njn046@me.com')->subject($request->subject);
    //       // $m->attach($pic, array('as'=>$pic->getClientOriginalName()));
    // });

    return view('web.mail');
  }
}
