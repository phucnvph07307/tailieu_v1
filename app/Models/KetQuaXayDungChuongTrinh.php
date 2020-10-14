<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CoSoDaoTao;

class KetQuaXayDungChuongTrinh extends Model
{
    protected $table = 'ket_qua_xay_dung_chuong_trinh_giao_trinh';

    protected $fillable = [
        'co_so_id',
        'thoi_gian_cap_nhat',
        'nam',
        'dot',
        'nghe_id',
        'XD_chuong_trinh_moi_CD',
        'XD_chuong_trinh_moi_TC',
        'XD_chuong_trinh_moi_SC',
        'XD_giao_trinh_moi_CD',
        'XD_giao_trinh_moi_TC',
        'XD_giao_trinh_moi_SC',
        'sua_chuong_trinh_CD',
        'sua_chuong_trinh_TC',
        'sua_chuong_trinh_SC',
        'sua_giao_trinh_CD',
        'sua_giao_trinh_TC',
        'sua_giao_trinh_SC',
        'tong_so_XD_chuong_trinh_moi',
        'tong_so_XD_giao_trinh_moi',
        'kinh_phi_thuc_hien_xd_moi',
        'tong_so_chuong_trinh_chinh_sua',
        'tong_so_giao_trinh_chinh_sua',
        'kinh_phi_thuc_hien_chinh_sua',
        'trang_thai',
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
                'loai_ban_ghi' => KetQuaXayDungChuongTrinh::class,
                'dot_id' => 1,
                'thoi_gian_phe_duyet_1' => null,
                'thoi_gian_phe_duyet_2' => null,
                'dot_number' => $baoCao->nam*1000 + $baoCao->dot,
            ]);
        });
    }
}
