<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function GetRoleInfoFromID(Request $request){
        $Role = Role::where('id','=', $request->id)->first();
        if ($Role!=null) return response()->json(["Role Definition"=> $Role->definition],  200);
        return response()->json(['Error' =>  "Role does not exist!"],  400);
    }
    public function UpdateRoleWithRoleId(Request $request)
    {
        $isExist=Role::where('id','=', $request->id)->first();
        if ($isExist != null) {
            $isExist->id = $request->id;
            $isExist->definition= $request->definition;
            $isExist->save();
            return response()->json(["Message"=>"Role updated successfully", "Role_id"=> $request->id, "Definition"=> $request->definition],  200);
        }
        return response()->json(['Error' =>  "Can not find that role!"],  400);
    }
    public function AddRoleWithId(Request $request)
    {
        $isExist=Role::where('id','=', $request->id)->first();
        if ($isExist == null) {
            $newRole= new Role;
            $newRole->id = $request->id;
            $newRole->definition = $request->definition;
            $newRole->save();
            return response()->json(["Message"=>"Role set successfully", "Role_id"=> $newRole->id, "Definition"=> $newRole->definition],  200);
        }
        return response()->json(['Error' =>  "Role already exist!"],  400);
    }

}