<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanLiSinhVienDangTheoHoc extends Model
{
    protected $table = 'sv_dang_quan_ly';
    protected $fillable = [
        'nam',
        'dot',
        'nghe_id',
        'co_so_id',

        'tong_so_HSSV_co_mat_cac_trinh_do',
        'tong_so_nu',
        'tong_so_dan_toc_thieu_so',
        'tong_so_ho_khau_HN',

        'so_luong_sv_Cao_dang',
        'so_luong_sv_nu_Cao_dang',
        'so_luong_sv_dan_toc_Cao_dang',
        'so_luong_sv_ho_khau_HN_Cao_dang',

        'so_luong_sv_Trung_cap',
        'so_luong_sv_nu_Trung_cap',
        'so_luong_sv_dan_toc_Trung_cap',
        'so_luong_sv_ho_khau_HN_Trung_cap',

        'so_luong_sv_So_cap',
        'so_luong_sv_nu_So_cap',
        'so_luong_sv_dan_toc_So_cap',
        'so_luong_sv_ho_khau_HN_So_cap',

        'so_luong_sv_he_khac',
        'so_luong_sv_nu_khac',
        'so_luong_sv_dan_toc_khac',
        'so_luong_sv_ho_khau_HN_khac',

        'thoi_gian_cap_nhat',
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
                'loai_ban_ghi' => QuanLiSinhVienDangTheoHoc::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
