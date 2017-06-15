<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\MapCategory;
use Datatables;
use Validator;

class MapCatController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.mapcat_list');
  }

  public function edit(Request $request){
    $mapCategory = new MapCategory;
    if(!empty($request->id)){
      $mapCategory = MapCategory::find($request->id);
    }

    return view('sys.mapcat')->with(compact('mapCategory'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $mapCategory = MapCategory::find($request->id);
      }else{
        $mapCategory = new MapCategory;
      }

      $mapCategory->value = $request->name;
      $mapCategory->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $mapCategory = MapCategory::find($request->id);
        $mapCategory->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(MapCategory::all())->make(true);
  }

}
