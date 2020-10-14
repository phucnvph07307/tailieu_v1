<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class DangKyHoatDong extends Model
{
    protected $table = 'thong_tin_dang_ky';

    protected $fillable = [
        'co_so_id',
        'nghe_id',
        'ma_cap_2',
        'quy_mo_tuyen_sinh_TC',
        'quy_mo_tuyen_sinh_SC',
        'nam',
        'dot',
        'trang_thai',
    ];

    // const CREATED_AT = 'create_at';
    // const UPDATED_AT = 'update_at';

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => DangKyHoatDong::class,
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
