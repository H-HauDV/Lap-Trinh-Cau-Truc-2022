<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\ProductConfigController;
use App\Http\Controllers\ScreenConfigController;
use App\Http\Controllers\PaymentConfigController;
use App\Http\Controllers\NotificationConfigController;
use App\Http\Controllers\LoginConfigController;
use App\Http\Controllers\ModuleSwitchController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleFunctionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Role definition
Route::get('/role/get', [RoleController::class, 'GetRoleInfoFromID']);
Route::post('/role/update', [RoleController::class, 'UpdateRoleWithId']);
Route::post('/role/add', [RoleController::class, 'AddRoleWithId']);

//Function
Route::get('/role-function/get-function', [RoleController::class, 'GetFunctionFormFunctionId']);
Route::post('/role-function/store-function', [RoleController::class, 'StoreFunction']);
//Function of role
Route::get('/role-function/get', [RoleController::class, 'GetWhichFunctionThisRoleAllow']);
Route::post('/role-function/set', [RoleController::class, 'AddARoleToAFunction']);
Route::post('/role-function/remove', [RoleController::class, 'RemoveARoleFromAFunction']);


//User role
Route::get('/user/get-role/from-id', [UserRoleController::class, 'GetUserRoleFromID']);
Route::post('/user/set-role/for-id', [UserRoleController::class, 'StoreUserRole']);

//Product config
Route::get('/productconfig/get', [ProductConfigController::class, 'GetProductConfigFromID']);
Route::post('/productconfig/set', [ProductConfigController::class, 'SetProductConfigFromID']);

//Login config
Route::get('/loginconfig/get', [LoginConfigController::class, 'GetLoginConfigFromID']);
Route::post('/loginconfig/set', [LoginConfigController::class, 'SetLoginConfigFromID']);


//Screen config
Route::get('/user/get-screen-config/from-id', [ScreenConfigController::class, 'GetScreenConfigFromID']);
Route::post('/user/set-screen-config/for-id', [ScreenConfigController::class, 'StoreScreenConfig']);

//Payment config
Route::get('/paymentConfig/get', [PaymentConfigController::class, 'GetPaymentControllerConfig']);
Route::post('/paymentConfig/set', [PaymentConfigController::class, 'SetPaymentControllerConfig']);

//Notification config
Route::get('/notificationConfig/get', [NotificationConfigController::class, 'GetNotificationConfig']);
Route::post('/notificationConfig/set', [NotificationConfigController::class, 'SetNotificationConfig']);

//Module switch config
Route::get('/moduleSwitch/get', [ModuleSwitchController::class, 'GetTeamCodeFromModule']);
Route::post('/moduleSwitch/set', [ModuleSwitchController::class, 'SetTeamCodeForModule']);


//API for get but with post method
Route::post('/user/get-role/for-post', [UserRoleController::class, 'GetUserRoleForPost']); //User role
Route::post('/productconfig/get/for-post', [ProductConfigController::class, 'GetProductConfigForPost']); //Product config
Route::post('/loginconfig/get/for-post', [LoginConfigController::class, 'GetLoginConfigForPost']); //Login config
Route::post('/user/get-screen-config/for-post', [ScreenConfigController::class, 'GetScreenConfigForPost']); //Screen config
Route::post('/paymentConfig/get/for-post', [PaymentConfigController::class, 'GetPaymentControllerConfigForPost']); //Payment config
Route::post('/notificationConfig/get/for-post', [NotificationConfigController::class, 'GetNotificationConfigForPost']); //Notification config
Route::post('/moduleSwitch/get/for-post', [ModuleSwitchController::class, 'GetTeamCodeFromModuleForPost']); //Module switch config