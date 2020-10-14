<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class ChiTieuTuyenSinh extends Model
{
    protected $table = 'dang_ki_chi_tieu_tuyen_sinh';
    protected $fillable = [
        'nam',
        'dot',
        'nghe_id',
        'co_so_id',
        'tong',
        'so_dang_ki_CD',
        'so_dang_ki_TC',
    ];

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => ChiTieuTuyenSinh::class,
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
