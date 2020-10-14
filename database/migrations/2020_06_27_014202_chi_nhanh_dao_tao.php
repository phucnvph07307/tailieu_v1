<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChiNhanhDaoTao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_nhanh_dao_tao', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->longText('dia_chi')->nullable();
            $table->string('hotline', 255)->nullable();
            $table->integer('chi_nhanh_chinh')->nullable();
            $table->integer('ma_chung_nhan_dang_ki_hoat_dong')->nullable();
            $table->integer('da_duoc_cap')->nullable();
            $table->string('maqh')->nullable();
            $table->string('xaid')->nullable();
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
        Schema::dropIfExists('chi_nhanh_dao_tao');
    }
}
