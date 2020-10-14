<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\TotNghiep;
use App\Models\KetQuaTotNghiep;
use Carbon\Carbon;

class SinhVienTotNghiepRepository extends BaseRepository implements SinhVienTotNghiepInterface
{
	protected $model;

	public function __construct(KetQuaTotNghiep $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	public function getTable(){
		return 'sv_tot_nghiep';
    }

    public function index($params, $limit = 10)
	{
		$query = $this->table
			->join('co_so_dao_tao', 'sv_tot_nghiep.co_so_id', '=', 'co_so_dao_tao.id')
			->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
			->join('trang_thai', 'sv_tot_nghiep.trang_thai', '=', 'trang_thai.id')
			->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
			->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
			->select([
				DB::raw("
					SUM(sv_tot_nghiep.Tong_SoNguoi_TN) as tong_so_nguoi_tn
				"),
				'trang_thai.ten_trang_thai as trang_thai',
				'trang_thai.id as trang_thai_id',
				'co_so_dao_tao.id',
				'co_so_dao_tao.ten',
				'loai_hinh_co_so.loai_hinh_co_so',
				'devvn_quanhuyen.name as quan_huyen',
				'devvn_xaphuongthitran.name as xa_phuong',
			])
			->where('sv_tot_nghiep.nam', $params['nam'])
			->where('sv_tot_nghiep.dot', $params['dot']);

		if (isset($params['loai_hinh']) && $params['loai_hinh'] != 0) {
			$query->where('loai_hinh_co_so.id', $params['loai_hinh']);
		}

		if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
			$query->where('sv_tot_nghiep.co_so_id', $params['co_so_id']);
		}
		if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
			$query->where('co_so_dao_tao.maqh', $params['devvn_quanhuyen']);
		}
		if (isset($params['devvn_xaphuongthitran']) && $params['devvn_xaphuongthitran'] != null) {
			$query->where('co_so_dao_tao.xaid', $params['devvn_xaphuongthitran']);
		}
		if (isset($params['nganh_nghe']) && $params['nganh_nghe'] != null) {
			$query->where('sv_tot_nghiep.nghe_id', 'like', $params['nganh_nghe'].'%');
		}

		return $query->groupBy('co_so_id')->paginate($limit);
	}

    public function getTenCoSoDaoTao()
	{
		$tencoso = DB::table('co_so_dao_tao')->select('id','ten')->get();
		return $tencoso;
    }

	public function getmanganhnghe($id)
	{
		$manganhnghe = DB::table('co_so_dao_tao')->where('co_so_dao_tao.id', '=', $id)
		->join('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao', 'co_so_dao_tao.id', '=', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id')
		->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
		->select('nganh_nghe.id','nganh_nghe.ten_nganh_nghe')->get();
		return $manganhnghe;
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

	public function getNgheTheoCapBac($id, $cap_nghe)
	{
		$data = DB::table('nganh_nghe')->where('id', 'like', $id.'%')->where('ma_cap_nghe', $cap_nghe)->orderBy('ten_nganh_nghe')->get();
		return $data;
	}
	
	public function getChiTietTongHopTotNghiep($coSoId,$limit,$queryData)
	{
		$data = $this->table
			->where('sv_tot_nghiep.co_so_id', '=', $coSoId)
			->join('nganh_nghe', 'sv_tot_nghiep.nghe_id', '=', 'nganh_nghe.id')
			->select(
						'sv_tot_nghiep.*',
						'nganh_nghe.ten_nganh_nghe'
					);

		if($queryData['nam']!= null){
			$data->where('sv_tot_nghiep.nam', $queryData['nam']);
		}
		if($queryData['dot']!=null){
			$data->where('sv_tot_nghiep.dot', $queryData['dot']);
		}
		return $data->orderBy('nam','desc')
		->orderBy('dot', 'desc')
		->paginate($limit);

	}

	public function getSuaSoLieuTotNghiep($id)
	{
		$result = $this->table->where('sv_tot_nghiep.id', '=', $id)
		->join('nganh_nghe', 'sv_tot_nghiep.nghe_id', '=', 'nganh_nghe.id')
		->join('co_so_dao_tao', 'sv_tot_nghiep.co_so_id', '=', 'co_so_dao_tao.id')
		->select('sv_tot_nghiep.*', 'nganh_nghe.ten_nganh_nghe','co_so_dao_tao.ten')->get()->first();
		return $result;
	}

	public function getCheckTonTaiSoLieuTotNghiep($arrcheck)
	{
			$kiem_tra = $this->table->where($arrcheck)->select('sv_tot_nghiep.id','sv_tot_nghiep.trang_thai')->first();
			if($kiem_tra!=null){
				if($kiem_tra->trang_thai >= 3){
					return 'tontai';
				};
			}
			return $kiem_tra;
	}

	public function postThemSoLieuTotNghiep($getdata)
	{
		return $this->model->create($getdata);
	}

	// thanhnv update change to service 6/25/2020
	public function getSvTotNghiepTimeFromTo($id_truong, $fromDate,$toDate){
		$data = DB::table('sv_tot_nghiep')->where('sv_tot_nghiep.co_so_id', '=',$id_truong)
		->where('thoi_gian_cap_nhat','>=',$fromDate)
		->where('thoi_gian_cap_nhat','<=',$toDate)
		->join('nganh_nghe','nganh_nghe.id','=','sv_tot_nghiep.nghe_id')
		->orderBy('nganh_nghe.id','desc')
		->get();
		return $data;
	}
	public function getTotNghiepCsNamDot($id_truong, $year,$dot)
	{
		$data =  DB::table('sv_tot_nghiep')->where('co_so_id', '=', $id_truong)
		->where('nam','=',$year)
		->where('dot','=',$dot)
		->select('id','nghe_id')->get();
		return $data;
	}


	// thanhnv 6/26/2020 sửa model create update
	public function createTotNghiep($arrayData){
		return $this->model->create($arrayData);
	}
	public function updateTotNghiep($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
	}
}
