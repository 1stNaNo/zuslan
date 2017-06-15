<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\Map;
use App\Models\Sys\MapCategory;
use App\Models\Sys\Views\Vw_sys_map;
use Datatables;
use Validator;

class MapController extends Controller
{
  public function __construct(){
    $this->middleware('lang');
    $this->middleware('auth');
  }

  public function index(){
    return view('sys.map_list');
  }

  public function edit(Request $request){
    $map = new Map;
    if(!empty($request->id)){
      $map = Map::find($request->id);
    }

    $mapCategory = MapCategory::all();

    return view('sys.map')->with(compact('map','mapCategory'));
  }

  public function save(Request $request){

    $validate = [];
    $validate['name'] = 'required';

    $validator = \Validator::make($request->all(), $validate);

    if($validator->fails()){
      return response()->json($validator->messages(), 200);
    }else{
      if(!empty($request->id)){
        $map = Map::find($request->id);
      }else{
        $map = new Map;
      }

      $map->cat_id = $request->cat_id;
      $map->name = $request->name;
      $map->latitude = $request->latitude;
      $map->longitude = $request->longitude;
      $map->radius = $request->radius;
      $map->save();

      return response()->json(['type' => 'success']);
    }

  }

  public function remove(Request $request){

      if(!empty($request->id)){
        $map = Map::find($request->id);
        $map->delete();
      }

      return response()->json(['type' => 'success']);

  }

  public function datalist(){
    return Datatables::of(Vw_sys_map::all())->make(true);
  }

}
