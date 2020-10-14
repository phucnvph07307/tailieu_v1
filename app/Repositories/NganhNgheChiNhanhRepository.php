<?php

namespace App\Repositories;

use App\Models\NganhNgheChiNhanh;
use App\Repositories\BaseRepository;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;

class NganhNgheChiNhanhRepository extends BaseRepository implements NganhNgheChiNhanhRepositoryInterface
{
    public function __construct(
        NganhNgheChiNhanh $nganhNgheChiNhanh
    ) {
        parent::__construct();
        $this->model = $nganhNgheChiNhanh;
    }

    public function getTable()
    {
        return 'nganh_nghe_chi_nhanh';
    }

    public function boSungNgheVaoChiNhanh($data, $nghe_cao_dang = [], $nghe_trung_cap = [])
    {
        $arrayInsert = [];
        if (isset($nghe_cao_dang)) {
            for ($i = 0; $i < count($nghe_cao_dang); $i++) {
                $arrayInsert[] = [
                    'chi_nhanh_id' => $data['chi_nhanh_id'],
                    'giay_chung_nhan_id' => $nghe_cao_dang[$i]
                ];
            }
        }

        if (isset($nghe_trung_cap) > 0) {
            for ($i = 0; $i < count($nghe_trung_cap); $i++) {
                $arrayInsert[] = [
                    'chi_nhanh_id' => $data['chi_nhanh_id'],
                    'giay_chung_nhan_id' => $nghe_trung_cap[$i]
                ];
            }
        }
        return $this->model->insert($arrayInsert);
    }

    public function getNgheTheoChiNhanh($params)
    {
        // dd($params);
        $queryBuilder = $this->model->select(
            'nganh_nghe.ten_nganh_nghe',
            'nganh_nghe.id as nghe_id',
            'nganh_nghe.bac_nghe',

            'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.quy_mo_tuyen_sinh',
            'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.trang_thai',

            'giay_phep.ten_giay_phep',
            'giay_phep.ngay_ban_hanh',
            'giay_phep.ngay_hieu_luc',
            'giay_phep.ngay_het_han',
            'giay_phep.anh_giay_phep'

        )
            ->join('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.id', '=', 'nganh_nghe_chi_nhanh.giay_chung_nhan_id')
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id')
            ->join('giay_phep', 'giay_phep.id', '=', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.giay_phep_id')
            ->where('nganh_nghe_chi_nhanh.chi_nhanh_id', $params['chi_nhanh_id']);
        if (isset($params['ten_nghe'])) {
            $queryBuilder->where('nganh_nghe.ten_nganh_nghe', $params['ten_nghe']);
        }
        if (isset($params['ma_nghe'])) {
            $queryBuilder->where('nganh_nghe.id', $params['ma_nghe']);
        }
        if (isset($params['bac_nghe'])) {
            $queryBuilder->where('nganh_nghe.bac_nghe', $params['bac_nghe']);
        }
        return $queryBuilder->paginate($params['page_size']);
    }
}
