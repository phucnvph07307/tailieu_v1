<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DevvnQuanhuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devvn_quanhuyen', function (Blueprint $table) {
            $table->string('maqh', 191);
            $table->primary('maqh');
            $table->string('name', 100);
            $table->string('type', 30);
            $table->string('matp', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devvn_quanhuyen');
    }
}
