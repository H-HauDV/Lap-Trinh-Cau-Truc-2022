<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleSwitch;
class ModuleSwitchController extends Controller
{
    public function GetTeamCodeFromModule(Request $request){
        $module_switch = ModuleSwitch::where('module','=', $request->module)->get();
        if (count($module_switch) > 0) return response()->json(["team_code"=> $module_switch[0]->team_code],  200);
        return response()->json(['Error' =>  "Module does not exist!"],  400);
    }

    // Sản phẩm: 0 (SP_11 và SP_17)
    // Giao hàng: 1 (SP_07 và SP_15)
    // Hậu mãi & CSKH: 2 (SP_06 và SP_21)
    // KH & QL tài khoản: 3 (SP_08 và SP_14)
    // Đơn hàng: 4 (SP_01 và SP_16)
    public function SetTeamCodeForModule(Request $request)
    {
        if($request->module < 0 || $request->module > 4) {
            return response()->json(['Error' =>  "Module does not exist!"],  400);
        }
        switch($request->module) {
            case 0:     // Sản phẩm: 0 (SP_11 và SP_17)
                if($request->team_code == 'SP_11' || $request->team_code == 'SP_17') {
                    SaveTeamCodeAndModuleToDB($request);
                }
                break;
            case 1:     // Giao hàng: 1 (SP_07 và SP_15)
                if($request->team_code == 'SP_07' || $request->team_code == 'SP_15') {
                    SaveTeamCodeAndModuleToDB($request);
                }
                break;
            case 2:     // Hậu mãi & CSKH: 2 (SP_06 và SP_21)
                if($request->team_code == 'SP_06' || $request->team_code == 'SP_21') {
                    SaveTeamCodeAndModuleToDB($request);
                }
                break;
            case 3:     // KH & QL tài khoản: 3 (SP_08 và SP_14)
                if($request->team_code == 'SP_08' || $request->team_code == 'SP_14') {
                    SaveTeamCodeAndModuleToDB($request);
                }
                break;
            case 4:     // Đơn hàng: 4 (SP_01 và SP_16)
                if($request->team_code == 'SP_01' || $request->team_code == 'SP_16') {
                    SaveTeamCodeAndModuleToDB($request);
                }
                break;  
        }
        return response()->json(['Error' =>  "Module and team code does not match!"],  400);
    }
    private function SaveTeamCodeAndModuleToDB(Request $request) {
        $isExist = ModuleSwitch::where('module','=', $request->module)->first();
        if ($isExist != null) {
            $isExist->module = $request->module;
            $isExist->team_code = $request->team_code;
            $isExist->save();
            return response()->json(["Message"=>"Team code updated successfully"], 200);
        } else{
            $newModuleSwitch= new ModuleSwitch;
            $newModuleSwitch->module = $request->module;
            $newModuleSwitch->team_code = $request->team_code;
            $newModuleSwitch->save();
            return response()->json(["Message"=>"Team code set successfully"],  200);
        }
    }
}
