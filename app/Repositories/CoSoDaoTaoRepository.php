<?php


namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\CoSoDaoTao;

class CoSoDaoTaoRepository extends BaseRepository implements CoSoDaoTaoRepositoryInterface
{
    protected $model;
    public function __construct(
        CoSoDaoTao $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'co_so_dao_tao';
    }

    public function getCsdt($params)
    {
        $query = $this->table->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            ->join('quyet_dinh_thanh_lap_csdt', 'co_so_dao_tao.quyet_dinh_id', 'quyet_dinh_thanh_lap_csdt.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
            ->select(
                'co_so_dao_tao.*',
                'loai_hinh_co_so.loai_hinh_co_so',
                DB::raw('quyet_dinh_thanh_lap_csdt.ten as qd_ten'),
                DB::raw('devvn_xaphuongthitran.name as tenxaphuong'),
                DB::raw('devvn_quanhuyen.name as tenquanhuyen')
            );
        if (isset($params['ten_co_so']) && $params['ten_co_so'] != null) {
            $name = '%' . $params['ten_co_so'] . '%';
            $query->where('co_so_dao_tao.ten', 'like', $name);
        }
        if (isset($params['ma_don_vi']) && $params['ma_don_vi'] != null) {
            $query->where('co_so_dao_tao.ma_don_vi', $params['ma_don_vi']);
        }
        if (isset($params['loai_hinh_co_so']) && $params['loai_hinh_co_so'] != null) {
            $query->where('co_so_dao_tao.ma_loai_hinh_co_so', $params['loai_hinh_co_so']);
        }
        if (isset($params['quanhuyen']) && $params['quanhuyen'] != null) {
            $query->where('co_so_dao_tao.maqh', $params['quanhuyen']);
        }
        return $query->orderByDesc('co_so_dao_tao.id')
            ->paginate($params['page_size']);
    }

    public function getSingleCsdt($id)
    {
        return $this->table->join('co_quan_chu_quan', 'co_so_dao_tao.co_quan_chu_quan_id', '=', 'co_quan_chu_quan.id')
            ->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            ->join('quyet_dinh_thanh_lap_csdt', 'co_so_dao_tao.quyet_dinh_id', 'quyet_dinh_thanh_lap_csdt.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'co_so_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
            ->select(
                'co_so_dao_tao.*',
                'loai_hinh_co_so.loai_hinh_co_so',
                DB::raw('co_quan_chu_quan.ten as cq_ten'),
                DB::raw('co_so_dao_tao.ten as csdt_ten'),
                DB::raw('quyet_dinh_thanh_lap_csdt.ten as qd_ten'),
                DB::raw('devvn_xaphuongthitran.name as tenxaphuong'),
                DB::raw('devvn_quanhuyen.name as tenquanhuyen')
            )
            ->where('co_so_dao_tao.id', $id)
            ->get();
    }

    public function apiSearchCoSoDaoTao($params)
    {
        $resultCount = config('common.paginate_size.default');
        $offset = ($params['page'] - 1) * $resultCount;
        $queryBuilder = $this->table
            ->select(
                'id',
                DB::raw('concat(ma_don_vi, " - ", ten) as text')
            )
            ->where('ten', 'like', "%" . $params['keyword'] . "%")
            ->orWhere('ma_don_vi', 'like', "'" . $params['keyword'] . "%'");
        $count = $queryBuilder->count();

        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        $data = $queryBuilder
            ->skip($offset)
            ->take($resultCount)
            ->get()
            ->toArray();

        $results = array(
            "results" => $data,
            "pagination" => array(
                "more" => $morePages
            )
        );
        return $results;
    }

    public function addCoQuanChuQuan($attributes = [])
    {
        return DB::table('co_quan_chu_quan')->insert($attributes);
    }

    public function addQuyetDinh($attributes = [])
    {
        return DB::table('quyet_dinh_thanh_lap_csdt')->insert($attributes);
    }

    public function getCoSoBySoLieuId($soLieuId)
    {
        return $this->model
            ->join('so_lieu_can_bo_quan_ly', 'so_lieu_can_bo_quan_ly.co_so_dao_tao_id', '=', 'co_so_dao_tao.id')
            ->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            ->select([
                'co_so_dao_tao.id',
                'co_so_dao_tao.ten',
                'loai_hinh_co_so.loai_hinh_co_so',
            ])
            ->where('so_lieu_can_bo_quan_ly.id', $soLieuId)
            ->first();
    }

    public function getAllWithLoaiHinh()
    {
        return $this->model
            ->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            ->select([
                'co_so_dao_tao.*',
                'loai_hinh_co_so.loai_hinh_co_so',
            ])
            ->get();
    }

    public function getDoiNguNhaGiaoTheoCoSo(int $coSoId, array $params = [])
    {
        $coSo = $this->model->find($coSoId);
        $coSo->load([
            'loaiHinhCoSo',
            'doiNguNhaGiao' => function ($query) use ($params) {
                if (isset($params['nam']) && !empty($params['nam'])) {
                    $query->where('nam', $params['nam']);
                }

                if (isset($params['dot']) && !empty($params['dot'])) {
                    $query->where('dot', $params['dot']);
                }
            },
            'doiNguNhaGiao.nganhNghe'
        ]);

        return $coSo;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getListById($listId, $selects = ['*'])
    {
        return $this->model
            ->whereIn('id', $listId)
            ->select($selects)
            ->orderBy('loai_truong', 'desc')
            ->get();
    }

    public function checkTonTai($id)
    {
        return DB::table('co_so_dao_tao')->where('id', $id)->first();
    }

    public function getThongTinCoSo($co_so_id)
    {
       return $this->model->find($co_so_id);
    }
}