<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Views\Vw_ufile;
use App\Models\Views\Vw_filetype;
use App\Http\Controllers\Controller;
use App\Models\External;
use Session;

class ExternalController extends Controller
{
  public function index(){

    $external = External::all();

    $response = array();

    foreach ($external as $item) {
      $resp = \Laracurl::get($item->link);
      array_push($response,simplexml_load_string($resp));
    }

    // var_dump($response[0]->channel->item[2]);

    // $response = json_encode($response);

    return \View::make('web.external')->with(compact('response'));
  }
}
