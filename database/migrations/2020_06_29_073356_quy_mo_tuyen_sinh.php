<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class QuyMoTuyenSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quy_mo_tuyen_sinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chung_nhan_id');
            $table->integer('ma_cap_loai')->nullable();
            $table->integer('so_ma')->nullable();
            $table->integer('quy_mo_tuyen_sinh')->nullable();
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
        Schema::dropIfExists('quy_mo_tuyen_sinh');
    }
}
