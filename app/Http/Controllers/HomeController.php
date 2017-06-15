<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Views\Vw_news;
use App\Models\Sys\Views\Vw_sys_map;
use App\Models\Sys\MapCategory;
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
      $news = Vw_news::latestNews()->paginate(9);
      $viewnews = Vw_news::mostViewed()->get();
      $commentnews = Vw_news::mostComment()->get();

      $map = Vw_sys_map::all();
      $mapCategory = MapCategory::all();

      return \View::make('index')->with(compact('news', 'viewnews', 'commentnews','map','mapCategory'));
    }

    public function getMaps(){
      $map = Vw_sys_map::all();
      return $map;
    }

    public function phoneMap(){
      $map = Vw_sys_map::all();
      $mapCategory = MapCategory::all();

      \Debugbar::disable();
      return \View::make('phone.map')->with(compact('map','mapCategory'));
    }
}
