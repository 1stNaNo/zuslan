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
      $news = Vw_news::latestNews()->paginate(9);
      $viewnews = Vw_news::mostViewed()->get();
      $commentnews = Vw_news::mostComment()->get();
      return \View::make('index')->with(compact('news', 'viewnews', 'commentnews'));
    }
}
