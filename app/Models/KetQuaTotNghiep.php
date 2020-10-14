<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PheDuyetBaoCao;
use App\CoSoDaoTao;

class KetQuaTotNghiep extends Model
{
    protected $table = 'sv_tot_nghiep';

    public $timestamps = false;

    protected $fillable = [
        'co_so_id',
        'nghe_id',
        'thoi_gian_cap_nhat',
        'nam',
        'dot',
        'Tong_SoNguoi_TN',
        'NU_SV_TN',
        'DanToc_ThieuSo_ItNguoi',
        'HoKhauHN',
        'SoSV_NhapHoc_DauKhoa_TrinhDoCD',
        'SoSV_Du_DieuKienThi_XetTN_TrinhDoCD',
        'SoSV_TN_TrinhDoCD',
        'SoLuong_Nu_SV_CD',
        'SoSV_HoKhauHN_CD',
        'SoLuong_HSSV_TN_Kha_Gioi_CD',
        'SoSV_NhapHoc_DauKhoa_TrinhDoTC',
        'SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC',
        'SoSV_TN_TrinhDoTC',
        'SoLuong_Nu_SV_TC',
        'SoSV_HoKhauHN_TC',
        'SoLuong_HSSV_TN_Kha_Gioi_TC',
        'SoSV_NhapHoc_DauKhoa_TrinhDoSC',
        'SoSV_Du_DieuKienThi_XetTN_TrinhDoSC',
        'SoSV_TN_TrinhDoSC',
        'SoLuong_Nu_SV_SC',
        'SoSV_HoKhauHN_SC',
        'SoLuong_HSSV_TN_Kha_Gioi_SC',
        'SoSV_NhapHoc_DauKhoa_NgheKhac',
        'SoSV_DuKienThi_XetTN_NgheKhac',
        'SoSV_TN_NgheKhac',
        'SoLuong_Nu_SV_NgheKhac',
        'DanToc_ThieuSo_ItNguoi_NgheKhac',
        'SoNguoi_HoKhauHN_NgheKhac',
        'SoNguoi_CoViecLamNgay_SauKhi_TN_CD',
        'CoViecLam_HoKhauHN_TrinhDoCD',
        'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC',
        'CoViecLam_HoKhauHN_TrinhDo_TC',
        'SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC',
        'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC',
        'SoLuong_HoKhauHN_TrinhDoSC',
        'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac',
        'SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac',
        'MucLuong_TB_CD',
        'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD',
        'MucLuong_TB_TC',
        'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC',
        'MucLuong_TB_SC',
        'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC',
        'MucLuong_TB_NgheKhac',
        'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac',
        'DanToc_ThieuSo_ItNguoi_CD',
        'DanToc_ThieuSo_ItNguoi_TC',
        'HoKhau_HN_Thuoc_DoiTuong_TN_TC',
        'DanToc_ThieuSo_ItNguoi_SC',
        'trang_thai',
    ];

    protected static function booted()
    {
        static::created(function ($baoCao) {
            app(PheDuyetBaoCao::class)->create([
                'trang_thai' => 1,
                'ban_ghi_duoc_phe_duyet_id' => $baoCao->id,
                'loai_ban_ghi' => KetQuaTotNghiep::class,
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
