<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\QlsvRepositoryInterface;
use App\Models\QuanLiSinhVienDangTheoHoc;
use Dotenv\Result\Result;

class QlsvRepository extends BaseRepository implements QlsvRepositoryInterface
{

    // thanhnv 6/26/2020 thêm model 
    protected $model;
    protected $table;
    public function __construct(QuanLiSinhVienDangTheoHoc $models)
    {
        parent::__construct();
        $this->model = $models;
    }


    public function getTable()
    {
        return 'sv_dang_quan_ly';
    }
    public function getQlsv($params)
    {
        $data = $this->table
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'sv_dang_quan_ly.co_so_id')
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'sv_dang_quan_ly.nghe_id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')

            ->select([
                DB::raw("
            SUM(sv_dang_quan_ly.so_luong_sv_Cao_dang) as so_luong_cao_dang,
            SUM(sv_dang_quan_ly.so_luong_sv_Trung_cap) as so_luong_trung_cap,
            SUM(sv_dang_quan_ly.so_luong_sv_So_cap) as so_luong_so_cap,
            SUM(sv_dang_quan_ly.so_luong_sv_he_khac) as so_luong_He_khac,
            SUM(sv_dang_quan_ly.tong_so_HSSV_co_mat_cac_trinh_do) as tong_so_HSSV_co_mat"),
                'sv_dang_quan_ly.*',
                'co_so_dao_tao.id as cs_id',
                'co_so_dao_tao.ten',
                'nganh_nghe.ten_nganh_nghe',
                'devvn_quanhuyen.name as ten_quan_huyen',
                'devvn_xaphuongthitran.name as ten_xa_phuong'
            ]);

        if (!empty($params['nam'])) {
            $data->where('sv_dang_quan_ly.nam', $params['nam']);
        }
        if (!empty($params['dot'])) {
            $data->where('sv_dang_quan_ly.dot', $params['dot']);
        }
        if (isset($params['loai_hinh']) && !empty($params['loai_hinh'])) {
            $data->where('loai_hinh_co_so.id', $params['loai_hinh']);
        }

        if (isset($params['cs_id']) && !empty($params['cs_id'])) {
            $data->where('sv_dang_quan_ly.co_so_id', $params['cs_id']);
        }

        if (isset($params['nghe_id']) && !empty($params['nghe_id'])) {
            $data->where('sv_dang_quan_ly.nghe_id', $params['nghe_id']);
        }

        // if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
        // 	$data->where('co_so_dao_tao.maqh', $params['devvn_quanhuyen']);
        // }

        // if (isset($params['devvn_xaphuongthitran']) && $params['devvn_xaphuongthitran'] != null) {
        // 	$data->where('co_so_dao_tao.xaid', $params['devvn_xaphuongthitran']);
        // }

        return $data->groupBy('sv_dang_quan_ly.co_so_id')->paginate($params['page_size']);
    }
    public function getCoSo()
    {
        $tencoso = DB::table('co_so_dao_tao')->select('id', 'ten')->get();
        return $tencoso;
    }

    public function suaSoLieuQlsv($id)
    {
        return $this->table
            ->join('co_so_dao_tao', 'sv_dang_quan_ly.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'sv_dang_quan_ly.nghe_id')
            ->where('sv_dang_quan_ly.id', '=', $id)
            ->select(
                'sv_dang_quan_ly.*',
                'co_so_dao_tao.ten',
                'nganh_nghe.ten_nganh_nghe',
                // DB::raw('co_so_dao_tao.ten as cs_ten'),
                DB::raw('sv_dang_quan_ly.id as sv_id')
            )->get();
    }

    public function chiTietSoLieuQlsv($coSoId, $queryData)
    {
        // dd($this->table);

        $data = $this->table
            ->where('sv_dang_quan_ly.co_so_id', '=', $coSoId)
            ->join('co_so_dao_tao', 'sv_dang_quan_ly.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')

            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'sv_dang_quan_ly.nghe_id')
            ->select(
                'sv_dang_quan_ly.*',
                'co_so_dao_tao.ten',
                'devvn_quanhuyen.name as ten_quan_huyen',
                'devvn_xaphuongthitran.name as ten_xa_phuong',
                'nganh_nghe.ten_nganh_nghe',
                'nganh_nghe.id',
                DB::raw('sv_dang_quan_ly.id as sv_id')
            );

        if ($queryData['nam'] != null) {
            $data->where('sv_dang_quan_ly.nam', $queryData['nam']);
        }
        if ($queryData['dot'] != null) {
            $data->where('sv_dang_quan_ly.dot', $queryData['dot']);
        }

        if (isset($queryData['nghe_id']) && !empty($queryData['nghe_id'])) {
            $data->where('sv_dang_quan_ly.nghe_id', $queryData['nghe_id']);
        }

        return $data->orderByDesc('sv_dang_quan_ly.created_at')->paginate($queryData['page_size']);
    }
    
    public function checktontai($arraycheck)
    {
        $check = $this->table->where($arraycheck)->first();
        return $check;
    }
    public function getNamDaoTao()
    {
        $nam = DB::table('sv_dang_quan_ly')->select('id', 'nam')->get();
        return $nam;
    }

    public function getTenCoSoDaoTao()
    {
        $co_so_data = DB::table('co_so_dao_tao')->select('id', 'ten')->get();
        return $co_so_data;
    }

    public function ChiTietCoSo($id)
    {
        $data = DB::table('co_so_dao_tao')
            ->where('co_so_dao_tao.id', '=', $id)
            ->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
            ->select(
                'co_so_dao_tao.ten',
                'co_so_dao_tao.dia_chi',
                'devvn_quanhuyen.name as ten_quan_huyen',
                'devvn_xaphuongthitran.name as ten_xa_phuong'
            )
            ->first();
        return $data;
    }
    public function getTenQuanHuyen()
    {
        return DB::table('devvn_quanhuyen')->get();
    }

    public function getTenXaPhuongTheoQuanHuyen($id)
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
    public function getMaLoaiHinh()
    {
        $data = DB::table('loai_hinh_co_so')->get();
        return $data;
    }
    public function getNganhNghe($ma_cap_nghe)
    {
        $nganhnghe = DB::table('nganh_nghe')->where('ma_cap_nghe', $ma_cap_nghe)->orderBy('ten_nganh_nghe')->get();
        //  dd($nganhnghe);
        return $nganhnghe;
    }

    public function getMaNganhNghe()
    {
        $maNganhNghe = DB::table('nganh_nghe')->select('id', 'ten_nganh_nghe')->get();
        // dd($maNganhNghe);
        return $maNganhNghe;
    }

    public function createPost($request)
    {
        return $this->model->create($request);
    }

    // thanhnv 6/25/2020
    public function getSvdqlJoinNganhNgheNamDot($id_truong, $nam_muon_xuat, $dot_muon_xuat)
    {
        $data = DB::table('sv_dang_quan_ly')->where('sv_dang_quan_ly.co_so_id', '=', $id_truong)
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'sv_dang_quan_ly.nghe_id')
            ->where('sv_dang_quan_ly.nam', '=', $nam_muon_xuat)
            ->where('sv_dang_quan_ly.dot', '=', $dot_muon_xuat)
            ->orderBy('sv_dang_quan_ly.nghe_id', 'asc')->get();
        return $data;
    }


    // thanhnv 6/26/2020 sửa model create update
	public function createQlSinhVienDangTheoHoc($arrayData){
		return $this->model->create($arrayData);
	}

    public function updateQlSinhVienDangTheoHoc($key, $arrayData)
    {
        return $this->model->where('id', $key)->update($arrayData);
    }

    // thanhnv 6/30/2020 change to xuat theo time

    public function getSvDangTheoHocFromTo($id_truong, $fromDate, $toDate)
    {
        $data =  DB::table('sv_dang_quan_ly')->where('sv_dang_quan_ly.co_so_id', '=', $id_truong)
            ->where('thoi_gian_cap_nhat', '>=', $fromDate)
            ->where('thoi_gian_cap_nhat', '<=', $toDate)
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'sv_dang_quan_ly.nghe_id')
            ->orderBy('nganh_nghe.id', 'desc')
            ->get();
        return $data;
    }
}
