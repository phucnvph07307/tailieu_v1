<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaXayDungChuongTrinhGiaoTrinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_xay_dung_chuong_trinh_giao_trinh', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');

            $table->integer('XD_chuong_trinh_moi_CD')->nullable();
            $table->integer('XD_chuong_trinh_moi_TC')->nullable();
            $table->integer('XD_chuong_trinh_moi_SC')->nullable();
            $table->integer('XD_giao_trinh_moi_CD')->nullable();
            $table->integer('XD_giao_trinh_moi_TC')->nullable();
            $table->integer('XD_giao_trinh_moi_SC')->nullable();
            $table->integer('sua_chuong_trinh_CD')->nullable();
            $table->integer('sua_chuong_trinh_TC')->nullable();
            $table->integer('sua_chuong_trinh_SC')->nullable();
            $table->integer('sua_giao_trinh_CD')->nullable();
            $table->integer('sua_giao_trinh_TC')->nullable();
            $table->integer('sua_giao_trinh_SC')->nullable();
            $table->integer('tong_so_XD_chuong_trinh_moi')->nullable();
            $table->integer('tong_so_XD_giao_trinh_moi')->nullable();
            $table->integer('tong_so_chuong_trinh_chinh_sua')->nullable();
            $table->integer('tong_so_giao_trinh_chinh_sua')->nullable();
            $table->bigInteger('kinh_phi_thuc_hien_xd_moi')->nullable();
            $table->bigInteger('kinh_phi_thuc_hien_chinh_sua')->nullable();

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
        Schema::dropIfExists('ket_qua_xay_dung_chuong_trinh_giao_trinh');
    }
}
