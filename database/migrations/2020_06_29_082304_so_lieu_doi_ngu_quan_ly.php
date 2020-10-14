<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SoLieuDoiNguQuanLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_lieu_doi_ngu_quan_ly', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->date('thoi_gian_cap_nhat');
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
        Schema::dropIfExists('so_lieu_doi_ngu_quan_ly');
    }
}
