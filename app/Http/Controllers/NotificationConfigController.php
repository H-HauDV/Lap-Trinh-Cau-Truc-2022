<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationConfig;

class NotificationConfigController extends Controller
{
    public function GetNotificationConfig(Request $request){
        $notificationConfig = NotificationConfig::first();
        return $notificationConfig;
    }
    public function GetNotificationConfigForPost(Request $request){
        $notificationConfig = NotificationConfig::first();
        return $notificationConfig;
    }

    public function SetNotificationConfig(Request $request)
    {
        $isExist=NotificationConfig::where('id','=', $request->id)->first();
        if ($isExist != null) {
            $isExist->notification_method = $request->notification_method;
            $isExist->contain_advertisement = $request->contain_advertisement;
            $isExist->save();
            return response()->json(["Message"=>"Notification Config updated successfully", "Notification_method"=> $request->notification_method, "Contain_advertisement"=> $request->contain_advertisement],  200);
        }else{
            $newNotificationConfig= new NotificationConfig;
            $newNotificationConfig->notification_method = $request->notification_method;
            $newNotificationConfig->contain_advertisement = $request->contain_advertisement;
            $newNotificationConfig->save();
            return response()->json(["Message"=>"Notification Config set successfully", "Notification_method"=> $request->notification_method, "Contain_advertisement"=> $request->rocontain_advertisementle],  200);
        }
    }
}
