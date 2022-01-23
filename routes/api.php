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

Route::get('/user/get-role/from-id', [UserRoleController::class, 'GetUserRoleFromID']);
Route::post('/user/get-role/support-post-method/from-id/{userId}', [UserRoleController::class, 'GetUserRoleFromIDFunctionSupportPostMethod']);
Route::post('/user/set-role/for-id', [UserRoleController::class, 'StoreUserRole']);

Route::get('/productconfig/get', [ProductConfigController::class, 'GetProductConfigFromID']);
Route::post('/productconfig/set', [ProductConfigController::class, 'SetProductConfigFromID']);

Route::get('/loginconfig/get', [LoginConfigController::class, 'GetLoginConfigFromID']);
Route::post('/loginconfig/set', [LoginConfigController::class, 'SetLoginConfigFromID']);

Route::get('/user/get-screen-config/from-id', [ScreenConfigController::class, 'GetScreenConfigFromID']);
Route::post('/user/set-screen-config/for-id', [ScreenConfigController::class, 'StoreScreenConfig']);

Route::get('/paymentConfig/get', [PaymentConfigController::class, 'GetPaymentControllerConfig']);
Route::post('/paymentConfig/set', [PaymentConfigController::class, 'SetPaymentControllerConfig']);

Route::get('/notificationConfig/get', [NotificationConfigController::class, 'GetNotificationConfig']);
Route::post('/notificationConfig/set', [NotificationConfigController::class, 'SetNotificationConfig']);

Route::get('/moduleSwitch/get', [ModuleSwitchController::class, 'GetTeamCodeFromModule']);
Route::post('/moduleSwitch/set', [ModuleSwitchController::class, 'SetTeamCodeForModule']);