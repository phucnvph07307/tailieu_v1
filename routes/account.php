<?php

use Illuminate\Support\Facades\Route;



//2020-06-19 - CuongNC - UpdateMiddleware
Route::group(['middleware' => ['permission:danh_sach_tai_khoan']], function () {
    Route::get('/quan-ly-tai-khoan', 'AccountController@index')->name('account.list');
});

Route::group(['middleware' => ['permission:vo_hieu_hoa_tai_khoan']], function () {
    Route::post('/edit-status', 'AccountController@editstatus')->name('account.editstatus');
});

Route::group(['middleware' => ['permission:them_tai_khoan']], function () {
    Route::get('/tao-tai-khoan', 'UserController@getdangkytaikhoan')->name("account.tao-tk");
    Route::post('/tao-tai-khoan', 'UserController@dangkytaikhoan');
});
Route::group(['middleware' => ['permission:sua_tai_khoan']], function () {
    Route::get('/edit/{id}', 'AccountController@edit')->name('account.edit');
    Route::post('/update', 'AccountController@updateID')->name('account.update');
    Route::post('/check-email-update', 'AccountController@checkEmailUpdate')->name('account.check_email_update');
});
//2020-06-19 - CuongNC - UpdateMiddleware

//2020-06-11 - cuongnc,hieupt - start phân quyền tài khoản
//Start - CườngNC - UpdateMiddleware - 01/07/2020
Route::group(['middleware' => ['permission:danh_sach_quyen']], function () {
    Route::get('/phan-quyen-tai-khoan', 'PhanQuyenController@getQuyen')->name('account.phan-quyen-tk');
});

Route::group(['middleware' => ['permission:them_quyen']], function () {
    Route::get('/them-quyen', 'PhanQuyenController@themQuyen')->name('account.them-quyen');
    Route::post('/them-quyen', 'PhanQuyenController@saveQuyen');
});

Route::group(['middleware' => ['permission:sua_quyen']], function () {
    Route::get('/sua-quyen/{id}', 'PhanQuyenController@suaQuyen')->name('account.sua-quyen');
    Route::post('sua-quyen/{id}', 'PhanQuyenController@updateQuyen');
});
//End - CườngNC - UpdateMiddleware - 01/07/2020
// end phân quyền tài khoản

Route::get('/cap-nhat-thong-tin-ca-nhan', 'AccountController@capnhatthongtincanhan');
Route::get('/doi-mat-khau', 'AccountController@thaydoimatkhau');

// 2020-05-30 - thienth - chuyển tạo tk sang nhóm account



// 2020-05-31 - phucnv - làm thêm chắc năng search và chắc ten
Route::get('/search', 'AccountController@search')->name('account.search');
Route::post('/check-name', 'AccountController@checkName')->name('account.check-name');