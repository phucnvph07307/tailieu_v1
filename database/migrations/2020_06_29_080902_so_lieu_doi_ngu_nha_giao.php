<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SoLieuDoiNguNhaGiao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_lieu_doi_ngu_nha_giao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->year('nam');
            $table->integer('dot');
            $table->integer('tong_so_can_bo')->nullable();
            $table->integer('so_luong_nu')->nullable();
            $table->integer('dan_toc_it_nguoi')->nullable();
            $table->integer('so_can_bo_quan_li_tham_gia_giang_day')->nullable();
            $table->integer('so_can_bo_da_boi_duong_nghiep_vu')->nullable();
            $table->integer('so_nha_giao_nhan_dan_nha_giao_uu_tu')->nullable();
            $table->integer('hieu_truong')->nullable();
            $table->integer('hieu_pho')->nullable();
            $table->integer('so_truong_khoa')->nullable();
            $table->integer('so_pho_khoa')->nullable();
            $table->integer('so_to_truong_chuyen_mon')->nullable();
            $table->integer('so_tien_sy')->nullable();
            $table->integer('so_thac_si')->nullable();
            $table->integer('so_dai_hoc')->nullable();
            $table->integer('so_cao_dang')->nullable();
            $table->integer('so_trung_cap')->nullable();
            $table->integer('so_khac')->nullable();
            $table->integer('bien_che')->nullable();
            $table->integer('hop_dong_1_nam_tro_len')->nullable();
            $table->integer('bac1')->nullable();
            $table->integer('bac2')->nullable();
            $table->integer('bac3')->nullable();
            $table->integer('bac4')->nullable();
            $table->integer('bac5')->nullable();
            $table->integer('bac6')->nullable();
            $table->integer('chung_chi_KNN_quoc_gia_bac_1')->nullable();
            $table->integer('chung_chi_KNN_quoc_gia_bac_2')->nullable();
            $table->integer('chung_chi_KNN_quoc_gia_bac_3')->nullable();
            $table->integer('chung_chi_su_pham_day_trinh_do_CD')->nullable();
            $table->integer('chung_chi_su_pham_day_trinh_do_TC')->nullable();
            $table->integer('chung_chi_su_pham_day_trinh_do_SC')->nullable();
            $table->integer('giao_su')->nullable();
            $table->integer('pho_giao_su')->nullable();
            $table->integer('NGND_NSND_NNND_TTND')->nullable();
            $table->integer('NGUT_NSUT_NNUT_TTUT')->nullable();
            $table->integer('nha_giao_giang_day_mon_hoc_chung')->nullable();
            $table->integer('so_nha_giao_tham_gia_dao_tao')->nullable();
            $table->integer('trinh_do_tin_hoc_co_ban')->nullable();
            $table->integer('trinh_do_tin_hoc_nang_cao')->nullable();
            $table->integer('tong_so')->nullable();
            $table->integer('trang_thai_id')->default(1);
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
        Schema::dropIfExists('so_lieu_doi_ngu_nha_giao');
    }
}
