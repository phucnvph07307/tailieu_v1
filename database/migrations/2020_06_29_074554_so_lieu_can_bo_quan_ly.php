<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SoLieuCanBoQuanLy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_lieu_can_bo_quan_ly', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_dao_tao_id');
            $table->bigInteger('trang_thai_id');
            $table->year('nam');
            $table->integer('dot');
            $table->integer('tong_so_quan_ly')->nullable();
            $table->integer('so_cb_quan_ly_nu')->nullable();
            $table->integer('so_cb_giang_day')->nullable();
            $table->integer('so_cb_da_boi_duong')->nullable();
            $table->integer('so_danh_hieu')->nullable();
            $table->integer('so_hieu_truong')->nullable();
            $table->integer('so_hieu_pho')->nullable();
            $table->integer('so_truong_khoa')->nullable();
            $table->integer('so_to_truong')->nullable();
            $table->integer('so_trinh_do_tien_sy')->nullable();
            $table->integer('so_trinh_do_thac_sy')->nullable();
            $table->integer('so_trinh_do_dai_hoc')->nullable();
            $table->integer('so_trinh_do_cao_dang')->nullable();
            $table->integer('so_trinh_do_trung_cap')->nullable();
            $table->integer('so_trinh_do_khac')->nullable();
            $table->integer('so_dan_toc')->nullable();
            $table->integer('so_pho_phong')->nullable();
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
        Schema::dropIfExists('so_lieu_can_bo_quan_ly');
    }
}
