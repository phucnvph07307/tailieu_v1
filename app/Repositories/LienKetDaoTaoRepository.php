<?php

namespace App\Repositories;


use Illuminate\Support\Facades\DB;
use App\Models\LienKetQuaTuyenSinh;


class LienKetDaoTaoRepository extends BaseRepository implements LienKetDaoTaoRepositoryInterface
{
    protected $model;

    public function __construct(LienKetQuaTuyenSinh $model)
    {
        parent::__construct();
        $this->model = $model;
    }


    public function getTable()
    {
        return 'lien_ket_qua_tuyen_sinh';
    }

    public function getTongHopLienKetDaoTao($params, $limit = 20)
    {

        $query = $this->table
            ->join('co_so_dao_tao', 'lien_ket_qua_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->join('trang_thai', 'lien_ket_qua_tuyen_sinh.trang_thai', '=', 'trang_thai.id')
            ->select([
                DB::raw('SUM(chi_tieu) AS tong_chi_tieu'),
                DB::raw('SUM(thuc_tuyen) AS tong_thuc_tuyen'),
                DB::raw('SUM(so_HSSV_tot_nghiep) AS tong_so_HSSV_tot_nghiep'),
                'lien_ket_qua_tuyen_sinh.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',

            ])->groupBy('lien_ket_qua_tuyen_sinh.co_so_id')
            ->where('lien_ket_qua_tuyen_sinh.nam', $params['nam'])
            ->where('lien_ket_qua_tuyen_sinh.dot', $params['dot']);

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
            $query->where('lien_ket_qua_tuyen_sinh.nghe_id', 'like', $params['nganh_nghe'] . '%');
        }

        return $query->groupBy('co_so_id')->paginate($limit);
    }

    public function getTongHopLienKetDaoTaoTheoTrinhDo($params, $limit = 20, $id)
    {

        $query = $this->table
            ->join('co_so_dao_tao', 'lien_ket_qua_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->join('trang_thai', 'lien_ket_qua_tuyen_sinh.trang_thai', '=', 'trang_thai.id')
            ->select([
                DB::raw('SUM(chi_tieu) AS tong_chi_tieu'),
                DB::raw('SUM(thuc_tuyen) AS tong_thuc_tuyen'),
                DB::raw('SUM(so_HSSV_tot_nghiep) AS tong_so_HSSV_tot_nghiep'),
                'lien_ket_qua_tuyen_sinh.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',

            ])->groupBy('lien_ket_qua_tuyen_sinh.co_so_id')
            ->where('lien_ket_qua_tuyen_sinh.nam', $params['nam'])
            ->where('lien_ket_qua_tuyen_sinh.dot', $params['dot'])
            ->where('nganh_nghe.bac_nghe', $id);

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
            $query->where('lien_ket_qua_tuyen_sinh.nghe_id', 'like', $params['nganh_nghe'] . '%');
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

    public function chitietlienketdaotao($co_so_id, $queryData, $limit, $bac_nghe)
    {

        $data = $this->table

            ->join('co_so_dao_tao', 'lien_ket_qua_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->join('trang_thai', 'lien_ket_qua_tuyen_sinh.trang_thai', '=', 'trang_thai.id')
            ->select([
                'lien_ket_qua_tuyen_sinh.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',
                'nganh_nghe.ten_nganh_nghe',
                'trang_thai.ten_trang_thai'
            ])
            ->where('lien_ket_qua_tuyen_sinh.co_so_id', '=', $co_so_id);

        if ($bac_nghe == 5 || $bac_nghe == 6) {
            $data->where('nganh_nghe.bac_nghe', '=', $bac_nghe);
        }
        if ($queryData['nam'] != null) {
            $data->where('lien_ket_qua_tuyen_sinh.nam', $queryData['nam']);
        }
        if ($queryData['dot'] != null) {
            $data->where('lien_ket_qua_tuyen_sinh.dot', $queryData['dot']);
        }
        return $data->orderBy('nam', 'desc')
            ->orderBy('dot', 'desc')
            ->paginate($limit);
    }

    public function sualienketdaotao($id, $bac_nghe)
    {
        $query = $this->table
            ->join('co_so_dao_tao', 'lien_ket_qua_tuyen_sinh.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
            ->select([
                'lien_ket_qua_tuyen_sinh.*',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'nganh_nghe.bac_nghe',
                'nganh_nghe.ten_nganh_nghe'
            ])
            ->where('lien_ket_qua_tuyen_sinh.id', $id);
        if ($bac_nghe == 6 || $bac_nghe == 5) {
            $query->where('bac_nghe', $bac_nghe);
        }
        return  $query->first();
    }

    public function postthemlienketdaotao($getdata)
    {
        return $this->model->create($getdata);
    }

    public function getCheckTonTaiLienKetDaoTao($arraycheck)
    {
        $check = $this->table->where($arraycheck)->first();
        if ($check != null) {
            if ($check->trang_thai >= 3) {
                return  'tontai';
            }
        }

        return $check;
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


    public function getLkDaoTaoCsNamDot($id_truong, $year, $dot)
    {
        $data =  DB::table('lien_ket_qua_tuyen_sinh')->where('lien_ket_qua_tuyen_sinh.co_so_id', '=', $id_truong)
            ->where('lien_ket_qua_tuyen_sinh.nam', '=', $year)
            ->where('lien_ket_qua_tuyen_sinh.dot', '=', $dot)
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'lien_ket_qua_tuyen_sinh.nghe_id')
            ->select('lien_ket_qua_tuyen_sinh.id', 'lien_ket_qua_tuyen_sinh.nghe_id')
            ->get();
        return $data;
    }

    public function getLkDaoTaoCsCaoDang($id_truong)
    {
        $data = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', '=', $id_truong)
            ->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
            ->where('nganh_nghe.bac_nghe', '=', 6)->get();
        return $data;
    }

    public function getLkDaoTaoCsTrungCap($id_truong)
    {
        $data = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', '=', $id_truong)
            ->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
            ->where('nganh_nghe.bac_nghe', '=', 5)->get();
        return $data;
    }

    public function getLkDaoTaoCsTimeCaoDang($id_truong, $fromDate, $toDate)
    {
        $data = DB::table('lien_ket_qua_tuyen_sinh')->where('lien_ket_qua_tuyen_sinh.co_so_id', '=', $id_truong)
            ->where('thoi_gian_cap_nhat', '>=', $fromDate)
            ->where('thoi_gian_cap_nhat', '<=', $toDate)
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
	    	->orderBy('nganh_nghe.id','desc')
            ->where('nganh_nghe.bac_nghe', '=', 6)->get();
        return $data;
    }

    public function getLkDaoTaoCsTimeTrungCap($id_truong, $fromDate, $toDate)
    {
        $data = DB::table('lien_ket_qua_tuyen_sinh')->where('lien_ket_qua_tuyen_sinh.co_so_id', '=', $id_truong)
            ->where('thoi_gian_cap_nhat', '>=', $fromDate)
            ->where('thoi_gian_cap_nhat', '<=', $toDate)
            ->join('nganh_nghe', 'lien_ket_qua_tuyen_sinh.nghe_id', '=', 'nganh_nghe.id')
	    	->orderBy('nganh_nghe.id','desc')
            ->where('nganh_nghe.bac_nghe', '=', 5)->get();
        return $data;
    }

    // public function getLkDaoTaoCsTimeFromTo($id_truong, $fromDate,$toDate)
    // {
    // 	$data = DB::table('lien_ket_qua_tuyen_sinh')->where('lien_ket_qua_tuyen_sinh.co_so_id', '=',$id_truong)
    // 	->where('thoi_gian_cap_nhat','>=',$fromDate)
    // 	->where('thoi_gian_cap_nhat','<=',$toDate)
    // 	->join('nganh_nghe','nganh_nghe.id','=','lien_ket_qua_tuyen_sinh.nghe_id')
    // 	->get();
    // 	return $data;
    // }

    // thanhnv 6/26/2020 sửa model create update
    public function createLienKetDaoTao($arrayData)
    {
        return $this->model->create($arrayData);
    }
    public function updateLienKetDaoTao($key, $arrayData)
    {
        return $this->model->where('id', $key)->update($arrayData);
    }
}
