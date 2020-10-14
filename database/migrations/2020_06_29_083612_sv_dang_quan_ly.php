<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SvDangQuanLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sv_dang_quan_ly', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('id_loai_hinh');
            $table->bigInteger('nghe_id');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->integer('dot');
            $table->year('nam');
            $table->string('bao_cao_url', 255);
            $table->integer('so_luong_sv_Cao_dang')->nullable();
            $table->integer('so_luong_sv_nu_Cao_dang')->nullable();
            $table->integer('so_luong_sv_dan_toc_Cao_dang')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_Cao_dang')->nullable();
            $table->integer('so_luong_sv_Trung_cap')->nullable();
            $table->integer('so_luong_sv_nu_Trung_cap')->nullable();
            $table->integer('so_luong_sv_dan_toc_Trung_cap')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_Trung_cap')->nullable();
            $table->integer('so_luong_sv_So_cap')->nullable();
            $table->integer('so_luong_sv_nu_So_cap')->nullable();
            $table->integer('so_luong_sv_dan_toc_So_cap')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_So_cap')->nullable();
            $table->integer('so_luong_sv_he_khac')->nullable();
            $table->integer('so_luong_sv_nu_khac')->nullable();
            $table->integer('so_luong_sv_dan_toc_khac')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_khac')->nullable();
            $table->integer('tong_so_HSSV_co_mat_cac_trinh_do')->nullable();
            $table->integer('tong_so_nu')->nullable();
            $table->integer('tong_so_dan_toc_thieu_so')->nullable();
            $table->integer('tong_so_ho_khau_HN')->nullable();
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
        Schema::dropIfExists('sv_dang_quan_ly');
    }
}
