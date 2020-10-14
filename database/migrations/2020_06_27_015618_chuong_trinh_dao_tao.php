<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChuongTrinhDaoTao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuong_trinh_dao_tao', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');

            $table->dateTime('thoi_gian_bao_cao');
            $table->integer('tong_so')->nullable();
            $table->integer('so_chuong_trinh_cao_dang')->nullable();
            $table->integer('so_chuong_trinh_trung_cap')->nullable();
            $table->integer('so_chuong_trinh_so_cap')->nullable();
            $table->integer('hinh_thuc')->nullable();
            $table->integer('loai_tai_nguyen')->nullable();
            $table->bigInteger('kinh_phi')->nullable();
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
        Schema::dropIfExists('chuong_trinh_dao_tao');
    }
}
