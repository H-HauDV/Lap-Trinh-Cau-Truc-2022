<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenConfig;

class ScreenConfigController extends Controller
{
    public function GetScreenConfigFromID(Request $request)
    {
        $user_screen = ScreenConfig::where('user_id', '=', $request->id)->get();
        if (count($user_screen) > 0) return response()->json(["theme" => $user_screen[0]->theme, "font-size" => $user_screen[0]->{"font-size"}, "language" => $user_screen[0]->language, "user_id" => $user_screen[0]->{"user_id"}]);
        return response()->json(['Error' =>  "User ID does not exist!"],  400);
    }
    public function GetScreenConfigForPost(Request $request)
    {
        $user_screen = ScreenConfig::where('user_id', '=', $request->id)->get();
        if (count($user_screen) > 0) return response()->json(["theme" => $user_screen[0]->theme, "font-size" => $user_screen[0]->{"font-size"}, "language" => $user_screen[0]->language, "user_id" => $user_screen[0]->{"user_id"}]);
        return response()->json(['Error' =>  "User ID does not exist!"],  400);
    }
    public function StoreScreenConfig(Request $request)
    {
        $isExist = ScreenConfig::where('user_id', '=', $request->{"user_id"})->first();
        if ($isExist != null) {
            if ($request->{"user_id"} != null) $isExist->{"user_id"} = $request->{"user_id"};
            if ($request->theme != null) $isExist->theme = $request->theme;
            if ($request->{"font-size"} != null) $isExist->{"font-size"} = $request->{"font-size"};
            if ($request->language != null) $isExist->language = $request->language;
            $isExist->save();
            return response()->json(["Message" => "Configuration has been updated successfully",  "user_id" => $request->user_id],  200);
        } else {
            $newUser = new ScreenConfig;
            $isExist->{"user_id"} = $request->{"user_id"};
            $isExist->theme = $request->theme;
            $isExist->{"font-size"} = $request->{"font-size"};
            $isExist->language = $request->language;
            $newUser->save();
            return response()->json(["Message" => "Successfully configured",  "user_id" => $request->user_id],  200);
        }
    }
}
