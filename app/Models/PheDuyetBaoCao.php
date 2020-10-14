<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TuyenSinh;
use App\User;
use Carbon\Carbon;
use App\Models\KetQuaTotNghiep;
use App\Models\DangKyHoatDong;
use App\Models\SoLieuCanBoQuanLy;

class PheDuyetBaoCao extends Model
{
    protected $table = 'tien_do_phe_duyet';

    protected $fillable = [
        'trang_thai',
        'li_do_tu_choi',
        'nguoi_phe_duyet_1',
        'nguoi_phe_duyet_2',
        'ban_ghi_duoc_phe_duyet_id',
        'loai_ban_ghi',
        'dot_id',
        'thoi_gian_nop',
        'thoi_gian_phe_duyet_1',
		'thoi_gian_phe_duyet_2',
		'dot_number',
    ];

    public function pheDuyetBaoCao()
    {
        return $this->morphTo(__FUNCTION__, 'loai_ban_ghi', 'ban_ghi_duoc_phe_duyet_id');
    }

    public function nguoiPheDuyetLan1()
    {
        return $this->belongsTo(User::class, 'nguoi_phe_duyet_1');
    }

    public function nguoiPheDuyetLan2()
    {
        return $this->belongsTo(User::class, 'nguoi_phe_duyet_2');
    }

    public function getLoaiBaoCaoAttribute($value)
    {
        $loaiBanGhi = 'Báo cáo';
        switch ($this->loai_ban_ghi) {
            case TuyenSinh::class:
                $loaiBanGhi = 'Báo cáo Số liệu Tuyển Sinh';
                break;

            case KetQuaTotNghiep::class:
                $loaiBanGhi = 'Báo cáo Số liệu Tốt Nghiệp';
                break;

            case DangKyHoatDong::class:
                $loaiBanGhi = 'Báo cáo Đăng kí Hoạt động Giáo dục';
                break;

            case SoLieuCanBoQuanLy::class:
                $loaiBanGhi = 'Báo cáo Số liệu Đội ngũ Quản lý';
                break;

            case ChinhSachSinhVien::class:
                $loaiBanGhi = 'Báo cáo Chính sách sinh viên';
                break;

            case DoiNguNhaGiao::class:
                $loaiBanGhi = 'Báo cáo Số liệu Đội ngũ Nhà giáo';
                break;

            case ChiTieuTuyenSinh::class:
                $loaiBanGhi = 'Báo cáo Chỉ tiêu tuyển sinh';
                break;

            case GiaoVien::class:
                $loaiBanGhi = 'Báo cáo Đội ngũ Nhà giáo GDNN';
                break;

            case KetQuaDaoTaoChoThanhNien::class:
                $loaiBanGhi = 'Báo cáo Kết quả Đào tạo Nghề cho thanh niên';
                break;

            case DaoTaoNguoiKhuyetTat::class:
                $loaiBanGhi = 'Báo cáo Đào tạo Nghề cho người khuyết tật';
                break;

            case KetQuaXayDungChuongTrinh::class:
                $loaiBanGhi = 'Báo cáo Kết quả xây dựng chương trình';
                break;

            case KetQuaHopTacQuocTe::class:
                $loaiBanGhi = 'Báo cáo Kết quả hợp tác quốc tế';
                break;

            case KetQuaTuyenSinhVoiDoanhNghiep::class:
                $loaiBanGhi = 'Báo cáo Kết quả tuyển sinh gắn với Doanh nghiệp';
                break;

            case KetQuaTotNghiepVoiDoanhNghiep::class:
                $loaiBanGhi = 'Báo cáo Kết quả tốt nghiệp gắn với Doanh nghiệp';
                break;

            case LienKetQuaTuyenSinh::class:
                $loaiBanGhi = 'Báo cáo Liên kết qua Tuyển Sinh';
                break;

            default:
                break;
        }

        return $loaiBanGhi;
    }

    public function trangThaiPheDuyet()
    {
        return $this->belongsTo(TrangThai::class, 'trang_thai');
    }

    public function getThoiGianNopAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-yy');
    }

    public function getThoiGianPheDuyet1Attribute($value)
    {
        if (!$value) {
            return $value;
        }

        return Carbon::parse($value)->format('d-m-yy');
    }

    public function getThoiGianPheDuyet2Attribute($value)
    {
        if (!$value) {
            return $value;
        }

        return Carbon::parse($value)->format('d-m-yy');
    }

    public function getChiTietBaoCaoAttribute()
    {
        $nam = Carbon::now()->year;
        $dot = Carbon::now()->month < 6 ? 1 : 2;
        $url = '';

        switch ($this->loai_ban_ghi) {
            case TuyenSinh::class:
                $url = route('chitietsolieutuyensinh', [
                    $this->pheDuyetBaoCao->coSoDaoTao->id,
                    'nam' => $nam,
                    'dot' => $dot,
                ]);
                break;

            case KetQuaTotNghiep::class:
                $url = route('xuatbc.chi-tiet-tong-hop', [
                    $this->pheDuyetBaoCao->coSoDaoTao->id,
                    'nam' => $nam,
                    'dot' => $dot,
                ]);
                break;

            case DangKyHoatDong::class:
                $url = route('xuatbc.quan-ly-giao-duc-nghe-nghiep', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                    'nam' => $nam,
                    'dot' => $dot,
                ]);
                break;

            case SoLieuCanBoQuanLy::class:
                $url = route('so-lieu-can-bo-quan-ly.show', [
                    $this->ban_ghi_duoc_phe_duyet_id,
                ]);
                break;

            case ChinhSachSinhVien::class:
                $url = route('xuatbc.tong-hop-chinh-sach-sinh-vien');
                break;

            case DoiNguNhaGiao::class:
                $url = route('xuatbc.chi-tiet-theo-co-so', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case ChiTieuTuyenSinh::class:
                $url = route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case GiaoVien::class:
                $url = route('ql-giao-vien.index');
                break;

            case KetQuaDaoTaoChoThanhNien::class:
                $url = route('nhapbc.dao-tao-thanh-nien.show', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case DaoTaoNguoiKhuyetTat::class:
                $url = route('nhapbc.dao-tao-khuyet-tat.show', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case KetQuaXayDungChuongTrinh::class:
                $url = route('xuatbc.show-ds-xd-giao-trinh', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case KetQuaHopTacQuocTe::class:
                $url = route('xuatbc.chi-tiet-ds-hop-tac-qte', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case KetQuaTuyenSinhVoiDoanhNghiep::class:
                $url = route('xuatbc.dao-tao-nghe-doanh-nghiep.show', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case KetQuaTotNghiepVoiDoanhNghiep::class:
                $url = route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case QuanLiSinhVienDangTheoHoc::class:
                $url = route('xuatbc.chi-tiet-so-lieu', [
                    'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                ]);
                break;

            case LienKetQuaTuyenSinh::class:
                // $url = route('xuatbc.post-them-lien-ket-dao-tao', [
                //     'co_so_id' => $this->pheDuyetBaoCao->coSoDaoTao->id,
                // ]);
                break;

            default:
                break;
        }

        return $url;
    }
}
