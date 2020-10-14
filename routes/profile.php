<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 5/30/20
 * Time: 23:10
 */
use Illuminate\Support\Facades\Route;

Route::get('/','UserController@getcapnhattaikhoan')->name('profile.thong-tin-tk');
Route::post('/','UserController@capnhattaikhoan');

Route::get('/doi-mat-khau','UserController@getdoimatkhau')->name("profile.doi-mk");
Route::post('/doi-mat-khau','UserController@doimatkhau');

