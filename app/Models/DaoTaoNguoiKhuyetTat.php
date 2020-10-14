<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class DaoTaoNguoiKhuyetTat extends Model
{
    protected $table = 'ket_qua_dao_tao_nguoi_khuyet_tat';
    protected $fillable = [
        'nam',
        'dot',
        'nghe_id',
        'co_so_id',
        'tong_tuyen_sinh',
        'tuyen_sinh_nu',
        'tuyen_sinh_ho_khau_HN',
        'tong_tot_nghiep',
        'tot_nghiep_nu',
        'tot_nghiep_ho_khau_HN',
        'tong_ngan_sach',
        'ngan_sach_TW',
        'ngan_sach_TP',
        'ngan_sach_khac',
    ];

    public function coSoDaoTao()
    {
        return $this->belongsTo(CoSoDaoTao::class, 'co_so_id');
    }

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => DaoTaoNguoiKhuyetTat::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
