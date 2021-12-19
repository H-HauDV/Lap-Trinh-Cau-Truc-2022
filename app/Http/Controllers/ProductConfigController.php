<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductConfig;
class ProductConfigController extends Controller
{
    public function GetProductConfig(Request $request){
      $productConfig=ProductConfig::all();
      return $productConfig;
    }
    public function SetProductConfig(Request $request){
      $isExist=ProductConfigFromID::where('id','=', $request->id)->first();
      if ($isExist != null) {
          $isExist->display_mode = $request->display_mode;
          $isExist->moving_tab = $request->moving_tab;
          $isExist->save();
          return response()->json(["Message"=>"Product Config updated successfully", "display_mode"=> $request->display_mode, "moving_tab"=> $request->moving_tab],  200);
      }else{
          $newProductConfigFromID= new UserRole;
          $newProductConfigFromID->display_mode = $request->display_mode;
          $newProductConfigFromID->moving_tab = $request->moving_tab;
          $newProductConfigFromID->save();
          return response()->json(["Message"=>"Product Config set successfully", "display_mode"=> $request->display_mode, "moving_tab"=> $request->moving_tab],  200);
      }
    }
}