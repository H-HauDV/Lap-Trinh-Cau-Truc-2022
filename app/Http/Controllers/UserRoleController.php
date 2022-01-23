<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
class UserRoleController extends Controller
{
    public function GetUserRoleFromID(Request $request){
        $users = UserRole::where('id','=', $request->id)->get();
        if (count($users) > 0) return response()->json(["role"=> $users[0]->role],  200);
        return response()->json(['Error' =>  "User ID does not exist!"],  400);
    }
    public function GetUserRoleForPost(Request $request){
        $users = UserRole::where('id','=', $request->id)->get();
        if (count($users) > 0) return response()->json(["role"=> $users[0]->role],  200);
        return response()->json(['Error' =>  "User ID does not exist!"],  400);
    }
    public function StoreUserRole(Request $request)
    {
        $isExist=UserRole::where('id','=', $request->id)->first();
        if ($isExist != null) {
            $isExist->id = $request->id;
            $isExist->role = $request->role;
            $isExist->save();
            return response()->json(["Message"=>"Role updated successfully", "User_id"=> $request->id, "role"=> $request->role],  200);
        }else{
            $newUser= new UserRole;
            $newUser->id = $request->id;
            $newUser->role = $request->role;
            $newUser->save();
            return response()->json(["Message"=>"Role set successfully", "User_id"=> $request->id, "role"=> $request->role],  200);
        }
    }

}
