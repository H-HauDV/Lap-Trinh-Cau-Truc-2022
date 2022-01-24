<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleSwitch;
class ModuleSwitchController extends Controller
{
    public function GetTeamCodeFromModule(Request $request){
        $module_switch = ModuleSwitch::where('module','=', $request->module)->get();
        if (count($module_switch) > 0) return response()->json([["team_code"=> $module_switch[0]->team_code], ["type"=> $module_switch[0]->type]],  200);
        return response()->json(['Error' =>  "Module does not exist!"],  400);
    }
    public function GetTeamCodeFromModuleForPost(Request $request){
        $module_switch = ModuleSwitch::where('module','=', $request->module)->get();
        if (count($module_switch) > 0) return response()->json([["team_code"=> $module_switch[0]->team_code], ["type"=> $module_switch[0]->type]],  200);
        return response()->json(['Error' =>  "Module does not exist!"],  400);
    }

    // Sản phẩm: 0 (SP_11 và SP_17) OR
    // Giao hàng: 1 (SP_07 và SP_15) OR
    // Hậu mãi & CSKH: 2 (SP_06 và SP_21) OR
    // Phân quyền & cấu hình KH: 3 (SP_03) SINGLE
    // KH & QL tài khoản: 4 (SP_08 và SP_14) OR
    // Liên kết dữ liệu bán hàng & quản lý kho: 5 (SP_13, SP_18 và SP_20) AND
    // QL giỏ hàng & thanh toán: 6 (SP_10 và SP_12) AND
    // Quảng cáo & khuyến mãi: 7 (SP_09 và SP_19) AND
    // Quản trị hệ thống & cấu hình SP: 8 (SP_05) SINGLE
    // Đơn hàng: 9 (SP_01 và SP_16) OR
    // Tìm kiếm & báo cáo thông kê theo phân quyền & Tích hợp: 10 (SP_04 và SP_02) AND
    public function SetTeamCodeForModule(Request $request)
    {
        $duplicateErrStatus = 1;
        if($request->module < 0 || $request->module > 10) {
            return response()->json(['Error' =>  "Module does not exist!"],  400);
        }
        switch($request->module) {
            case 0:    // Sản phẩm: 0 (SP_11 và SP_17) OR
                if($request->team_code == 'SP_11' || $request->team_code == 'SP_17') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'OR');
                }
                break;
            case 1:    // Giao hàng: 1 (SP_07 và SP_15) OR
                if($request->team_code == 'SP_07' || $request->team_code == 'SP_15') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'OR');
                }
                break;
            case 2:    // Hậu mãi & CSKH: 2 (SP_06 và SP_21) OR
                if($request->team_code == 'SP_06' || $request->team_code == 'SP_21') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'OR');
                }
                break;
            case 3:    // Phân quyền & cấu hình KH: 3 (SP_03) SINGLE
                if($request->team_code == 'SP_03') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'SINGLE');
                }
                break;
            case 4:    // KH & QL tài khoản: 4 (SP_08 và SP_14) OR
                if($request->team_code == 'SP_08' || $request->team_code == 'SP_14') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'OR');
                }
                break;  
            case 5:    // Liên kết dữ liệu bán hàng & quản lý kho: 5 (SP_13, SP_18 và SP_20) AND
                if($request->team_code == 'SP_13' || $request->team_code == 'SP_18'|| $request->team_code == 'SP_20') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'AND');
                }
                break;
            case 6:    // QL giỏ hàng & thanh toán: 6 (SP_10 và SP_12) AND
                if($request->team_code == 'SP_10' || $request->team_code == 'SP_12') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'AND');
                }
                break;
            case 7:    // Quảng cáo & khuyến mãi: 7 (SP_09 và SP_19) AND
                if($request->team_code == 'SP_09' || $request->team_code == 'SP_19') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'AND');
                }
                break;
            case 8:    // Quản trị hệ thống & cấu hình SP: 8 (SP_05) SINGLE
                if($request->team_code == 'SP_05') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'SINGLE');
                }
                break;
            case 9:    // Đơn hàng: 9 (SP_01 và SP_16) OR           
                if($request->team_code == 'SP_01' || $request->team_code == 'SP_16') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'OR');
                }
                break;
            case 10:    // Tìm kiếm & báo cáo thông kê theo phân quyền & Tích hợp: 10 (SP_04 và SP_02) AND
                if($request->team_code == 'SP_04' || $request->team_code == 'SP_02') {
                    $duplicateErrStatus = 0;
                    $this->SaveTeamCodeAndModuleToDB($request, 'AND');
                }
                break;
        }
        if ($duplicateErrStatus == 1) {
            return response()->json(['Error' =>  "Module and team code does not match!"],  400);
        }
        return response()->json(["Message"=>"Success!"], 200);
    }
    public function SaveTeamCodeAndModuleToDB(Request $request, $type) {
        $isExist = ModuleSwitch::where('module','=', $request->module)->first();
        if ($isExist != null) {
            if(strcmp($type, 'AND') == 0 || strcmp($type, 'SINGLE') == 0) {
                return;
            } 
            $isExist->module = $request->module;
            $isExist->team_code = $request->team_code;
            $isExist->save();
        } else{
            $newModuleSwitch= new ModuleSwitch;
            if(strcmp($type, 'AND') == 0 || strcmp($type, 'SINGLE') == 0) {
                $newModuleSwitch->team_code = 'all';
            } else {
                $newModuleSwitch->team_code = $request->team_code;
            }       
            $newModuleSwitch->module = $request->module;          
            $newModuleSwitch->type = $type;
            $newModuleSwitch->save();
        }
    }
}
