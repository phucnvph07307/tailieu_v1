<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ThongTinDangKy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thong_tin_dang_ky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');
            $table->year('nam');
            $table->integer('dot');
            $table->integer('ma_cap_2');
            $table->integer('quy_mo_tuyen_sinh_TC');
            $table->integer('quy_mo_tuyen_sinh_SC');
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
        Schema::dropIfExists('thong_tin_dang_ky');
    }
}
