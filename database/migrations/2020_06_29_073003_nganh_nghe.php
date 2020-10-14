<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NganhNghe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nganh_nghe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_nganh_nghe', 255);
            $table->integer('bac_nghe');
            $table->integer('ma_cap_nghe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nganh_nghe');
    }
}
