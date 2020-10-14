<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\ChiTieuTuyenSinhRepositoryInterface;
use App\Models\ChiTieuTuyenSinh;
use Illuminate\Support\Facades\DB;

class ChiTieuTuyenSinhRepository extends BaseRepository implements ChiTieuTuyenSinhRepositoryInterface
{
    // thanhnv 6/26/2020 create model
    protected $model;

    public function __construct(ChiTieuTuyenSinh $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'dang_ki_chi_tieu_tuyen_sinh';
    }

    /* Danh sách đăng ký chỉ tiêu tuyển sinh.
     * @author: phucnv
     * @created_at 2020-06-17
     */
    public function getDanhSachChiTieuTuyenSinh($params)
    {

        $queryBuilder = $this->table
            ->leftjoin('co_so_dao_tao', 'dang_ki_chi_tieu_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->leftjoin('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
            ->leftjoin('nganh_nghe', 'dang_ki_chi_tieu_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->select(
                'dang_ki_chi_tieu_tuyen_sinh.*',
                DB::raw('SUM(dang_ki_chi_tieu_tuyen_sinh.tong) AS tong_dang_ki_chi_tieu'),
                DB::raw('SUM(dang_ki_chi_tieu_tuyen_sinh.so_dang_ki_CD) AS tong_so_dang_ki_CD'),
                DB::raw('SUM(dang_ki_chi_tieu_tuyen_sinh.so_dang_ki_TC) AS tong_so_dang_ki_TC'),
                DB::raw('co_so_dao_tao.ten as ten'),
                DB::raw('loai_hinh_co_so.loai_hinh_co_so as ten_loai_hinh_co_so'),
                DB::raw('nganh_nghe.id as ma_nghe'),
                DB::raw('nganh_nghe.ten_nganh_nghe as ten_nghe')
            )->groupBy('dang_ki_chi_tieu_tuyen_sinh.co_so_id')
            ->where('dang_ki_chi_tieu_tuyen_sinh.nam', $params['nam'])
            ->where('dang_ki_chi_tieu_tuyen_sinh.dot', $params['dot']);;

        if (isset($params['loaihinhcoso']) && $params['loaihinhcoso'] != null) {
            $queryBuilder->where('loai_hinh_co_so.id', $params['loaihinhcoso']);
        }
        if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
            $queryBuilder->where('dang_ki_chi_tieu_tuyen_sinh.co_so_id', $params['co_so_id']);
        }

        if (isset($params['nghe_id']) && $params['nghe_id'] != null) {
            $queryBuilder->where('dang_ki_chi_tieu_tuyen_sinh.nghe_id', $params['nghe_id']);
        }

        return $queryBuilder->groupBy('co_so_id')->paginate($params['page_size']);
    }


    /* Danh sách chi tiết chỉ tiêu đăng ký tuyển sinh theo cơ sở.
     * @author: phucnv
     * @created_at 2020-06-18
     */
    public function chiTietTheoCoSo($co_so_id, $params)
    {
        $queryBuilder = $this->table
            ->leftjoin('co_so_dao_tao', 'dang_ki_chi_tieu_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->leftjoin('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
            ->leftjoin('nganh_nghe', 'dang_ki_chi_tieu_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->select(
                'dang_ki_chi_tieu_tuyen_sinh.*',
                DB::raw('co_so_dao_tao.ten as ten'),
                DB::raw('loai_hinh_co_so.loai_hinh_co_so as ten_loai_hinh_co_so'),
                DB::raw('nganh_nghe.id as ma_nghe'),
                DB::raw('nganh_nghe.ten_nganh_nghe as ten_nghe')
            )
            ->where('dang_ki_chi_tieu_tuyen_sinh.co_so_id', $co_so_id);

        if (isset($params['nam']) && $params['nam'] != null) {
            $queryBuilder->where('dang_ki_chi_tieu_tuyen_sinh.nam', $params['nam']);
        }
        if (isset($params['dot']) && $params['dot'] != null) {
            $queryBuilder->where('dang_ki_chi_tieu_tuyen_sinh.dot', $params['dot']);
        }
        if (isset($params['nghe_id']) && $params['nghe_id'] != null) {
            $queryBuilder->whereIn('dang_ki_chi_tieu_tuyen_sinh.nghe_id', $params['nghe_id']);
        }

        return $queryBuilder->orderByDesc('dang_ki_chi_tieu_tuyen_sinh.nam')
            ->orderByDesc('dang_ki_chi_tieu_tuyen_sinh.dot')->paginate($params['page_size']);
    }

    /* Danh sách ngành nghề theo ID cơ sở.
     * @author: phucnv
     * @created_at 2020-06-18
     */
    public function getNganhNgheTheoCoSo($co_so_id)
    {
        $nganhnghe = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')
            ->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
            ->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', $co_so_id)
            ->where('nganh_nghe.ma_cap_nghe', 4)
            ->select('nganh_nghe.*')
            ->get();
        return $nganhnghe;
    }

    /* Kiểm tra sự tồn tại của bản ghi đã có 4 trường co_so_id, nghe_id, nam, dot.
     * @author: phucnv
     * @created_at 2020-06-18
     */
    public function checkTonTaiKhiThem($params)
    {
        $kq = $this->table
            ->where('dang_ki_chi_tieu_tuyen_sinh.co_so_id', $params['co_so_id'])
            ->where('dang_ki_chi_tieu_tuyen_sinh.nghe_id', $params['nghe_id'])
            ->where('dang_ki_chi_tieu_tuyen_sinh.nam', $params['nam'])
            ->where('dang_ki_chi_tieu_tuyen_sinh.dot', $params['dot'])
            ->select('dang_ki_chi_tieu_tuyen_sinh.*')
            ->first();

        return $kq;
    }

    // thanhnv 6/21/2020
    public function getDangKiChiTieuTuyenSinhCsNamDot($id_truong, $year, $dot)
    {
        $data =  DB::table('dang_ki_chi_tieu_tuyen_sinh')->where('co_so_id', '=', $id_truong)
            ->where('nam', '=', $year)
            ->where('dot', '=', $dot)
            ->select('id', 'nghe_id')->get();
        return $data;
    }

    public function getDangKiChiTieuTuyenSinhTimeFromTo($id_truong, $fromDate, $toDate)
    {
        $data = DB::table('dang_ki_chi_tieu_tuyen_sinh')->where('dang_ki_chi_tieu_tuyen_sinh.co_so_id', '=', $id_truong)
            ->where('thoi_gian_cap_nhat', '>=', $fromDate)
            ->where('thoi_gian_cap_nhat', '<=', $toDate)
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'dang_ki_chi_tieu_tuyen_sinh.nghe_id')
            ->orderBy('nganh_nghe.id', 'desc')
            ->get();
        return $data;
    }

       	// thanhnv 6/26/2020 sửa model create update
	public function createChiTieuTuyenSinh($arrayData){
		return $this->model->create($arrayData);
	}
	public function updateChiTieuTuyenSinh($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }
}
