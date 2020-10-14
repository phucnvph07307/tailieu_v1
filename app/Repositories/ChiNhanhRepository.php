<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ChiNhanhRepository extends BaseRepository implements ChiNhanhRepositoryInterface
{
    public function getTable()
    {
        return 'chi_nhanh_dao_tao';
    }

    public function getChiNhanh($params)
    {
        $query = $this->table
            ->select('chi_nhanh_dao_tao.*', 'co_so_dao_tao.ten', 'devvn_quanhuyen.name as ten_quan_huyen')
            ->join('co_so_dao_tao', 'chi_nhanh_dao_tao.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'chi_nhanh_dao_tao.maqh');
        if (isset($params['ten_co_so']) && $params['ten_co_so'] != null) {
            $name = '%' . $params['ten_co_so'] . '%';
            $query->where('co_so_dao_tao.ten', 'like', $name);
        }
        if (isset($params['ma_chung_nhan']) && $params['ma_chung_nhan'] != null) {
            $query->where('chi_nhanh_dao_tao.ma_chung_nhan_dang_ki_hoat_dong', $params['ma_chung_nhan']);
        }
        if (isset($params['loai_chi_nhanh']) && $params['loai_chi_nhanh'] != null) {
            $query->where('chi_nhanh_dao_tao.chi_nhanh_chinh', $params['loai_chi_nhanh']);
        }
        if (isset($params['quanhuyen'])) {
            $query->where('chi_nhanh_dao_tao.maqh', $params['quanhuyen']);
        }
        return $query->orderByDesc('chi_nhanh_dao_tao.id')
            ->paginate(10);
    }
    public function getSingleChiNhanh($id)
    {
        return $this->table->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'chi_nhanh_dao_tao.co_so_id')
            ->join('devvn_quanhuyen', 'chi_nhanh_dao_tao.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_xaphuongthitran', 'chi_nhanh_dao_tao.xaid', '=', 'devvn_xaphuongthitran.xaid')
            ->where('chi_nhanh_dao_tao.id', $id)
            ->select(
                'co_so_dao_tao.ten as ten_co_so',
                'chi_nhanh_dao_tao.*',
                DB::raw('co_so_dao_tao.id as csdt_id'),
                DB::raw('co_so_dao_tao.ten as csdt_ten'),
                DB::raw('devvn_xaphuongthitran.name as tenxaphuong'),
                DB::raw('devvn_quanhuyen.name as tenquanhuyen')
            )
            ->get();
    }

    public function getChiNhanhThuocCSDT($id, $params)
    {
        $query =  $this->table
            ->select('chi_nhanh_dao_tao.*', 'co_so_dao_tao.ten', 'devvn_quanhuyen.name as ten_quan_huyen')
            ->join('co_so_dao_tao', 'chi_nhanh_dao_tao.co_so_id', '=', 'co_so_dao_tao.id')
            ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'chi_nhanh_dao_tao.maqh')
            ->where('co_so_id', $id);
        if (isset($params['ma_chung_nhan']) && $params['ma_chung_nhan'] != null) {
            $query->where('chi_nhanh_dao_tao.ma_chung_nhan_dang_ki_hoat_dong', $params['ma_chung_nhan']);
        }
        if (isset($params['loai_chi_nhanh']) && $params['loai_chi_nhanh'] != null) {
            $query->where('chi_nhanh_dao_tao.chi_nhanh_chinh', $params['loai_chi_nhanh']);
        }
        if (isset($params['quanhuyen'])) {
            $query->where('chi_nhanh_dao_tao.maqh', $params['quanhuyen']);
        }

        return $query->paginate($params['page_size']);
    }
}
