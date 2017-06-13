<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysClient;
use App\Models\Sys\SysOrder;
use App\Models\Sys\SysSplitted;
use App\Models\Sys\SysOrderedProduct;
use App\Models\Sys\Views\Vw_ordered_product;
use App\Models\Sys\Views\Vw_product_type;
use App\Models\Sys\Views\Vw_product;
use App\Models\Sys\Views\Vw_order;
use App\Models\Sys\Views\Vw_unit;
use App\Models\Sys\Views\Vw_splitted;
use Datatables;
use Validator;
use Auth;

class OrderController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('lang');
  }

  public function index(){
    return view('sys.orderlist');
  }

  public function indexOrderRegister(Request $request){
    $types = new Vw_product_type;
    $products = new Vw_product;
    $units = new Vw_unit;

    return view('sys.orderregister')->with(compact('types', 'products', 'units'));
  }

  public function indexOrderConf(Request $request){
    return view('sys.orderconf');
  }

  public function ordersave(Request $request){
    $order = new SysOrder;
    $order->client_id = Auth::user()->org_id;
    $order->insert_date = \Carbon\Carbon::now();
    $order->insert_user = Auth::user()->user_id;
    $order->comment = $request->comment;
    $order->save();
    for($i = 0; $i < count($request->product_id); $i++){
      $op = new SysOrderedProduct;
      $op->product_id = $request->product_id[$i];
      $op->order_id = $order->id;
      $op->unit = $request->unit_id[$i];
      if($request->is_split[$i] == 0){
        $op->size = $request->product_size[$i];
      }else{
        $ttl = 0;
        foreach($request->product_size[$i] as $k){
          $ttl += $k;
        }
        $op->size = $ttl;
      }
      $op->save();

      if($request->is_split[$i] == 1){
        $a = 0;
        foreach($request->product_size[$i] as $k){
          $splt = new SysSplitted;
          $splt->oprod_id = $op->id;
          $splt->size = $k;
          $splt->day = $request->day[$i][$a];
          $splt->save();
          $a++;
        }
      }

    }

    return view('sys.orderlist');
  }

  public function orderdata(Request $request){
    if(Auth::user()->can('order')){
      return Datatables::of(Vw_order::byClient(Auth::user()->org_id))->make(true);
    }else{
      return Datatables::of(Vw_order::all())->make(true);
    }

  }

  public function opdata(Request $request){
    return Vw_ordered_product::where('order_id', $request->id)->get();
  }

  public function opsplitdata(Request $request){
    return Vw_splitted::where('order_id', $request->order_id)->where('product_id', $request->product_id)->get();
  }
}
