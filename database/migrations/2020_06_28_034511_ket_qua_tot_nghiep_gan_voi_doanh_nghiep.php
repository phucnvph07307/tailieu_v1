<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaTotNghiepGanVoiDoanhNghiep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_tot_nghiep_gan_voi_doanh_nghiep', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->string('ten_doanh_nghiep', 255);

            $table->integer('nhap_hoc_dau_tot_nghiep_CD')->nullable();
            $table->integer('tot_nghiep_CD')->nullable();
            $table->integer('nhap_hoc_dau_tot_nghiep_TC')->nullable();
            $table->integer('tot_nghiep_TC')->nullable();
            $table->integer('nhap_hoc_dau_tot_nghiep_SC')->nullable();
            $table->integer('tot_nghiep_SC')->nullable();

            $table->integer('duoi_3_thang_tot_nghiep_nhap_hoc_dau')->nullable();
            $table->integer('duoi_3_thang_tot_nghiep')->nullable();
            $table->integer('so_HSSV_duoc_tuyen_dung')->nullable();
            $table->bigInteger('muc_luong_doanh_nghiep_tra')->nullable();
            $table->integer('tong_HSSV_tot_nghiep')->nullable();
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
        Schema::dropIfExists('ket_qua_tot_nghiep_gan_voi_doanh_nghiep');
    }
}
