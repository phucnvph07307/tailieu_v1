<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class KetQuaTotNghiepVoiDoanhNghiep extends Model
{
    protected $table = 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep';
    protected $fillable = [
        'nam',
        'dot',
        'nghe_id',
        'co_so_id',

        'tong_HSSV_tot_nghiep',
        'nhap_hoc_dau_tot_nghiep_CD',
        'tot_nghiep_CD',
        'nhap_hoc_dau_tot_nghiep_TC',
        'tot_nghiep_TC',
        'nhap_hoc_dau_tot_nghiep_SC',
        'tot_nghiep_SC',

        'duoi_3_thang_tot_nghiep_nhap_hoc_dau',
        'duoi_3_thang_tot_nghiep',
        'ten_doanh_nghiep',
        'so_HSSV_duoc_tuyen_dung',
        'muc_luong_doanh_nghiep_tra',
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
                'loai_ban_ghi' => KetQuaTotNghiepVoiDoanhNghiep::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
