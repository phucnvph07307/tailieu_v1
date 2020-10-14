<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\DaoTaoNguoiKhuyetTat;
use Carbon\Carbon;

class DaoTaoNgheChoNguoiKhuyetTatRepository extends BaseRepository implements DaoTaoNgheChoNguoiKhuyetTatRepositoryInterface {

	// thanhnv 6/26/2020 model
	protected $model;

	public function __construct(DaoTaoNguoiKhuyetTat $model)
	{
		parent::__construct();
		$this->model = $model;
    }


	//lay model
	public function getTable(){
		return 'ket_qua_dao_tao_nguoi_khuyet_tat';
	}

    public function index($params, $limit)
    {
        $query = $this->table
        ->join('co_so_dao_tao', 'ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', '=', 'co_so_dao_tao.id')
        ->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
        ->join('trang_thai', 'ket_qua_dao_tao_nguoi_khuyet_tat.trang_thai', '=', 'trang_thai.id')
        ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
        ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
        ->select([
            DB::raw("
                SUM(ket_qua_dao_tao_nguoi_khuyet_tat.tong_tuyen_sinh) as tong_tuyen_sinh,
                SUM(ket_qua_dao_tao_nguoi_khuyet_tat.tong_tot_nghiep) as tong_tot_nghiep,
                SUM(ket_qua_dao_tao_nguoi_khuyet_tat.tong_ngan_sach) as tong_ngan_sach
            "),
            'trang_thai.ten_trang_thai as trang_thai',
            'trang_thai.id as trang_thai_id',
            'co_so_dao_tao.id',
            'co_so_dao_tao.ten',
            'loai_hinh_co_so.loai_hinh_co_so',
            'devvn_quanhuyen.name as quan_huyen',
            'devvn_xaphuongthitran.name as xa_phuong',
        ])
        ->where('ket_qua_dao_tao_nguoi_khuyet_tat.nam', $params['nam'])
        ->where('ket_qua_dao_tao_nguoi_khuyet_tat.dot', $params['dot']);

		if (isset($params['loai_hinh']) && $params['loai_hinh'] != 0) {
			$query->where('loai_hinh_co_so.id', $params['loai_hinh']);
		}

		if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
			$query->where('ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', $params['co_so_id']);
		}
		if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
			$query->where('co_so_dao_tao.maqh', $params['devvn_quanhuyen']);
		}
		if (isset($params['devvn_xaphuongthitran']) && $params['devvn_xaphuongthitran'] != null) {
			$query->where('co_so_dao_tao.xaid', $params['devvn_xaphuongthitran']);
		}
		if (isset($params['nghe_cap_2']) && $params['nghe_cap_2'] != null) {
			$query->where('ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id', 'like', $params['nghe_cap_2'].'%');
		}
		if (isset($params['nghe_cap_3']) && $params['nghe_cap_3'] != null) {
			$query->where('ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id', 'like', $params['nghe_cap_3'].'%');
		}
		if (isset($params['nghe_cap_4']) && $params['nghe_cap_4'] != null) {
			$query->whereIn('ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id', $params['nghe_cap_4']);
		}
		return $query->groupBy('co_so_id')->paginate($limit);
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
		if($id==0){
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



    public function getChiTietDaoTaoNgheChoNguoiKhuyetTat($coSoId,$limit,$queryData)
	{
		$data = $this->table
			->where('ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', '=', $coSoId)
			->join('co_so_dao_tao', 'ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', '=', 'co_so_dao_tao.id')
			->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
			->join('nganh_nghe', 'ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id', '=', 'nganh_nghe.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
			->select(
						'ket_qua_dao_tao_nguoi_khuyet_tat.*',
						'nganh_nghe.ten_nganh_nghe'
					);

		if($queryData['nam']!= null){
			$data->where('ket_qua_dao_tao_nguoi_khuyet_tat.nam', $queryData['nam']);
		}
		if($queryData['dot']!=null){
			$data->where('ket_qua_dao_tao_nguoi_khuyet_tat.dot', $queryData['dot']);
		}
		return $data->orderBy('nam','desc')
		->orderBy('dot', 'desc')
		->paginate($limit);

	}
	public function edit($id)
	{
		$result = $this->table->where('ket_qua_dao_tao_nguoi_khuyet_tat.id', '=', $id)
		->join('nganh_nghe', 'ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id', '=', 'nganh_nghe.id')
		->join('co_so_dao_tao', 'ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', '=', 'co_so_dao_tao.id')
		->select('ket_qua_dao_tao_nguoi_khuyet_tat.*', 'nganh_nghe.ten_nganh_nghe','co_so_dao_tao.ten')->get()->first();
		return $result;
	}

	public function getNganhNgheThuocCoSo($id)
	{
		$result =DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', '=', $id)
		->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
		->select('nganh_nghe.ten_nganh_nghe','nganh_nghe.id')->get();
		return $result;
	}

	public function getCheckTonTaiDaoTaoChoNguoiKhuyetTat($arrcheck)
	{
			$kiem_tra = $this->table->where($arrcheck)->select('ket_qua_dao_tao_nguoi_khuyet_tat.id','ket_qua_dao_tao_nguoi_khuyet_tat.trang_thai')->first();
			if($kiem_tra!=null){
				if($kiem_tra->trang_thai >= 3){
					return 'tontai';
				};
			}
			return $kiem_tra;
	}

	public function store($getdata)
	{
		return $this->model->create($getdata);
	}

	public function getKhuyetTatCsNamDotNoJoin($id_truong,$year,$dot){
		$data =  DB::table('ket_qua_dao_tao_nguoi_khuyet_tat')->where('co_so_id', '=', $id_truong)
		->where('nam','=',$year)
		->where('dot','=',$dot)
		->get();
		return $data;
	}

	public function getKhuyetTatFromTo($id_truong, $fromDate,$toDate){
		$data =  DB::table('ket_qua_dao_tao_nguoi_khuyet_tat')->where('ket_qua_dao_tao_nguoi_khuyet_tat.co_so_id', '=',$id_truong)
		->where('thoi_gian_cap_nhat','>=',$fromDate)
		->where('thoi_gian_cap_nhat','<=',$toDate)
		->join('nganh_nghe','nganh_nghe.id','=','ket_qua_dao_tao_nguoi_khuyet_tat.nghe_id')
		->orderBy('nganh_nghe.id','desc')
		->get();
		return $data;
	}

	// thanhnv 6/26/2020 sửa model create update
	public function createDtNguoiKhuyetTat($arrayData){
		return $this->model->create($arrayData);
	}
	public function updateDtNguoiKhuyetTat($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
	}
}
 ?>