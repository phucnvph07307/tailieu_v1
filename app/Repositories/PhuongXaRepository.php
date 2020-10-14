<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;

class PhuongXaRepository extends BaseRepository implements PhuongXaRepositoryInterface {

    public function getTable()
    {
        return 'devvn_xaphuongthitran';
    }

    /* Lấy danh sách xã phường
     * @author: thienth
     * @date: 2020-06-03
     * */
    public function getAll()
    {
        $queryBuilder = $this->table
            ->select(
                'devvn_xaphuongthitran.xaid',
                'devvn_xaphuongthitran.name as ten_xa_phuong',
                'devvn_xaphuongthitran.maqh as ma_quan_huyen',
                'devvn_quanhuyen.name as ten_quan_huyen'
            )
            ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'devvn_xaphuongthitran.maqh');
        return $queryBuilder->get();
    }

    /* Lấy danh sách xã phường theo mã quận huyện
     * @author: thienth
     * @date: 2020-06-03
     * @params: $quanId - int - Quận huyện id
     * */
    public function getPhuongXaTheoQuan($quanId){
        $queryBuilder = $this->table
            ->select(
                'devvn_xaphuongthitran.xaid',
                'devvn_xaphuongthitran.name as ten_xa_phuong',
                'devvn_xaphuongthitran.maqh as ma_quan_huyen',
                'devvn_quanhuyen.name as ten_quan_huyen'
            )
            ->join('devvn_quanhuyen', 'devvn_quanhuyen.maqh', '=', 'devvn_xaphuongthitran.maqh')
            ->where('devvn_xaphuongthitran.maqh', $quanId);
        return $queryBuilder->get();
    }
}

?>