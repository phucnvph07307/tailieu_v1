<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PheDuyetBaoCao;
use App\CoSoDaoTao;

class ChinhSachSinhVien extends Model
{
    protected $table = 'tong_hop_chinh_sach_voi_hssv';
    protected $fillable = [
        'chinh_sach_id',
        'nam',
        'dot',
        'co_so_id',
        'tong_so_hssv',
        'kinh_phi',
        'so_hssv_TC',
        'kinh_phi_TC',
        'so_hssv_CD',
        'kinh_phi_CD',
        'ghi_chu',
        'thoi_gian_nhap',
    ];


    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => ChinhSachSinhVien::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }

    public function coSoDaoTao()
    {
        return $this->belongsTo(CoSoDaoTao::class, 'co_so_id');
    }
}
