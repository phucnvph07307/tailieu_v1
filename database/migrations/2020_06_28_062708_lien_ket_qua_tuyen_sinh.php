<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class LienKetQuaTuyenSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lien_ket_qua_tuyen_sinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('nam');
            $table->integer('dot');
            $table->dateTime('thoi_gian_cap_nhat');
            $table->bigInteger('co_so_id');
            $table->bigInteger('nghe_id');

            $table->integer('chi_tieu')->nullable();
            $table->integer('thuc_tuyen')->nullable();
            $table->integer('so_HSSV_tot_nghiep')->nullable();

            $table->string('don_vi_lien_ket', 255)->nullable();
            $table->longText('ghi_chu')->nullable();
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
        Schema::dropIfExists('lien_ket_qua_tuyen_sinh ');
    }
}
