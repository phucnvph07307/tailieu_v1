<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class QuyetDinhThanhLapCsdt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quyet_dinh_thanh_lap_csdt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten', 255);
            $table->string('van_ban_url', 255)->nullable();
            $table->date('ngay_ban_hanh')->nullable();
            $table->date('ngay_hieu_luc')->nullable();
            $table->date('ngay_het_han')->nullable();
            $table->integer('loai_quyet_dinh')->nullable();
            $table->string('anh_quyet_dinh', 255)->nullable();
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
        Schema::dropIfExists('quyet_dinh_thanh_lap_csdt');
    }
}
