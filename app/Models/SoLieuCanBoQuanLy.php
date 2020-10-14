<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class SoLieuCanBoQuanLy extends Model
{
    protected $table = 'so_lieu_can_bo_quan_ly';
    protected $primaryKey = 'id';

    protected $fillable = [
        'co_so_dao_tao_id',
        'loai_hinh_co_so_id',
        'trang_thai_id',
        'nam',
        'dot',
        'tong_so_quan_ly',
        'so_cb_quan_ly_nu',
        'so_cb_giang_day',
        'so_cb_da_boi_duong',
        'so_danh_hieu',
        'so_hieu_truong',
        'so_hieu_pho',
        'so_truong_khoa',
        'so_to_truong',
        'so_trinh_do_tien_sy',
        'so_trinh_do_thac_sy',
        'so_trinh_do_dai_hoc',
        'so_trinh_do_cao_dang',
        'so_trinh_do_trung_cap',
        'so_trinh_do_khac',
        'so_dan_toc',
        'so_pho_phong',
    ];

    public function coSoDaoTao()
    {
        return $this->belongsTo(CoSoDaoTao::class, 'co_so_dao_tao_id', 'id');
    }

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => SoLieuCanBoQuanLy::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
