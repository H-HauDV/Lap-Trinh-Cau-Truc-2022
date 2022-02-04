<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleFunction;
use App\Models\Role;
class RoleFunctionController extends Controller
{
    public function GetWhichFunctionThisRoleAllow(Request $request){
        $roleFunction = RoleFunction::whereIn('age', [16, 18, 20])->get();
    }
    public function AddARoleToAFunction(Request $request)
    {
        // Check if role exist in role table
        $isRoleValid=Role::where('id','=', $request->role)->first();
        if ($isRoleValid == null) {
            return response()->json(["Error"=>"Cannot set function for role, role does not exist"],  400);
        }
        $isFunctionExist = RoleFunction::where('function_id','=', $request->function_id)->first();
        if ($isFunctionExist != null) {
            $isFunctionExist->function_id = $request->function_id;
            $isFunctionExist->push('roles', $request->role,true);//true is for avoid duplicate
            $isFunctionExist->save();
            return response()->json(["Message"=>"Function of role updated successfully", "Function"=> $isFunctionExist->function_definition, "role"=> $request->role],  200);
        }
    }
    public function RemoveARoleFromAFunction(Request $request)
    {
        // Check if role exist in role table
        $isRoleValid=Role::where('id','=', $request->role)->first();
        if ($isRoleValid == null) {
            return response()->json(["Error"=>"Cannot remove function for role, role does not exist"],  400);
        }
        $isFunctionExist = RoleFunction::where('function_id','=', $request->function_id)->first();
        if ($isFunctionExist != null) {
            $isFunctionExist->function_id = $request->function_id;
            $isFunctionExist->pull('roles', $request->role);
            $isFunctionExist->save();
            return response()->json(["Message"=>"Function of role updated successfully", "Function"=> $isFunctionExist->function_definition, "role"=> $request->role],  200);
        }
    }

}