<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTienDoPheDuyetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tien_do_phe_duyet', function (Blueprint $table) {
            $table->id();
            $table->integer('trang_thai')
                ->default(config('common.phe_duyet.trang_thai.cho_phe_duyet'));
            $table->text('li_do_tu_choi')->default('');
            $table->bigInteger('nguoi_phe_duyet_1');
            $table->bigInteger('nguoi_phe_duyet_2');
            $table->bigInteger('ban_ghi_duoc_phe_duyet_id');
            $table->string('loai_ban_ghi');
            $table->bigInteger('dot_id');

            // FYI: https://stackoverflow.com/a/20822267/5938111
            $table->datetime('thoi_gian_nop')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->datetime('thoi_gian_phe_duyet_1')
                ->nullable()
                ->default(DB::raw('CURRENT_TIMESTAMP(0)'));

            $table->datetime('thoi_gian_phe_duyet_2')
                ->nullable()
                ->default(DB::raw('CURRENT_TIMESTAMP(0)'));

            $table->timestamps();
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
