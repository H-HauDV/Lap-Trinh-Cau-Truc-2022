<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginConfig;
class LoginConfigController extends Controller
{
    public function GetLoginConfigFromID(Request $request){
      $LoginConfig=LoginConfig::all();
      return $LoginConfig;
    }
    public function GetLoginConfigForPost(Request $request){
      $LoginConfig=LoginConfig::all();
      return $LoginConfig;
    }
    public function SetLoginConfigFromID(Request $request){
      $isExist=LoginConfig::where('id','=', $request->id)->first();
        if ($isExist != null) {
            $isExist->Login_method = $request->Login_method;
            $isExist->Direct_success = $request->Direct_success;
            $isExist->save();
            return response()->json(["Message"=>"Login Config updated successfully", "Login_method"=> $request->Login_method, "Direct_success"=> $request->Direct_success],  200);
        }else{
            $newLoginConfigFromID= new LoginConfig;
            $newLoginConfigFromID->Login_method = $request->Login_method;
            $newLoginConfigFromID->Direct_success = $request->Direct_success;
            $newLoginConfigFromID->save();
            return response()->json(["Message"=>"Login Config set successfully", "Login_method"=> $request->Login_method, "Direct_success"=> $request->Direct_success],  200);
        }
    }
}
