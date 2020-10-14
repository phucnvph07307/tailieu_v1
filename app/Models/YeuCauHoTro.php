<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class YeuCauHoTro extends Model
{
    protected $table = 'yeu_cau_ho_tro';
    protected $fillable = [
        'tieu_de', 'noi_dung', 'trang_thai',
        'nguoi_gui_id', 'ten_nguoi_gui', 'email_nguoi_gui',
        'so_dien_thoai_nguoi_gui', 'phan_hoi_boi', 'noi_dung_phan_hoi'
    ];

    public function nguoiPhanHoi(){
        return $this->belongsTo(User::class, 'phan_hoi_boi', 'id');
    }

    public function listnguoiPhanHoi(){
        return $this->belongsTo(User::class, 'phan_hoi_boi');
    }
}
