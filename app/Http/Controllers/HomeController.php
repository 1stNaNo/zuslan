<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Views\Vw_news;
use App\Models\ContentCat;
use App\Models\External;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('lang');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $external = External::all();
      $content_cat = new ContentCat;
      $content_cat = $content_cat->orderBy('content_name', 'asc')->get();

      $data = array();

      foreach($content_cat as $item){
          array_push($data, Vw_news::byCategory($item->cat_id, 4)->orderBy('insert_date','desc')->get());
      }

      return \View::make('index')->with(compact('data','external'));
    }
}
