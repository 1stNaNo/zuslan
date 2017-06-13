<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Views\Vw_news;
use Session;

class RssController extends Controller
{
  public function __construct(){
  }

  public function out(){

    $news = Vw_news::fromView()->orderBy('insert_date', 'desc')->paginate(9);

    return view('web.rss_output')->with(compact('news'));
  }

}
