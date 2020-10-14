<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\SoLieuCanBoQuanLy;
use DB;

class SoLieuCanBoQuanLyRepository extends BaseRepository
    implements SoLieuCanBoQuanLyRepositoryInterface
{
    protected $model;

    public function __construct(SoLieuCanBoQuanLy $soLieuCanBoQuanLy)
    {
        $this->model = $soLieuCanBoQuanLy;
        $this->table = $soLieuCanBoQuanLy;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getFilterData()
    {
        return $this->model
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'so_lieu_can_bo_quan_ly.co_so_dao_tao_id')
            ->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            // ->join('trang_thai', 'trang_thai.id', '=', 'so_lieu_can_bo_quan_ly.trang_thai_id')
            ->select([
                'co_so_dao_tao.ten as ten_co_so',
                'co_so_dao_tao.id as co_so_dao_tao_id',
                'loai_hinh_co_so.id as loai_hinh_id',
                'loai_hinh_co_so.loai_hinh_co_so as loai_hinh',
                // 'trang_thai.id as trang_thai_id',
                // 'trang_thai.ten_trang_thai',
                'so_lieu_can_bo_quan_ly.nam',
                'so_lieu_can_bo_quan_ly.dot',
            ])
            ->get();
    }

    public function getList(array $params = [], int $limit = 20)
    {
        $queryBuilder = $this->model
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'so_lieu_can_bo_quan_ly.co_so_dao_tao_id')
            ->join('loai_hinh_co_so', 'loai_hinh_co_so.id', '=', 'co_so_dao_tao.ma_loai_hinh_co_so')
            ->select([
                'co_so_dao_tao.ten as ten_co_so',
                'co_so_dao_tao.id as co_so_dao_tao_id',
                'loai_hinh_co_so.loai_hinh_co_so as loai_hinh',
                'so_lieu_can_bo_quan_ly.tong_so_quan_ly as tong_so',
                'so_lieu_can_bo_quan_ly.id',
            ]);

        if (isset($params['co_so_dao_tao_id']) && !empty($params['co_so_dao_tao_id'])) {
            $queryBuilder->where('co_so_dao_tao.id', $params['co_so_dao_tao_id']);
        }

        if (isset($params['loai_hinh_id']) && !empty($params['loai_hinh_id'])) {
            $queryBuilder->where('loai_hinh_co_so.id', $params['loai_hinh_id']);
        }

        if (isset($params['nam']) && !empty($params['nam'])) {
            $queryBuilder->where('so_lieu_can_bo_quan_ly.nam', $params['nam']);
        }

        if (isset($params['dot']) && !empty($params['dot'])) {
            $queryBuilder->where('so_lieu_can_bo_quan_ly.dot', $params['dot']);
        }

        if (isset($params['sort_field']) && !empty($params['sort_field'])) {
            $sortBy = isset($params['sort_by']) && !empty($params['sort_field']) ?
                $params['sort_by'] : 'asc';

            $queryBuilder->orderBy($params['sort_field'], $sortBy);
        }

        return $queryBuilder->paginate($limit);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data = [])
    {
        return $this->model
            ->where('id', $id)
            ->update($data);
    }

    public function getListByCoSo(int $coSoId, int $limit = 20, array $params = [])
    {
        $queryBuilder = $this->model
            ->where('co_so_dao_tao_id', $coSoId);

        if (isset($params['sort_field']) && !empty($params['sort_field'])) {
            $sortBy = isset($params['sort_by']) && !empty($params['sort_field']) ?
                $params['sort_by'] : 'asc';

            $queryBuilder->orderBy($params['sort_field'], $sortBy);
        }

        return $queryBuilder->paginate($limit);
    }

        // thanhnv 6/26/2020 sửa model create update
        public function createSoLieuCanBoQl($arrayData){
            return $this->model->create($arrayData);
        }
        public function updateSoLieuCanBoQl($key,$arrayData){
            return $this->model->where('id',$key)->update($arrayData);
        }
        
        public function getSlCanBoQuanLyFromTo($id_truong, $fromDate,$toDate){
            $data =  DB::table('so_lieu_can_bo_quan_ly')->where('so_lieu_can_bo_quan_ly.co_so_dao_tao_id', '=',$id_truong)
            ->where('created_at','>=',$fromDate)
            ->where('created_at','<=',$toDate)
            ->get();
            return $data;
        }

        public function checkTonTaiKhiThem($params){
            return $this->model::where('co_so_dao_tao_id',$params['co_so_dao_tao_id'])
           ->where('nam',$params['nam'])
           ->where('dot',$params['dot'])
           ->first();
        }
}
