<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleFunction;
use App\Models\Role;
class RoleFunctionController extends Controller
{
    public function GetWhichFunctionThisRoleAllow(Request $request){
        $roleFunction = RoleFunction::where('roles', 'all', [ $request->role])->get("function_id","function_definition");
        return $roleFunction;
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
    public function StoreFunction(Request $request)
    {
        //To-do check format
        $isFunctionExist = RoleFunction::where('function_id','=', $request->function_id)->first();
        if ($isFunctionExist != null) { //update
            $isFunctionExist->function_id = $request->function_id;
            $isFunctionExist->function_definition = $request->function_definition;
            $isFunctionExist->save();
            return response()->json(["Message"=>"Function updated successfully", "Function_id"=> $isFunctionExist->function_id, "Function_definition"=> $isFunctionExist->function_definition],  200);
        }else{
            $newFunction= new RoleFunction;
            $newFunction->function_id = $request->function_id;
            $newFunction->function_definition = $request->function_definition;
            $newFunction->save();
            return response()->json(["Message"=>"Function added successfully", "Function_id"=> $newFunction->function_id, "Function_definition"=> $newFunction->function_definition],  200);
            
        }
    }
    public function GetFunctionFormFunctionId(Request $request)
    {
        //To-do check format
        $isFunctionExist = RoleFunction::where('function_id','=', $request->function_id)->first();
        if ($isFunctionExist != null) { 
            return response()->json(["Function_id"=> $isFunctionExist->function_id, "Function_definition"=> $isFunctionExist->function_definition],  200);
        }
        return response()->json(["Error"=> "Function id not match"],  200);
    }

}