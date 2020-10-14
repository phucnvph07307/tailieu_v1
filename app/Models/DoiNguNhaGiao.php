<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;
use App\Models\PheDuyetBaoCao;

class DoiNguNhaGiao extends Model
{
    protected $table = 'so_lieu_doi_ngu_nha_giao';
    protected $fillable = [
        'co_so_id',
        'nghe_id',
        'nam',
        'dot',
        'tong_so_can_bo',
        'so_luong_nu',
        'dan_toc_it_nguoi',
        'giao_su',
        'pho_giao_su',
        'NGND_NSND_NNND_TTND',
        'NGUT_NSUT_NNUT_TTUT',
        'nha_giao_giang_day_mon_hoc_chung',
        'bien_che',
        'hop_dong_1_nam_tro_len',
        'so_tien_sy',
        'so_thac_si',
        'so_dai_hoc',
        'so_cao_dang',
        'so_trung_cap',
        'so_khac',
        'bac1',
        'bac2',
        'bac3',
        'bac4',
        'bac5',
        'bac6',
        'trinh_do_tin_hoc_co_ban',
        'trinh_do_tin_hoc_nang_cao',
        'chung_chi_KNN_quoc_gia_bac_1',
        'chung_chi_KNN_quoc_gia_bac_2',
        'chung_chi_KNN_quoc_gia_bac_3',
        'chung_chi_su_pham_day_trinh_do_CD',
        'chung_chi_su_pham_day_trinh_do_TC',
        'chung_chi_su_pham_day_trinh_do_SC',
        'so_nha_giao_tham_gia_dao_tao',
    ];

    public function coSoDaoTao()
    {
        return $this->belongsTo(CoSoDaoTao::class, 'co_so_id');
    }

    public function nganhNghe()
    {
        return $this->belongsTo(NganhNghe::class, 'nghe_id');
    }

    public function scopeTheoNamDot($query, $nam, $dot)
    {
        return $query->where('so_lieu_doi_ngu_nha_giao.nam', $nam)
            ->where('so_lieu_doi_ngu_nha_giao.dot', $dot);
    }

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => DoiNguNhaGiao::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
