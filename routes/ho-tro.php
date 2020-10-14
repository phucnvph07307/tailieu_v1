<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 5/31/20
 * Time: 00:15
 */

use Illuminate\Support\Facades\Route;


Route::get('/danh-sach', 'TuVanHoTroController@danhsach')->name('tu_van_ho_tro.danh-sach');
Route::get('/chi-tiet/{id}', 'TuVanHoTroController@chitiet')->name('tu_van_ho_tro.chi-tiet');
Route::post('/chi-tiet/{id}', 'TuVanHoTroController@traloiyeucau');
