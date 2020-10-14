<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DangKiChiTieuTuyenSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dang_ki_chi_tieu_tuyen_sinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nghe_id');
            $table->bigInteger('co_so_id');

            $table->dateTime('thoi_gian_cap_nhat');
            $table->year('nam');
            $table->integer('dot');

            $table->integer('so_dang_ki_CD');
            $table->integer('so_dang_ki_TC');

            $table->integer('tong');

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
        Schema::dropIfExists("dang_ki_chi_tieu_tuyen_sinh");
    }
}
