<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CoSoDaoTao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("co_so_dao_tao", function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('giay_chung_nhan_id');
            $table->string('ten', 255);
            $table->string('ma_don_vi', 255);
            $table->bigInteger('co_quan_chu_quan_id');
            $table->bigInteger('ma_loai_hinh_co_so');
            $table->bigInteger('quyet_dinh_id');
            $table->string('maqh', 255)->nullable();
            $table->string('xaid', 255)->nullable();

            $table->string('logo')->nullable();
            $table->string('dien_thoai')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->longText('dia_chi')->nullable();
            $table->string('ten_quoc_te')->nullable();
            $table->longText('ghi_chu')->nullable();

            $table->integer('loai_truong')->default(1);
            $table->integer('bac_dao_tao')->default(6);

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
        Schema::dropIfExists("co_so_dao_tao");
    }
}
