<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteSoLieuDoiNguQuanLi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        //Không sử dụng tới bảng này nên phải xóa - Xuan4t
        Schema::dropIfExists('so_lieu_doi_ngu_quan_ly');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
