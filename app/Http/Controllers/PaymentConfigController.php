<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentConfig;

class PaymentConfigController extends Controller
{
    public function GetPaymentControllerConfig(Request $request){
        $paymentConfig = PaymentConfig::first();
        return $paymentConfig;
    }
    public function GetPaymentControllerConfigForPost(Request $request){
        $paymentConfig = PaymentConfig::first();
        return $paymentConfig;
    }

    public function SetPaymentControllerConfig(Request $request)
    {
        $isExist=PaymentConfig::where('id','=', $request->id)->first();
        if ($isExist != null) {
            $isExist->payment_method = $request->payment_method;
            $isExist->fastOrder_support = $request->fastOrder_support;
            $isExist->maximum_transaction_amount = $request->maximum_transaction_amount;
            $isExist->acceptable_units = $request->acceptable_units;
            $isExist->save();
            return response()->json(["Message"=>"Payment controller config updated successfully", 
                    "payment_method"=> $request->payment_method, "fastOrder_support"=> $request->fastOrder_support,
                    "maximum_transaction_amount"=>$request->maximum_transaction_amount,
                    "acceptable_units"=>$request->acceptable_units],  200);
        }else{
            $newPaymentConfig= new PaymentConfig;
            $newPaymentConfig->payment_method = $request->payment_method;
            $newPaymentConfig->fastOrder_support = $request->fastOrder_support;
            $newPaymentConfig->maximum_transaction_amount = $request->maximum_transaction_amount;
            $newPaymentConfig->acceptable_units = $request->acceptable_units;
            $newPaymentConfig->save();
            return response()->json(["Message"=>"Payment controller config set successfully", 
                                    "payment_method"=> $request->payment_method, 
                                    "fastOrder_support"=> $request->fastOrder_support,
                                    "maximum_transaction_amount"=>$request->maximum_transaction_amount,
                                    "acceptable_units"=>$request->acceptable_units],  200);
        }
    }
}
