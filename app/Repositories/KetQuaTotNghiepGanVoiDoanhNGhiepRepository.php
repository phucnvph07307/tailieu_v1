<?php

namespace App\Repositories;


use Illuminate\Support\Facades\DB;
use App\Models\KetQuaTotNghiepVoiDoanhNghiep;
class KetQuaTotNghiepGanVoiDoanhNghiepRepository extends BaseRepository implements KetQuaTotNghiepGanVoiDoanhNghiepRepositoryInterface
{
    protected $model;

	public function __construct(KetQuaTotNghiepVoiDoanhNghiep $model)
	{
		parent::__construct();
		$this->model = $model;
    }


    public function getTable()
    {
        return 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep';
    }

    public function getKetQuaTotNghiepGanVoiDoanhNghiep($params, $limit = 20)
    {

        $query = $this->table
            ->join('co_so_dao_tao', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nghe_id', '=', 'nganh_nghe.id')
            ->join('trang_thai', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.trang_thai', '=', 'trang_thai.id')
            ->select([
                DB::raw('SUM(ket_qua_tot_nghiep_gan_voi_doanh_nghiep.tong_HSSV_tot_nghiep) AS tong_tot_nghiep'),
                DB::raw('SUM(ket_qua_tot_nghiep_gan_voi_doanh_nghiep.so_HSSV_duoc_tuyen_dung) AS tong_tuyen_dung'),
                DB::raw('SUM(ket_qua_tot_nghiep_gan_voi_doanh_nghiep.muc_luong_doanh_nghiep_tra) AS tong_muc_luong'),
                'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',

            ])->groupBy('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id')
            ->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nam', $params['nam'])
            ->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.dot', $params['dot']);

        if (isset($params['loai_hinh']) && !empty($params['loai_hinh'])) {
            $query->where('ma_loai_hinh_co_so', $params['loai_hinh']);
        }
        if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
            $query->where('co_so_id', $params['co_so_id']);
        }
        if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
            $query->where('maqh', $params['devvn_quanhuyen']);
        }
        if (isset($params['nganh_nghe']) && $params['nganh_nghe'] != null) {
            $query->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nghe_id', 'like', $params['nganh_nghe'] . '%');
        }

        return $query->groupBy('co_so_id')->paginate($limit);
    }

    public function getCoSo()
    {
        return DB::table('co_so_dao_tao')->get();
    }

    public function getTenQuanHuyen()
    {
        return DB::table('devvn_quanhuyen')->get();
    }
    public function getXaPhuongTheoQuanHuyen($id)
    {
        if ($id == 0) {
            $data = DB::table('devvn_xaphuongthitran')
                ->select('devvn_xaphuongthitran.xaid', 'devvn_xaphuongthitran.name')->get();
            return $data;
        } else {
            $data = DB::table('devvn_xaphuongthitran')
                ->where('maqh', '=', $id)
                ->select('devvn_xaphuongthitran.xaid', 'devvn_xaphuongthitran.name')->get();
            return $data;
        }
    }

    public function getNganhNghe($ma_cap_nghe)
    {
        $data = DB::table('nganh_nghe')->where('ma_cap_nghe', $ma_cap_nghe)->orderBy('ten_nganh_nghe')->get();
        return $data;
    }

    public function getNgheTheoCapBac($id, $cap_nghe)
    {
        $data = DB::table('nganh_nghe')->where('id', 'like', $id . '%')->where('ma_cap_nghe', $cap_nghe)->orderBy('ten_nganh_nghe')->get();
        return $data;
    }

    public function getLoaiHinhCoSo()
    {
        $loai_hinh = DB::table('loai_hinh_co_so')->get();
        return $loai_hinh;
    }

    public function ChiTietKetQuaTotNghiepGanVoiDoanhNghiep($co_so_id, $queryData, $limit)
    {
        $data = $this->table

            ->join('co_so_dao_tao', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nghe_id', '=', 'nganh_nghe.id')
            ->join('trang_thai', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.trang_thai', '=', 'trang_thai.id')
            ->select([
                'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',
                'nganh_nghe.ten_nganh_nghe',
                'trang_thai.ten_trang_thai'
            ])
            ->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id', '=', $co_so_id);

        if ($queryData['nam'] != null) {
            $data->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nam', $queryData['nam']);
        }
        if ($queryData['dot'] != null) {
            $data->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.dot', $queryData['dot']);
        }
        return $data->orderBy('nam', 'desc')
            ->orderBy('dot', 'desc')
            ->paginate($limit);
    }

    public function findCoSoDaoTao($co_so_id)
    {
        $data = DB::table('co_so_dao_tao')
            ->where('co_so_dao_tao.id', '=', $co_so_id)
            ->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
            ->select(
                'co_so_dao_tao.ten',
                'co_so_dao_tao.dia_chi',
                'loai_hinh_co_so.loai_hinh_co_so',
                'devvn_quanhuyen.name as ten_quan_huyen',
                'devvn_xaphuongthitran.name as ten_xa_phuong'
            )
            ->first();
        return $data;
    }

    public function SuaKetQuaTotNghiepGanVoiDoanhNghiep($id)
    {
        $query = $this->table
            ->join('co_so_dao_tao', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nghe_id', '=', 'nganh_nghe.id')
            ->select([
                'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',
                'nganh_nghe.ten_nganh_nghe'
            ])
            ->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.id', $id)->first();
        return $query;
    }

    public function PostKetQuaTotNghiepGanVoiDoanhNghiep($getdata)
    {
        return $this->model->create($getdata);
    }

    public function CheckTonTai($arraycheck)
    {
        $check = $this->table->where($arraycheck)->select('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.id', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.trang_thai', 'ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id')
            ->first();
        if ($check != null) {
            if ($check->trang_thai >= 3) {
                return  'tontai';
            }
        }

        return $check;
    }
// thanhnv 6/23/2020

    public function getTotNghiepDaoTaoDoanhNghiepCsNamDot($id_truong, $year,$dot)
	{
		$data =  DB::table('ket_qua_tot_nghiep_gan_voi_doanh_nghiep')->where('co_so_id', '=', $id_truong)
		->where('nam','=',$year)
		->where('dot','=',$dot)
		->select('id','nghe_id')->get();
		return $data;
    }

    public function getTotNghiepDaoTaoDoanhNghiepTimeFromTo($id_truong, $fromDate,$toDate)
	{
		$data = DB::table('ket_qua_tot_nghiep_gan_voi_doanh_nghiep')->where('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.co_so_id', '=',$id_truong)
		->where('thoi_gian_cap_nhat','>=',$fromDate)
		->where('thoi_gian_cap_nhat','<=',$toDate)
        ->join('nganh_nghe','nganh_nghe.id','=','ket_qua_tot_nghiep_gan_voi_doanh_nghiep.nghe_id')
		->orderBy('nganh_nghe.id','desc')
		->get();
		return $data;
    }

    // thanhnv 6/26/2020 sửa model create update
	public function createTotNghiepVoiDoanhNghiep($arrayData){
		return $this->model->create($arrayData);
	}
	public function updateTotNghiepVoiDoanhNghiep($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
    }

}
