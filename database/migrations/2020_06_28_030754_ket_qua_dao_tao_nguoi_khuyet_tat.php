<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaDaoTaoNguoiKhuyetTat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_dao_tao_nguoi_khuyet_tat', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id')->nullable();
            $table->integer('tuyen_sinh_nu')->nullable();
            $table->integer('tuyen_sinh_ho_khau_HN')->nullable();
            $table->integer('tot_nghiep_nu')->nullable();
            $table->integer('tot_nghiep_ho_khau_HN')->nullable();
            $table->bigInteger('ngan_sach_TW')->nullable();
            $table->bigInteger('ngan_sach_TP')->nullable();
            $table->bigInteger('ngan_sach_khac')->nullable();
            $table->bigInteger('tong_tuyen_sinh')->nullable();
            $table->bigInteger('tong_ngan_sach')->nullable();
            $table->integer('tong_tot_nghiep')->nullable();
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
        Schema::dropIfExists('ket_qua_dao_tao_nguoi_khuyet_tat');
    }
}
