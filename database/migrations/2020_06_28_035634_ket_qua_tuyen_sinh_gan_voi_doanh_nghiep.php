<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaTuyenSinhGanVoiDoanhNghiep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_tuyen_sinh_gan_voi_doanh_nghiep', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->string('ten_doanh_nghiep', 255);

            $table->integer('ket_qua_CD')->nullable();
            $table->integer('ket_qua_TC')->nullable();
            $table->integer('ket_qua_SC')->nullable();
            $table->integer('ket_qua_duoi_3_thang')->nullable();
            $table->integer('so_HSSV_duoc_cam_ket')->nullable();
            $table->integer('doanh_nghiep_xay_dung_chuong_trinh')->nullable();
            $table->integer('doanh_nghiep_tham_gia_giang_day')->nullable();
            $table->integer('doanh_nghiep_ho_tro_kinh_phi_dao_tao')->nullable();
            $table->integer('doanh_nghiep_dat_hang_dao_tao')->nullable();
            $table->integer('doanh_nghiep_tiep_nhan_HSSV_thuc_tap')->nullable();
            $table->integer('tong_so')->nullable();
            $table->bigInteger('doanh_nghiep_bo_tro_trang_thiet_bi')->nullable();
            $table->longText('khac')->nullable();
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
        Schema::dropIfExists('ket_qua_tuyen_sinh_gan_voi_doanh_nghiep');
    }
}
