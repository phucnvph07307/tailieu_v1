<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiayPhepDangKyNghe extends Model
{
    protected $table = 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao';

    protected $fillable = [
        'co_so_id',
        'nghe_id',
        'giay_phep_id',
        'trang_thai'
    ];
}
