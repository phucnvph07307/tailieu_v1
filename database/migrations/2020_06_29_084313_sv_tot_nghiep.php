<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SvTotNghiep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_tot_nghiep', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->integer('dot');
            $table->year('nam');
            $table->integer('Tong_SoNguoi_TN')->nullable();
            $table->integer('NU_SV_TN')->nullable();
            $table->integer('DanToc_ThieuSo_ItNguoi')->nullable();
            $table->integer('HoKhauHN')->nullable();
            $table->integer('SoSV_NhapHoc_DauKhoa_TrinhDoCD')->nullable();
            $table->integer('SoSV_Du_DieuKienThi_XetTN_TrinhDoCD')->nullable();
            $table->integer('SoSV_TN_TrinhDoCD')->nullable();
            $table->integer('SoLuong_Nu_SV_CD')->nullable();
            $table->integer('SoSV_HoKhauHN_CD')->nullable();
            $table->integer('SoLuong_HSSV_TN_Kha_Gioi_CD')->nullable();
            $table->integer('SoSV_NhapHoc_DauKhoa_TrinhDoTC')->nullable();
            $table->integer('SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC')->nullable();
            $table->integer('SoLuong_HSSV_TN_Kha_Gioi_TC')->nullable();
            $table->integer('SoSV_TN_TrinhDoTC')->nullable();
            $table->integer('SoLuong_Nu_SV_TC')->nullable();
            $table->integer('SoSV_HoKhauHN_TC')->nullable();
            $table->integer('SoLuong_HSSV_TN_Kha_Gioi_SC')->nullable();
            $table->integer('SoSV_NhapHoc_DauKhoa_TrinhDoSC')->nullable();
            $table->integer('SoSV_Du_DieuKienThi_XetTN_TrinhDoSC')->nullable();
            $table->integer('SoSV_TN_TrinhDoSC')->nullable();
            $table->integer('SoLuong_Nu_SV_SC')->nullable();
            $table->integer('SoSV_HoKhauHN_SC')->nullable();
            $table->integer('SoSV_NhapHoc_DauKhoa_NgheKhac')->nullable();
            $table->integer('SoSV_DuKienThi_XetTN_NgheKhac')->nullable();
            $table->integer('SoSV_TN_NgheKhac')->nullable();
            $table->integer('SoLuong_Nu_SV_NgheKhac')->nullable();
            $table->integer('DanToc_ThieuSo_ItNguoi_NgheKhac')->nullable();
            $table->integer('SoNguoi_HoKhauHN_NgheKhac')->nullable();
            $table->integer('SoNguoi_CoViecLamNgay_SauKhi_TN_CD')->nullable();
            $table->integer('CoViecLam_HoKhauHN_TrinhDoCD')->nullable();
            $table->integer('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC')->nullable();
            $table->integer('CoViecLam_HoKhauHN_TrinhDo_TC')->nullable();
            $table->integer('SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC')->nullable();
            $table->integer('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC')->nullable();
            $table->integer('SoLuong_HoKhauHN_TrinhDoSC')->nullable();
            $table->integer('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac')->nullable();
            $table->integer('SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac')->nullable();
            $table->bigInteger('MucLuong_TB_CD')->nullable();
            $table->bigInteger('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD')->nullable();
            $table->bigInteger('MucLuong_TB_TC')->nullable();
            $table->bigInteger('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC')->nullable();
            $table->bigInteger('MucLuong_TB_SC')->nullable();
            $table->bigInteger('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC')->nullable();
            $table->bigInteger('MucLuong_TB_NgheKhac')->nullable();
            $table->bigInteger('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac')->nullable();
            $table->integer('DanToc_ThieuSo_ItNguoi_CD')->nullable();
            $table->integer('DanToc_ThieuSo_ItNguoi_TC')->nullable();
            $table->integer('HoKhau_HN_Thuoc_DoiTuong_TN_TC')->nullable();
            $table->integer('DanToc_ThieuSo_ItNguoi_SC')->nullable();
            $table->integer('trang_thai')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sv_tot_nghiep');
    }
}
