<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 5/31/20
 * Time: 00:13
 */

use Illuminate\Support\Facades\Route;

Route::post('/them-co-quan-chu-quan', 'CoSoDaoTaoController@addCoQuanChuQuan')->name('co-quan-chu-quan.them');
Route::post('/them-quyet-dinh-thanh-lap-co-so', 'CoSoDaoTaoController@addQuyetDinh')->name('quyet-dinh.add');
Route::get('/danh-sach-nganh-nghe-cua-co-so-dao-tao/{csdtid?}', 'NganhNgheController@thietlapnghechocosodaotao')->name('csdt.thiet-lap-nghe-cs');

Route::group(['middleware' => ['permission:danh_sach_co_so_dao_tao']], function () {
    Route::get('/', 'CoSoDaoTaoController@danhsachCSDT')->name('csdt.danh-sach');
});

Route::group(['middleware' => ['permission:danh_dia_diem_dao_tao']], function () {
    Route::get('danh-sach-dia-diem-dao-tao/{id?}', 'ChiNhanhController@danhsachchinhanh')->name('csdt.chi-nhanh');
});


Route::group(['middleware' => ['permission:them_moi_co_so_dao_tao']], function () {
    Route::get('tao-moi-co-so', 'CoSoDaoTaoController@themCSDT')->name('csdt.tao-moi');
    Route::post('tao-moi-co-so', 'CoSoDaoTaoController@taomoiCSDT');
});
Route::group(['middleware' => ['permission:xem_chi_tiet_co_so_dao_tao']], function () {
    Route::get('chi-tiet-co-so/{id}', 'CoSoDaoTaoController@chitietCSDT')->name('csdt.chi-tiet');
});
Route::group(['middleware' => ['permission:cap_nhat_co_so_dao_tao']], function () {
    Route::get('cap-nhat-co-so/{id}', 'CoSoDaoTaoController@suaCSDT')->name('csdt.cap-nhat');
    Route::post('cap-nhat-co-so/{id}', 'CoSoDaoTaoController@capnhatCSDT');
});
Route::group(['middleware' => ['permission:them_moi_dia_diem_dao_tao']], function () {
    Route::get('tao-moi-dia-diem-dao-tao', 'ChiNhanhController@themchinhanh')->name('chi-nhanh.tao-moi');
    Route::post('tao-moi-dia-diem-dao-tao', 'ChiNhanhController@savethemchinhanh');
});
Route::group(['middleware' => ['permission:cap_nhat_dia_diem_dao_tao']], function () {
    Route::get('/cap-nhat-dia-diem-dao-tao/{id}', 'ChiNhanhController@suachinhanh')->name('chi-nhanh.cap-nhat');
    Route::post('/cap-nhat-dia-diem-dao-tao/{id}', 'ChiNhanhController@capnhatchinhanh');
});
Route::group(['middleware' => ['permission:xoa_dia_diem_dao_tao']], function () {
    Route::post('/xoa-dia-diem-dao-tao/{id}', 'ChiNhanhController@xoachinhanh')->name('chi-nhanh.xoa');
});

Route::get('chi-tiet-dia-diem-dao-tao/{id}', 'ChiNhanhController@chiTietChiNhanh')->name('chi-nhanh.chi-tiet');

Route::get('danh-sach-nghe-cua-dia-diem-dao-tao/{id?}', 'ChiNhanhController@getNgheChiNhanh')->name('chi-nhanh.danh-sach-nghe');

Route::get('bo-sung-nghe-vao-dia-diem-dao-tao/{id}', 'ChiNhanhController@boSungNgheVaoChiNhanh')->name('chi-nhanh.bo-sung-nghe');

Route::post('nganh-nghe-trong-giay-phep', 'ChiNhanhController@getNgheTheoGiayPhep')->name('chi-nhanh.get-nganh-nghe');

Route::post('bo-sung-nghe-dia-diem-dao-tao', 'ChiNhanhController@boSungNgheVaoChiNhanh')->name('chi-nhanh-luu-bo-sung-nghe');
