<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaDaoTaoChoThanhNien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_dao_tao_cho_thanh_nien', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');

            $table->integer('thoi_gian_dao_tao')->nullable();
            $table->integer('tong_tuyen_sinh')->nullable();
            $table->integer('nu_tuyen_sinh')->nullable();
            $table->integer('ho_khau_HN_tuyen_sinh')->nullable();
            $table->integer('tong_tuyen_sinh_bo_doi_xuat_ngu')->nullable();
            $table->integer('tuyen_sinh_bo_doi_nu')->nullable();
            $table->integer('tuyen_sinh_bo_doi_ho_khau_HN')->nullable();
            $table->integer('tong_tuyen_sinh_Ca')->nullable();
            $table->integer('tuyen_sinh_ca_nu')->nullable();
            $table->integer('tuyen_sinh_ca_ho_khau_HN')->nullable();
            $table->integer('tong_tuyen_sinh_thanh_nien')->nullable();
            $table->integer('tuyen_sinh_thanh_nien_nu')->nullable();
            $table->integer('tuyen_sinh_thanh_nien_ho_khau_HN')->nullable();
            $table->integer('tong_tot_nghiep')->nullable();
            $table->integer('tong_tot_nghiep_nu')->nullable();
            $table->integer('tong_tot_nghiep_ho_khau_HN')->nullable();
            $table->integer('tong_tot_nghiep_bo_doi')->nullable();
            $table->integer('tong_nghiep_bo_doi_nu')->nullable();
            $table->integer('tong_nghiep_bo_doi_ho_khau_HN')->nullable();
            $table->integer('tong_tot_nghiep_ca')->nullable();
            $table->integer('tot_nghiep_ca_nu')->nullable();
            $table->integer('tot_nghiep_ca_ho_khau_HN')->nullable();
            $table->integer('tong_tot_nghiep_thanh_nien')->nullable();
            $table->integer('tot_nghiep_thanh_nien_nu')->nullable();
            $table->integer('tot_nghiep_thanh_nien_ho_khau_HN')->nullable();
            $table->bigInteger('tong_kinh_phi')->nullable();
            $table->bigInteger('ngan_sach_TW')->nullable();
            $table->bigInteger('ngan_sach_TP')->nullable();
            $table->bigInteger('ngan_sach_khac')->nullable();
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
        Schema::dropIfExists('ket_qua_dao_tao_cho_thanh_nien');
    }
}
