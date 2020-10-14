<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 5/31/20
 * Time: 00:15
 */

use Illuminate\Support\Facades\Route;
//** CườngNC - 25/06/2020 - Cập nhật middleware */
Route::group(['middleware' => ['permission:them_moi_nganh_nghe|xem_chi_tiet_nganh_nghe
                                |cap_nhat_nganh_nghe|xoa_nganh_nghe']], function () {
    Route::get('/danh-sach', 'NganhNgheController@danhsachnganhnghe')->name('nghe.danh-sach');
    Route::get('/chi-tiet-nghe/{ma_nghe}', 'NganhNgheController@chitietnghe')->name('nghe.chi-tiet-nghe');
    Route::get('/thiet-lap-chi-tieu-tuyen-sinh', 'NganhNgheController@thietlapchitieutuyensinh')->name('nghe.chi-tieu-ts');

    Route::post('/bo-sung-nganh-nghe-vao-co-so', 'NganhNgheController@boSungNganhNgheVaoCoSo')->name('nghe.bo-sung-vao-co-so');

    Route::get('cap-nhat-nganh-nghe/{id}', 'NganhNgheController@capNhatNganhNghe')->name('nghe.cap-nhat');
    Route::get('search', 'NganhNgheController@search')->name('nghe.search');

    // Quanglx 07/08/2020 thêm nghề
    // Route::get('them-moi-nganh-nghe/', 'NganhNgheController@create')->name('nghe.them-moi');
    Route::post('store/', 'NganhNgheController@store')->name('nghe.them-moi.store');
    Route::post('update/{id}', 'NganhNgheController@updateData')->name('nghe.update');
    Route::get('delete/{id}', 'NganhNgheController@delete')->name('nghe.delete');
});