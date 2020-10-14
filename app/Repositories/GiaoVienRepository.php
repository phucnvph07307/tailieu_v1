<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\GiaoVien;
use DB;

class GiaoVienRepository extends BaseRepository implements GiaoVienRepositoryInterface
{
    protected $model;

    public function __construct(GiaoVien $giaoVien)
    {
        $this->model = $giaoVien;
        $this->table = $giaoVien;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getFilterData()
    {
        return $this->model
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'giao_vien.co_so_id')
            ->select([
                'giao_vien.id',
                'giao_vien.ten',
                'giao_vien.trinh_do_nghiep_vu_su_pham',
                'co_so_dao_tao.ten as ten_co_so',
                'co_so_dao_tao.id as id_co_so',
            ])
            ->get();
    }

    public function getList($params = [], $limit = 10)
    {
        $queryBuilder = $this->model
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'giao_vien.co_so_id')
            ->select([
                'giao_vien.id',
                'giao_vien.ten',
                'giao_vien.nha_giao_nhan_dan',
                'giao_vien.nha_giao_uu_tu',
                'giao_vien.mon_chung',
                'giao_vien.nghe_giang_day',
                'co_so_dao_tao.ten as ten_co_so',
                DB::raw("CASE WHEN giao_vien.gioi_tinh = 0 THEN 'Nữ' ELSE 'Nam' END as gioi_tinh"),
                DB::raw("CASE WHEN giao_vien.dan_toc_it_nguoi = 1 THEN 'x' END as dan_toc_it_nguoi"),
                DB::raw("CASE WHEN giao_vien.giao_su = 1 THEN 'Giáo sư'
                WHEN giao_vien.pho_giao_su = 1 THEN 'Phó giáo sư'
                ELSE '' END as chuc_danh"),
                DB::raw("CASE WHEN giao_vien.loai_hop_dong = 1 THEN 'Biên chế'
                WHEN giao_vien.loai_hop_dong = 2 THEN 'Hợp đồng'
                ELSE 'Thỉnh giảng' END as loai_hop_dong"),
                'giao_vien.trinh_do_ngoai_ngu',
                'giao_vien.trinh_do_ky_nang_nghe',
            ]);

        if (isset($params['giao_vien_id']) && !empty($params['giao_vien_id'])) {
            $queryBuilder->where('giao_vien.ten', 'LIKE', "%{$params['giao_vien_id']}%");
        }

        if (isset($params['trinh_do_id']) && !empty($params['trinh_do_id'])) {
            $queryBuilder->where('trinh_do_gv.id', $params['trinh_do_id']);
        }

        if (isset($params['co_so_id']) && !empty($params['co_so_id'])) {
            $queryBuilder->where('co_so_dao_tao.id', $params['co_so_id']);
        }

        if (isset($params['nghiep_vu_su_pham']) && !empty($params['nghiep_vu_su_pham'])) {
            $queryBuilder->where('giao_vien.trinh_do_nghiep_vu_su_pham', $params['nghiep_vu_su_pham']);
        }

        if (isset($params['sort_field']) && !empty($params['sort_field'])) {
            $sortBy = isset($params['sort_by']) && !empty($params['sort_field']) ?
                $params['sort_by'] : 'asc';

            $queryBuilder->orderBy($params['sort_field'], $sortBy);
        }

        return $queryBuilder->paginate($limit);
    }

    public function giaoVienTheoTruong($id_truong)
    {
        return $this->model->where('co_so_id', $id_truong)->get();
    }

    // thanhnv 6/26/2020 sửa model create update
	public function createQuanLiGiaoVien($arrayData){
		return $this->model->create($arrayData);
	}

}
