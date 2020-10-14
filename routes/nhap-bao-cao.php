<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 5/31/20
 * Time: 00:19
 */

use Illuminate\Support\Facades\Route;
Route::group(['prefix' => 'quan-ly-giao-vien','middleware' => ['permission:danh_sach_quan_ly_giao_vien']], function () {
        Route::get('/quan-ly-giao-vien', 'QuanLyGiaoVienController@index')->name('ql-giao-vien.index');
});

Route::group([
    'prefix' => 'quan-ly-giao-vien',
    'middleware' => ['permission:them_moi_quan_ly_giao_vien']], function () {
    Route::get('create', 'QuanLyGiaoVienController@create')->name('ql-giao-vien.create');
    Route::post('store', 'QuanLyGiaoVienController@store')->name('ql-giao-vien.store');
});
Route::group([
    'prefix' => 'quan-ly-giao-vien',
    'middleware' => ['permission:cap_nhat_quan_ly_giao_vien']], function () {
        Route::get('edit/{giaoVien}', 'QuanLyGiaoVienController@edit')->name('ql-giao-vien.edit');
        Route::post('update/{giaoVien}', 'QuanLyGiaoVienController@update')->name('ql-giao-vien.update');
});

Route::group(['prefix' => 'quan-ly-giao-vien'], function () {
    // thanhnv import export doi ngu nha giao bm-9
    Route::post('import-file-ql-giao-vien', 'QuanLyGiaoVienController@importFile')
    ->name('import-quan-ly-giao-vien');
Route::post('import-error-ql-giao-vien', 'QuanLyGiaoVienController@importError')
    ->name('import-error-quan-ly-giao-vien');
});

    
   

//CườngNC - Update Middleware - 
Route::group(['middleware' => ['permission:danh_sach_doi_ngu_quan_ly|them_moi_danh_sach_doi_ngu_quan_ly|cap_nhat_danh_sach_doi_ngu_quan_ly|
xem_chi_tiet_danh_sach_doi_ngu_quan_ly']], function () {
        Route::resource('so-lieu-can-bo-quan-ly', 'SoLieuCanBoQuanLyController');
});
   
       // thanhnv import export
    Route::post('so-lieu-can-bo-quan-ly/import-so-lieu-quan-ly', 'ImportSoLieuCanBoQlController@importFile')
        ->name('import-so-lieu-quan-ly');
    Route::post('so-lieu-can-bo-quan-ly/import-error-so-lieu-quan-ly', 'ImportSoLieuCanBoQlController@importError')
        ->name('import-error-so-lieu-quan-ly');

Route::group(['prefix' => 'can-bo-quan-ly'], function () {
    Route::get('/', 'ImportReportController@doingucanboquanly')->name('nhapbc.quan-ly');
});

Route::group(['prefix' => 'chinh-sach-cho-sinh-vien'], function () {
    Route::get('/', 'ImportReportController@chinhsachchosinhvien')->name('nhapbc.chinh-sach-sv');
    // thanhnv import export
    Route::post('import-bieu-mau-chinh-sach-sv','ChinhSachSinhVienController@importFile')
    ->name('import-chinh-sach-sinh-vien');
    Route::post('import-error-bieu-mau-chinh-sach-sv','ChinhSachSinhVienController@importError')
    ->name('import-error-chinh-sach-sinh-vien');
});

Route::group(['prefix' => 'ket-qua-tuyen-sinh'], function () {
    Route::get('/', 'ImportReportController@ketquatuyensinh')->name('nhapbc.ket-qua-ts');

    Route::post('import-kq-sv', 'SoLieuTuyenSinhController@importFile')->name('import.ket-qua-ts');
    Route::post('import-error-kq-sv', 'SoLieuTuyenSinhController@importError')->name('import.error.ket-qua-ts');
});

Route::group(['prefix' => 'xd-chuong-trinh-giao-trinh'], function () {
    Route::get('/', 'ImportReportController@xaydungchuongtrinh')->name('nhapbc.xd-chuong-trinh');
});

Route::group(['prefix' => 'ket-qua-tot-nghiep'], function () {
    Route::get('/', 'ImportReportController@ketquatotnghiep')->name('nhapbc.kq-tot-nghiep');

    // thanhnv update change to service 6/25/2020
    Route::post('import-kq-tot_nghiep', 'SinhVienTotNghiepController@importFile')->name('import.ket-qua-tot-nghiep');
    Route::post('import-error-kq-tot_nghiep', 'SinhVienTotNghiepController@importError')->name('import.error.ket-qua-tot-nghiep');

});
// quảng đạo tạo nghề cho người khuyết tât
Route::group(['prefix' => 'dao-tao-nghe-cho-nguoi-khuyet-tat','middleware' => ['permission:danh_sach_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']], function () {
    Route::get('/', 'DaoTaoNgheChoNguoiKhuyetTatController@index')->name('nhapbc.dao-tao-khuyet-tat');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-nguoi-khuyet-tat','middleware' => ['permission:them_moi_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']], function () {
    Route::get('/create', 'DaoTaoNgheChoNguoiKhuyetTatController@create')->name('nhapbc.dao-tao-khuyet-tat.create');
    Route::post('/store', 'DaoTaoNgheChoNguoiKhuyetTatController@store')->name('nhapbc.dao-tao-khuyet-tat.store');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-nguoi-khuyet-tat','middleware' => ['permission:cap_nhat_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']], function () {
    Route::get('/edit/{id}', 'DaoTaoNgheChoNguoiKhuyetTatController@edit')->name('nhapbc.dao-tao-khuyet-tat.edit');
    Route::post('/update/{id}', 'DaoTaoNgheChoNguoiKhuyetTatController@update')->name('nhapbc.dao-tao-khuyet-tat.update');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-nguoi-khuyet-tat','middleware' => ['permission:chi_tiet_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']], function () {
    Route::get('/show/{id}', 'DaoTaoNgheChoNguoiKhuyetTatController@show')->name('nhapbc.dao-tao-khuyet-tat.show');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-nguoi-khuyet-tat'], function () {
    Route::post('/check-them-dao-tao-cho-nguoi-khuyet-tat', 'DaoTaoNgheChoNguoiKhuyetTatController@getCheckTonTaiDaoTaoChoNguoiKhuyetTat')->name('nhapbc.dao-tao-khuyet-tat.check_so_lieu');
    //thanhnv import
    Route::post('import-kq-dao-tao-nguoi-khuyet-tat', 'DaoTaoNgheChoNguoiKhuyetTatController@importFile')->name('importketqua.dao-tao-nguoi-khuyet-tat');
    Route::post('import-error-kq-dao-tao-nguoi-khuyet-tat', 'DaoTaoNgheChoNguoiKhuyetTatController@importError')->name('import.error.kq-dao-tao-nguoi-khuyet-tat');
});
    
// quảng đào tạo nghề cho thanh niên

//Start - CườngNC - UpdateMiddleware - 30/062020 - Đào tạo thanh niên
Route::group(['prefix' => 'dao-tao-nghe-cho-thanh-nien','middleware' => ['permission:danh_sach_tong_hop_nghe_cho_thanh_nien']], function () {
    Route::get('/', 'DaoTaoNgheThanhNienController@index')->name('nhapbc.dao-tao-thanh-nien.index');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-thanh-nien','middleware' => ['permission:them_moi_tong_hop_nghe_cho_thanh_nien']], function () {
    Route::get('/create', 'DaoTaoNgheThanhNienController@create')->name('nhapbc.dao-tao-thanh-nien.create');
    Route::post('/store', 'DaoTaoNgheThanhNienController@store')->name('nhapbc.dao-tao-thanh-nien.store');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-thanh-nien','middleware' => ['permission:cap_nhat_tong_hop_nghe_cho_thanh_nien']], function () {
    Route::get('/edit/{id}', 'DaoTaoNgheThanhNienController@edit')->name('nhapbc.dao-tao-thanh-nien.edit');
    Route::post('/update/{id}', 'DaoTaoNgheThanhNienController@update')->name('nhapbc.dao-tao-thanh-nien.update');
});
   
Route::group(['prefix' => 'dao-tao-nghe-cho-thanh-nien','middleware' => ['permission:chi_tiet_tong_hop_nghe_cho_thanh_nien']], function () {
    Route::get('/show/{id}', 'DaoTaoNgheThanhNienController@show')->name('nhapbc.dao-tao-thanh-nien.show');
});

Route::group(['prefix' => 'dao-tao-nghe-cho-thanh-nien'], function () {
    Route::post('/check-them-dao-tao-thanh-nien', 'DaoTaoNgheThanhNienController@getCheckDaoTaoThanhNien')->name('nhapbc.dao-tao-thanh-nien.check_so_lieu');
    //thanhnv import
    Route::post('import-kq-dao-tao-thanh-nien', 'DaoTaoNgheThanhNienController@importFile')->name('importketqua.dao-tao-thanh-nien');
    Route::post('import-error-kq-dao-tao-thanh-nien', 'DaoTaoNgheThanhNienController@importError')->name('import.error.kq-dao-tao-thanh-nien');
});
   
//End - CườngNC - UpdateMiddleware - 30/062020 - Đào tạo thanh niên

Route::group(['prefix' => 'dao-tao-nghe-doanh-nghiep'], function () {
    Route::get('/', 'DaoTaoNgheVoiDoanhNghiepController@index')->name('nhapbc.dao-tao-nghe-doanh-nghiep');

    // thanhnv 6/22/2020
    Route::post('import-dao-tao-nghe-gan-voi-doanh-nghiep', 'DaoTaoNgheVoiDoanhNghiepController@importFile')
        ->name('import-dao-tao-nghe-gan-voi-doanh-nghiep');
    Route::post('import-error-dao-tao-nghe-gan-voi-doanh-nghiep', 'DaoTaoNgheVoiDoanhNghiepController@importError')
        ->name('import.error-dao-tao-nghe-gan-voi-doanh-nghiep');
});

Route::group(['prefix' => 'lien-ket-dao-tao'], function () {
    Route::get('/', 'ImportReportController@lienketdaotao')->name('nhapbc.lien-ket-dao-tao');
    Route::get('/chi-tiet-lien-ket-dao-tao', 'ImportReportController@chitietlienketdaotao')->name('nhapbc.chi-tiet-lien-ket-dao-tao');
    Route::get('/them-moi-lien-ket-dao-tao', 'ImportReportController@themmoilienketdaotao')->name('nhapbc.them-moi-lien-ket-dao-tao');
    Route::get('/chinh-sua-lien-ket-dao-tao', 'ImportReportController@chinhsualienketdaotao')->name('nhapbc.chinh-sua-lien-ket-dao-tao');

    //thanhnv import
    Route::post('import-kq-lien-ket-dao-tao', 'LienKetDaoTaoController@importFile')->name('importketqua.lien-ket-dao-tao');
    Route::post('import-error-kq-lien-ket-dao-tao', 'LienKetDaoTaoController@importError')->name('import.error.lien-ket-dao-tao');
});

Route::group(['prefix' => 'thiet-lap-deadline-bao-cao'], function () {
    Route::get('/', 'ImportReportController@deadlinebaocao')->name('nhapbc.deadline-bao-cao');
});

Route::group(['prefix' => 'kiem-soat-tien-do-nop-bao-cao'], function () {
    Route::get('/', 'ImportReportController@tiendonopbaocao')->name('nhapbc.tien-do-nop-bao-cao');
});

// thanhnv them group
Route::group(['prefix' => 'so-lieu-sinh-vien-dang-theo-hoc'], function () {
    Route::post('import-hs-sv-quan-li', 'ExtractController@importFilebm4')->name('import.hssv.ql');
    Route::post('import-error-hs-sv-quan-li', 'ExtractController@importErrorbm4')->name('import.error.hssv-ql');
});

// thanh import 6/21/2020
Route::group(['prefix' => 'chi-tieu-tuyen-sinh'], function () {
    Route::post('import-dang-ky-chi-tieu-tuyen-sinh', 'ExtractController@importFilebm8')->name('import.dang-ky-chi-tieu-tuyen-sinh');
    Route::post('import-error-dang-ky-chi-tieu-tuyen-sinh', 'ExtractController@importErrorbm8')->name('import.error.dang-ky-chi-tieu-tuyen-sinh');
});

// thanhnv 6/22/2020
Route::group(['prefix' => 'ket-qua-tot-nghiep-gan-voi-doanh-nghiep'], function () {
    Route::post('import-ket-qua-tot-nghiep-gan-voi-doanh-nghiep', 'KetQuaTotNghiepGanVoiDoanhNGhiepController@importFile')
        ->name('import-ket-qua-tot-nghiep-gan-voi-doanh-nghiep');
    Route::post('import-error-ket-qua-tot-nghiep-gan-voi-doanh-nghiep', 'KetQuaTotNghiepGanVoiDoanhNGhiepController@importError')
        ->name('import.error-ket-qua-tot-nghiep-gan-voi-doanh-nghiep');
});

// thanhnv 6/21/2020 import export bm13
Route::group(['prefix' => 'hop-tac-quoc-te'], function () {
    Route::post('import-hop-tac-quoc-te', 'ExtractController@importFilebm13')->name('import.hop-tac-quoc-te');
    Route::post('import-error-hop-tac-quoc-te', 'ExtractController@importErrorbm13')->name('import.error.hop-tac-quoc-te');
});

// thanhnv 6/24/2020 bm1
Route::group(['prefix' => 'quan-ly-giao-duc-nghe-nghiep'], function () {
    Route::post('import-quan-ly-giao-duc-nghe-nghiep', 'GiaoDucNgheNghiepController@importFile')->name('import.quan-ly-giao-duc-nghe-nghiep');
    Route::post('import-error-quan-ly-giao-duc-nghe-nghiep', 'GiaoDucNgheNghiepController@importError')->name('import.error.quan-ly-giao-duc-nghe-nghiep');
});

// thanhnv crud đợt 6/28/2020
Route::group(['prefix' => 'dot'], function () {
    Route::get('/', 'DotController@index')->name('view-index-dot');
    Route::get('nhap-them-dot', 'DotController@addForm')->name('nhapdot.create.new');
    Route::get('edit/{id}', 'DotController@editForm')->name('nhapdot.edit-dot');
    Route::post('add-submit-dot', 'DotController@addSubmit')->name('nhapdot.createSubmit.new');
    Route::post('edit-submit-dot/{id}', 'DotController@update')->name('nhapdot.editSubmit.new');
    Route::get('delete/{id}', 'DotController@delete')->name('remove.dot');
});
Route::group([
    'prefix' => 'phe-duyet-bao-cao',
    'middleware' => ['permission:danh_sach_phe_duyet']
], function() {
    Route::get('danh-sach', 'PheDuyetController@danhSach')->name('phe_duyet_bao_cao.danh_sach');
});

Route::group([
    'prefix' => 'phe-duyet-bao-cao',
], function() {
    Route::get('get-danh-sach-trang-thai/{baoCao?}', 'PheDuyetController@getListTrangThai')->name('phe_duyet_bao_cao.get_list_trang_thai');
    Route::post('phe-duyet/{baoCao}', 'PheDuyetController@pheDuyet')->name('phe_duyet_bao_cao.phe_duyet');
});
    

