<?php

//Created:  17/06/2020 Tuanbt - chia thêm Route giấy phép

use Illuminate\Support\Facades\Route;

Route::get('danh-sach-giay-phep/{id?}', 'GiayPhepController@danhSachGiayPhep')->name('giay-phep.danh-sach');

Route::get('tao-moi-giay-phep/{id?}', 'GiayPhepController@themGiayPhep')->name('giay-phep.tao-moi');
Route::post('tao-moi-giay-phep', 'GiayPhepController@taoMoiGiayPhep')->name('giay-phep.luu-giay-phep');

Route::get('/cap-nhat-giay-phep', 'GiayPhepController@suaGiayPhep')->name('giay-phep.cap-nhat');
Route::post('/cap-nhat-giay-phep', 'GiayPhepController@capNhatGiayPhep');

Route::get('/chi-tiet-giay-phep', 'GiayPhepController@chiTietGiayPhep')->name('giay-phep.chi-tiet');

Route::get('cap-nhat-nghe-trong-giay-phep/{id}', 'GiayPhepController@suaNgheTrongGiayPhep')->name('giay-phep.cap-nhat-nghe-trong-giay-phep');
Route::post('cap-nhat-nghe-trong-giay-phep/{id}', 'GiayPhepController@capNhatNgheTrongGiayPhep');

Route::post('bo-sung-nghe-vao-giay-phep', 'GiayPhepController@boSungNganhNgheVaoGiayPhep')->name('giay-phep.bo-sung-nghe');

Route::post('xoa-nghe-trong-giay-phep', 'GiayPhepController@xoaNgheTrongGiayPhep')->name('giay-phep.xoa-nghe-trong-gp');
