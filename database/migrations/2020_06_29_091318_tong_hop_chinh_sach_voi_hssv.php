<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TongHopChinhSachVoiHssv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tong_hop_chinh_sach_voi_hssv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('co_so_id');
            $table->bigInteger('chinh_sach_id');
            $table->dateTime('thoi_gian_nhap');
            $table->year('nam');
            $table->integer('dot');
            $table->integer('tong_so_hssv')->nullable();
            $table->integer('so_hssv_TC')->nullable();
            $table->integer('so_hssv_CD')->nullable();
            $table->bigInteger('kinh_phi')->nullable();
            $table->bigInteger('kinh_phi_TC')->nullable();
            $table->bigInteger('kinh_phi_CD')->nullable();
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
        Schema::dropIfExists('tong_hop_chinh_sach_voi_hssv');
    }
}
