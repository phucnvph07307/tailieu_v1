<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GiayChungNhanDangKyHoatDongGiaoDucNgheNghiep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quyet_dinh');
            $table->bigInteger('giay_chung_nhan');
            $table->string('so_ngay_thang_nam_cap_dia_diem_dao_tao', 255);

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
        Schema::dropIfExists('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep');
    }
}
