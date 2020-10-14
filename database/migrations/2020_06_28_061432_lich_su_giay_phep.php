<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class LichSuGiayPhep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_giay_phep', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->string('ten_giay_phep', 255)->nullable();
            $table->string('anh_giay_phep', 255)->nullable();
            $table->date('ngay_ban_hanh')->nullable();
            $table->date('ngay_hieu_luc')->nullable();
            $table->date('ngay_het_han')->nullable();
            $table->string('mo_ta', 255)->nullable();

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
        Schema::dropIfExists('lich_su_giay_phep');
    }
}
