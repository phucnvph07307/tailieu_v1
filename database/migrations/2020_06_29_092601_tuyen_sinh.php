<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TuyenSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuyen_sinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->integer('dot');
            $table->year('nam');
            $table->string('bao_cao_url', 255)->nullable();
            $table->integer('so_luong_sv_Cao_dang')->nullable();
            $table->integer('so_luong_sv_nu_Cao_dang')->nullable();
            $table->integer('so_luong_sv_dan_toc_Cao_dang')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_Cao_dang')->nullable();
            $table->integer('so_tuyen_moi_Cao_dang')->nullable();
            $table->integer('so_lien_thong_Cao_dang')->nullable();
            $table->integer('so_luong_sv_Trung_cap')->nullable();
            $table->integer('so_luong_sv_nu_Trung_cap')->nullable();
            $table->integer('so_luong_sv_dan_toc_Trung_cap')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_Trung_cap')->nullable();
            $table->integer('so_Tot_nghiep_THCS')->nullable();
            $table->integer('so_Tot_nghiep_THPT')->nullable();
            $table->integer('so_luong_sv_So_cap')->nullable();
            $table->integer('so_luong_sv_nu_So_cap')->nullable();
            $table->integer('so_luong_sv_dan_toc_So_cap')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_So_cap')->nullable();
            $table->integer('so_luong_sv_he_khac')->nullable();
            $table->integer('so_luong_sv_nu_khac')->nullable();
            $table->integer('so_luong_sv_dan_toc_khac')->nullable();
            $table->integer('so_luong_sv_ho_khau_HN_khac')->nullable();
            $table->integer('tong_so_tuyen_sinh')->nullable();
            $table->integer('ke_hoach_tuyen_sinh_cao_dang')->nullable();
            $table->integer('ke_hoach_tuyen_sinh_trung_cap')->nullable();
            $table->integer('ke_hoach_tuyen_sinh_so_cap')->nullable();
            $table->integer('ke_hoach_tuyen_sinh_khac')->nullable();
            $table->integer('nguoi_duyet_1');
            $table->integer('nguoi_duyet_2');
            $table->dateTime('thoi_gian_nguoi_duyet_1')->nullable();
            $table->dateTime('thoi_gian_nguoi_duyet_2')->nullable();
            $table->integer('tong_so_tuyen_sinh_cac_trinh_do')->nullable();
            $table->integer('tong_so_nu')->nullable();
            $table->integer('tong_so_dan_toc')->nullable();
            $table->integer('tong_ho_khau_HN')->nullable();
            $table->integer('ho_khau_HN_THCS_Trung_cap')->nullable();
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
        Schema::dropIfExists('tuyen_sinh');
    }
}
