<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GiaoVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giao_vien', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('ten', 255);
            $table->bigInteger('co_so_id');
            $table->bigInteger('trinh_do_id');
            $table->bigInteger('nghe_id');

            $table->string('gioi_tinh', 255)->nullable();

            $table->string('mon_chung')->nullable();
            $table->integer('dan_toc_it_nguoi')->nullable();
            $table->integer('giao_su')->nullable();
            $table->integer('pho_giao_su')->nullable();
            $table->integer('nha_giao_nhan_dan')->nullable();
            $table->integer('nha_giao_uu_tu')->nullable();
            $table->integer('loai_hop_dong')->nullable();

            $table->integer('trinh_do_ngoai_ngu')->nullable();
            $table->integer('trinh_do_tin_hoc')->nullable();
            $table->integer('trinh_do_ky_nang_nghe')->nullable();
            $table->integer('trinh_do_nghiep_vu_su_pham')->nullable();

            $table->string('ten_lop_dao_tao', 255)->nullable();
            $table->string('thoi_gian_dao_tao', 255)->nullable();
            $table->string('nghe_giang_day', 255)->nullable();

            $table->string('trinh_do_tien_sy', 255)->nullable();
            $table->string('trinh_do_thac_sy', 255)->nullable();
            $table->string('trinh_do_dai_hoc', 255)->nullable();
            $table->string('trinh_do_cao_dang', 255)->nullable();
            $table->string('trinh_do_trung_cap', 255)->nullable();
            $table->string('trinh_do_khac', 255)->nullable();

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
        Schema::dropIfExists('giao_vien');
    }
}
