<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KetQuaHopTacQuocTe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ket_qua_hop_tac_quoc_te', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');

            $table->integer('tong_tuyen_sinh')->nullable();
            $table->integer('tong_tuyen_sinh_CD')->nullable();
            $table->integer('tong_tuyen_sinh_SC')->nullable();
            $table->integer('tong_so_hs_duoc_cap_bang')->nullable();
            $table->integer('so_hs_duoc_cac_don_vi_cap_bang')->nullable();
            $table->integer('so_hs_duoc_nha_truong_cap_bang')->nullable();
            $table->integer('so_hs_co_viec_lam_sau_khi_tot_nghiep')->nullable();
            $table->integer('so_luong_chuong_trinh_xay_dung_phat_trien')->nullable();
            $table->integer('tong_hop_tac_quoc_te_trong_dao_tao_boi_duong')->nullable();
            $table->integer('so_gv_duoc_dao_tao_boi_duong')->nullable();
            $table->integer('so_can_bo_quan_ly_duoc_dao_tao_boi_duong')->nullable();
            $table->integer('so_phong_hoc_duoc_dau_tu')->nullable();
            $table->integer('so_nha_xuong_duoc_dau_tu')->nullable();
            $table->integer('tong_tuyen_sinh_TC')->nullable();
            $table->bigInteger('tong_kinh_phi')->nullable();
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
        Schema::dropIfExists('ket_qua_hop_tac_quoc_te');
    }
}
