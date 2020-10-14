<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TienDoPheDuyet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tien_do_phe_duyet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trang_thai')->default(1);
            $table->longText('li_do_tu_choi');
            $table->bigInteger('nguoi_phe_duyet_1');
            $table->bigInteger('nguoi_phe_duyet_2');
            $table->bigInteger('ban_ghi_duoc_phe_duyet_id');
            $table->string('ban_ghi_duoc_phe_duyet_id', 255);
            $table->bigInteger('dot_id');
            $table->dateTime('thoi_gian_nop');
            $table->dateTime('thoi_gian_phe_duyet_1');
            $table->dateTime('thoi_gian_phe_duyet_2');
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
        Schema::dropIfExists('tien_do_phe_duyet');
    }
}
