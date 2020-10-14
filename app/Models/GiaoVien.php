<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class GiaoVien extends Model
{
    protected $table = 'giao_vien';
    protected $fillable = [
        'nghe_giang_day',
        'co_so_id',
        'ten',
        'gioi_tinh',
        'mon_chung',
        'dan_toc_it_nguoi',
        'giao_su',
        'pho_giao_su',
        'nha_giao_nhan_dan',
        'nha_giao_uu_tu',
        'loai_hop_dong',
        'trinh_do_tien_sy',
        'trinh_do_thac_sy',
        'trinh_do_dai_hoc',
        'trinh_do_cao_dang',
        'trinh_do_trung_cap',
        'trinh_do_khac',
        'trinh_do_ngoai_ngu',
        'trinh_do_tin_hoc',
        'trinh_do_ky_nang_nghe',
        'trinh_do_nghiep_vu_su_pham',
        'ten_lop_dao_tao',
        'thoi_gian_dao_tao',
    ];
    public function getDanhHieuAttribute()
    {
        $danhHieu = '';
        if ($this->attributes['nha_giao_nhan_dan'] == 1) {
            $danhHieu .= "Nhà giáo nhân dân";
        }

        if ($this->attributes['nha_giao_uu_tu'] == 1) {
            if ($danhHieu !== '') {
                $danhHieu .= '<br>';
            }

            $danhHieu .= "Nhà giáo ưu tú";
        }

        return $danhHieu;
    }

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
                'loai_ban_ghi' => GiaoVien::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
            ]);
        });
    }
}
