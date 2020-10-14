<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GiayPhep extends Model
{
    protected $table = 'giay_phep';

    protected $fillable = [
        'co_so_id',
        'ten_giay_phep',
        'anh_giay_phep',
        'ngay_ban_hanh',
        'ngay_hieu_luc',
        'ngay_het_han',
        'mo_ta'
    ];
    public function setNgayBanHanhAttribute($value)
    {
        $this->attributes['ngay_ban_hanh'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setNgayHieuLucAttribute($value)
    {
        $this->attributes['ngay_hieu_luc'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

    public function setNgayHetHanAttribute($value)
    {
        $this->attributes['ngay_het_han'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
}
