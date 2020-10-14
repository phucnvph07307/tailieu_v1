<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Models\DangKyHoatDong;

class GiaoDucNgheNghiepRepository extends BaseRepository implements GiaoDucNgheNghiepRepositoryInterface
{
    protected $model;

    public function __construct(DangKyHoatDong $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    //lay model
    public function getTable(){
        return 'thong_tin_dang_ky';
    }
    public function index($params, $limit)
    {
        $query = $this->table
        ->join('co_so_dao_tao', 'thong_tin_dang_ky.co_so_id', '=', 'co_so_dao_tao.id')
        ->join('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep', 'co_so_dao_tao.giay_chung_nhan_id', '=', 'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.id')
        ->join('co_quan_chu_quan', 'co_so_dao_tao.co_quan_chu_quan_id', '=', 'co_quan_chu_quan.id')
        ->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
        ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
        ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
        ->select([
            'co_so_dao_tao.id',
            'co_so_dao_tao.ten',
            'co_quan_chu_quan.ten as co_quan_chu_quan',
            'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.quyet_dinh',
            'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.giay_chung_nhan',
            'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.so_ngay_thang_nam_cap_dia_diem_dao_tao',
            'loai_hinh_co_so.loai_hinh_co_so',
            'devvn_quanhuyen.name as quan_huyen',
            'devvn_xaphuongthitran.name as xa_phuong',
        ])
        ->where('thong_tin_dang_ky.nam', $params['nam'])
        ->where('thong_tin_dang_ky.dot', $params['dot']);

        if (isset($params['loai_hinh']) && $params['loai_hinh'] != 0) {
            $query->where('loai_hinh_co_so.id', $params['loai_hinh']);
        }
        if (isset($params['nghe_cap_2']) && $params['nghe_cap_2'] != null) {
            $query->where('thong_tin_dang_ky.nghe_id', 'like', $params['nghe_cap_2'].'%');
        }
        if (isset($params['nghe_cap_3']) && $params['nghe_cap_3'] != null) {
            $query->where('thong_tin_dang_ky.nghe_id', 'like', $params['nghe_cap_3'].'%');
        }
        if (isset($params['nghe_cap_4']) && $params['nghe_cap_4'] != null) {
            $query->whereIn('thong_tin_dang_ky.nghe_id', $params['nghe_cap_4']);
        }
        if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
            $query->where('thong_tin_dang_ky.co_so_id', $params['co_so_id']);
        }
        if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
            $query->where('co_so_dao_tao.maqh', $params['devvn_quanhuyen']);
        }
        if (isset($params['devvn_xaphuongthitran']) && $params['devvn_xaphuongthitran'] != null) {
            $query->where('co_so_dao_tao.xaid', $params['devvn_xaphuongthitran']);
        }

        $data = $query->groupBy('co_so_id')->paginate($limit);
        foreach ($data as $key => $value) {
            $detail = DB::table('thong_tin_dang_ky')->where('thong_tin_dang_ky.co_so_id',$value->id)
            ->where('thong_tin_dang_ky.nam', $params['nam'])
            ->where('thong_tin_dang_ky.dot', $params['dot'])
            ->join('trang_thai', 'thong_tin_dang_ky.trang_thai', '=', 'trang_thai.id')
            ->join('nganh_nghe', 'thong_tin_dang_ky.nghe_id', '=', 'nganh_nghe.id')
            ->select([
                'thong_tin_dang_ky.*',
                'nganh_nghe.ten_nganh_nghe',
                'trang_thai.ten_trang_thai as trang_thai',
                'trang_thai.id as trang_thai_id',
            ]);
            if (isset($params['nghe_cap_2']) && $params['nghe_cap_2'] != null) {
                $detail->where('thong_tin_dang_ky.nghe_id', 'like', $params['nghe_cap_2'].'%');
            }
            if (isset($params['nghe_cap_3']) && $params['nghe_cap_3'] != null) {
                $detail->where('thong_tin_dang_ky.nghe_id', 'like', $params['nghe_cap_3'].'%');
            }
            if (isset($params['nghe_cap_4']) && $params['nghe_cap_4'] != null) {
                $detail->whereIn('thong_tin_dang_ky.nghe_id', $params['nghe_cap_4']);
            }
            $value->detail = $detail->get();
        }
        return $data;
    }

    public function getTenCoSoDaoTao()
    {
        $tencoso = DB::table('co_so_dao_tao')->select('id','ten')->get();
        return $tencoso;
    }
    public function getTenQuanHuyen()
    {
        return DB::table('devvn_quanhuyen')->get();
    }

    public function getXaPhuongTheoQuanHuyen($id)
    {
        if ($id==0){
            $data = DB::table('devvn_xaphuongthitran')
            ->select('devvn_xaphuongthitran.xaid', 'devvn_xaphuongthitran.name')->get();
            return $data;
        }else{
            $data = DB::table('devvn_xaphuongthitran')
            ->where('maqh', '=', $id)
            ->select('devvn_xaphuongthitran.xaid', 'devvn_xaphuongthitran.name')->get();
            return $data;
        }
    }

    public function getNganhNghe($ma_cap_nghe){
        $data = DB::table('nganh_nghe')->where('ma_cap_nghe',$ma_cap_nghe)->orderBy('ten_nganh_nghe')->get();
        return $data;
    }

    public function edit($id)
    {
        $result = $this->table->where('thong_tin_dang_ky.id', '=', $id)
        ->join('nganh_nghe', 'thong_tin_dang_ky.nghe_id', '=', 'nganh_nghe.id')
        ->join('co_so_dao_tao', 'thong_tin_dang_ky.co_so_id', '=', 'co_so_dao_tao.id')
        ->select('thong_tin_dang_ky.*', 'nganh_nghe.ten_nganh_nghe','co_so_dao_tao.ten')->get()->first();
        return $result;
    }

    public function getNganhNgheThuocCoSo($id)
    {
        $result =DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', '=', $id)
        ->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
        ->select('nganh_nghe.ten_nganh_nghe','nganh_nghe.id')->get();
        return $result;
    }

    public function getCheckTonTaiGiaoDucNgheNghiep($arrcheck)
    {
            $kiem_tra = $this->table->where($arrcheck)->select('thong_tin_dang_ky.id','thong_tin_dang_ky.trang_thai')->first();
            if ($kiem_tra!=null){
                if ($kiem_tra->trang_thai >= 3){
                    return 'tontai';
                };
            }
            return $kiem_tra;
    }

    public function store($getdata)
    {
        return $this->model->create($getdata);
    }

	// thanhnv 6/23/2020
	public function getThongTinDangKyTimeFromTo($id_truong, $fromDate,$toDate)
	{
		$data = DB::table('thong_tin_dang_ky')->where('thong_tin_dang_ky.co_so_id', '=',$id_truong)
		->where('created_at','>=',$fromDate)
		->where('created_at','<=',$toDate)
		->join('nganh_nghe','nganh_nghe.id','=','thong_tin_dang_ky.nghe_id')
		// ->join('co_so_dao_tao','co_so_dao_tao.id','=','thong_tin_dang_ky.co_so_id')
		->get();
		return $data;
	}

	public function getGiaoDucNgheNghiepCsNamDot($id_truong, $year,$dot)
	{
		$data =  DB::table('thong_tin_dang_ky')->where('co_so_id', '=', $id_truong)
		->where('nam','=',$year)
        ->where('dot','=',$dot)
		->orderBy('nghe_id','desc')
        ->select('id','nghe_id')->get();
		return $data;
	}

	public function getAllCsJoinChuQuanVaDangKyGiay()
	{
		$data =  DB::table('co_so_dao_tao')
		->join('co_quan_chu_quan','co_quan_chu_quan.id','=','co_so_dao_tao.co_quan_chu_quan_id')
		->join('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep','co_so_dao_tao.quyet_dinh_id','=','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.id')
		->select('co_so_dao_tao.id','co_so_dao_tao.ten','co_so_dao_tao.ma_loai_hinh_co_so','co_so_dao_tao.giay_chung_nhan_id','co_so_dao_tao.loai_truong','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.quyet_dinh'
		,'co_quan_chu_quan.ten as ten_chu_quan'
		,'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.so_ngay_thang_nam_cap_dia_diem_dao_tao')
		->orderBy('loai_truong', 'asc')
		->get();
		return $data;
    }

	public function getSomeCsJoinChuQuanVaDangKyGiay($listCoSoId)
	{
		$data =  DB::table('co_so_dao_tao')->whereIn('co_so_dao_tao.id', $listCoSoId)
		->join('co_quan_chu_quan','co_quan_chu_quan.id','=','co_so_dao_tao.co_quan_chu_quan_id')
		->join('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep','co_so_dao_tao.quyet_dinh_id','=','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.id')
		->select('co_so_dao_tao.id','co_so_dao_tao.ten','co_so_dao_tao.ma_loai_hinh_co_so','co_so_dao_tao.giay_chung_nhan_id','co_so_dao_tao.loai_truong','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.quyet_dinh'
		,'co_quan_chu_quan.ten as ten_chu_quan'
		,'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.so_ngay_thang_nam_cap_dia_diem_dao_tao')
		->orderBy('loai_truong', 'asc')
		->get();
		return $data;
    }

	public function getOnlyOneCsJoinChuQuanVaDangKyGiay($id_coso)
	{
		$data =    DB::table('co_so_dao_tao')->where('co_so_dao_tao.id', $id_coso)
		->join('co_quan_chu_quan','co_quan_chu_quan.id','=','co_so_dao_tao.co_quan_chu_quan_id')
        ->join('giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep','co_so_dao_tao.quyet_dinh_id','=','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.id')
        ->select('co_so_dao_tao.id','co_so_dao_tao.ten','co_so_dao_tao.ma_loai_hinh_co_so','co_so_dao_tao.giay_chung_nhan_id','co_so_dao_tao.loai_truong','giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.quyet_dinh'
        ,'co_quan_chu_quan.ten as ten_chu_quan'
        ,'giay_chung_nhan_dang_ky_hoat_dong_giao_duc_nghe_nghiep.so_ngay_thang_nam_cap_dia_diem_dao_tao')
        ->orderBy('loai_truong', 'asc')
        ->first();
		return $data;
	}
}
