<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 2020-05-30 - thienth - chuyển check-email, check-phone sang api
Route::post('/check-email','UserController@checkemail')->name('check-email');
Route::post('/check-phone','UserController@checkphone')->name('check-phone');
Route::post('/nganh-nghe/search-nghe-cap-4','NganhNgheController@apiCheckNgheCap4')->name('nganh-nghe.api-check-nghe-cap-4');
Route::post('/co-so-dao-tao/search-co-so-dao-tao','CoSoDaoTaoController@apiSearchCoSoDaoTao')->name('co-so-dao-tao.api-search-co-so-dao-tao');

Route::post('/get-notify-list', "NotificationController@getNotifyList")->name('api.get-notify-list');