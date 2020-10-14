<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoaiHinhCoSo;
use App\Models\SoLieuCanBoQuanLy;
use App\Models\DoiNguNhaGiao;
use App\Models\NganhNghe;
use App\Models\GiayPhepDangKyNghe;

class CoSoDaoTao extends Model
{
    protected $table = 'co_so_dao_tao';
    protected $fillable = [
        // 'ten', 'ma_don_vi', 'dien_thoai', 'fax', 'website', 'dia_chi',
        // 'ten_quoc_te', 'ghi_chu', 'co_quan_chu_quan_id', 'ma_loai_hinh_co_so',
        // 'quyet_dinh_id'
    ];

    public function loaiHinhCoSo()
    {
        return $this->belongsTo(LoaiHinhCoSo::class, 'ma_loai_hinh_co_so');
    }

    public function soLieuCanBoQuanLy()
    {
        return $this->hasMany(SoLieuCanBoQuanLy::class, 'co_so_dao_tao_id');
    }

    public function doiNguNhaGiao()
    {
        return $this->hasMany(DoiNguNhaGiao::class, 'co_so_id');
    }

    public function nganhNghe()
    {
        return $this->belongsToMany(
            NganhNghe::class,
            'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao',
            'co_so_id',
            'nghe_id'
        );
    }

    public function soLieuDoiNguNhaGiao()
    {
        return $this->hasManyThrough(
            DoiNguNhaGiao::class,
            GiayPhepDangKyNghe::class,
            'co_so_id',
            'nghe_id',
            'id',
            'nghe_id'
        );
    }
}
