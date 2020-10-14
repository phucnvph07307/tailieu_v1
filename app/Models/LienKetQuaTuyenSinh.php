<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class LienKetQuaTuyenSinh extends Model
{
    protected $table = 'lien_ket_qua_tuyen_sinh';
    protected $fillable = [
        'nam',
        'dot',
        'nghe_id',
        'co_so_id',
        'chi_tieu',
        'thuc_tuyen',
        'so_HSSV_tot_nghiep',
        'don_vi_lien_ket',
        'ghi_chu',
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
                'loai_ban_ghi' => LienKetQuaTuyenSinh::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
