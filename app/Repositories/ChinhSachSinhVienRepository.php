<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\ChinhSachSinhVien;
use Carbon\Carbon;

class ChinhSachSinhVienRepository extends BaseRepository implements ChinhSachSinhVienRepositoryInterface
{
    protected $model;

	public function __construct(ChinhSachSinhVien $model)
	{
		parent::__construct();
		$this->model = $model;
    }

    public function getTable()
    {
        return 'tong_hop_chinh_sach_voi_hssv';
    }

    public function getChinhSachSinhVien($params, $limit = 20)
    {

        $query = $this->table
            ->join('co_so_dao_tao', 'tong_hop_chinh_sach_voi_hssv.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('trang_thai', 'tong_hop_chinh_sach_voi_hssv.trang_thai', '=', 'trang_thai.id')
            ->join('chinh_sach', 'tong_hop_chinh_sach_voi_hssv.chinh_sach_id', '=', 'chinh_sach.id')
            ->join('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
            ->join('devvn_quanhuyen', 'co_so_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->select([
                'tong_hop_chinh_sach_voi_hssv.*',
                'trang_thai.ten_trang_thai as ten_trang_thai',
                'co_so_dao_tao.ten',
                'co_so_dao_tao.maqh as maqh',
                'co_so_dao_tao.ma_loai_hinh_co_so as ma_loai_hinh_co_so',
                'chinh_sach.ten as ten_chinh_sach',
                'loai_hinh_co_so.loai_hinh_co_so',
                'devvn_quanhuyen.name as quan_huyen',
            ])
            ->where('tong_hop_chinh_sach_voi_hssv.nam', $params['nam'])
            ->where('tong_hop_chinh_sach_voi_hssv.dot', $params['dot']);

        if (isset($params['loai_hinh']) && !empty($params['loai_hinh'])) {
            $query->where('ma_loai_hinh_co_so', $params['loai_hinh']);
        }
        if (isset($params['co_so_id']) && $params['co_so_id'] != null) {
            $query->where('co_so_id', $params['co_so_id']);
        }
        if (isset($params['devvn_quanhuyen']) && $params['devvn_quanhuyen'] != null) {
            $query->where('maqh', $params['devvn_quanhuyen']);
        }
        if (isset($params['chinhsach']) && $params['chinhsach'] != null) {
            $query->where('chinh_sach_id', $params['chinhsach']);
        }


        return $query->orderBy('tong_hop_chinh_sach_voi_hssv.id', 'asc')->paginate($limit);
    }


    public function checktontaiChinhSachSinhVien($arraycheck)
    {
        $check = $this->table->where($arraycheck)->select('tong_hop_chinh_sach_voi_hssv.id', 'tong_hop_chinh_sach_voi_hssv.trang_thai')
            ->first();
        if ($check != null) {
            if ($check->trang_thai >= 3) {
                return  'tontai';
            }
        }

        return $check;
    }

    public function postthemChinhSachSinhVien($data)
    {
        return $this->model->create($data);
    }
    public function getsuaChinhSachSinhVien($id)
    {
        $data = $this->table
            ->join('co_so_dao_tao', 'tong_hop_chinh_sach_voi_hssv.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('chinh_sach', 'tong_hop_chinh_sach_voi_hssv.chinh_sach_id', '=', 'chinh_sach.id')
            ->select([
                'tong_hop_chinh_sach_voi_hssv.*',
                'co_so_dao_tao.ten',
                'chinh_sach.ten as ten_chinh_sach'
            ])
            ->where('tong_hop_chinh_sach_voi_hssv.id', $id);
        return  $data->first();
    }

    // thanhnv 6/26/2020 sửa model create update
    public function createChinhSachSv($arrayData){
        return $this->model->create($arrayData);
    }
    public function updateChinhSachSv($key,$arrayData){
        return $this->model->where('id',$key)->update($arrayData);
    }
}
