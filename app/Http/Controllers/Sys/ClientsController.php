<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysClient;
use Datatables;
use Validator;

class ClientsController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.clients_list');
  }

  public function edit(Request $request){
    $sysClient = new SysClient;
    if(!empty($request->id)){
      $sysClient = SysClient::find($request->id);
    }

    return view('sys.clients')->with(compact('sysClient'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $sysClient = SysClient::find($request->id);
      }else{
        $sysClient = new SysClient;
      }

      $sysClient->name = $request->name;
      $sysClient->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $sysClient = SysClient::find($request->id);
        $sysClient->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(SysClient::all())->make(true);
  }

}
