<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\DoiNguNhaGiaoInterface;
use Illuminate\Support\Facades\DB;
use App\Models\DoiNguNhaGiao;

class DoiNguNhaGiaoRepository extends BaseRepository implements DoiNguNhaGiaoInterface
{
    protected $model;
    public function __construct(
        DoiNguNhaGiao $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'so_lieu_doi_ngu_nha_giao';
    }

    /* Danh sách đội ngũ nhà giáo.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function getDanhSachDoiNguNhaGiao($params){
        $queryBuilder = $this->table
        ->leftjoin('co_so_dao_tao', 'so_lieu_doi_ngu_nha_giao.co_so_id', '=', 'co_so_dao_tao.id')
        ->leftjoin('loai_hinh_co_so', 'co_so_dao_tao.ma_loai_hinh_co_so', '=', 'loai_hinh_co_so.id')
        ->leftjoin('co_quan_chu_quan', 'co_so_dao_tao.co_quan_chu_quan_id', '=', 'co_quan_chu_quan.id')
        ->leftjoin('nganh_nghe', 'so_lieu_doi_ngu_nha_giao.nghe_id', '=', 'nganh_nghe.id')
        ->select('so_lieu_doi_ngu_nha_giao.*',
        DB::raw('co_so_dao_tao.ten as ten'),
        DB::raw('loai_hinh_co_so.loai_hinh_co_so as ten_loai_hinh_co_so'),
        DB::raw('co_quan_chu_quan.ten as ten_co_quan_chu_quan'),
        DB::raw('nganh_nghe.ten_nganh_nghe as ten_nghe')
        );

        if(isset($params['coquanchuquan']) && $params['coquanchuquan'] != null){
            $queryBuilder->where('co_quan_chu_quan.id', $params['coquanchuquan']);
        }
        if(isset($params['loaihinhcoso']) && $params['loaihinhcoso'] != null){
            $queryBuilder->where('loai_hinh_co_so.id', $params['loaihinhcoso']);
        }
        if(isset($params['nam']) && $params['nam'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.nam', $params['nam']);
        }
        if(isset($params['dot']) && $params['dot'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.dot', $params['dot']);
        }
        if(isset($params['co_so_id']) && $params['co_so_id'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.co_so_id', $params['co_so_id']);
        }
        if(isset($params['nghe_id']) && $params['nghe_id'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.nghe_id', $params['nghe_id']);
        }

        return $queryBuilder->orderByDesc('so_lieu_doi_ngu_nha_giao.nam')
        ->orderByDesc('so_lieu_doi_ngu_nha_giao.dot')->paginate($params['page_size']);
    }


    /* Danh sách chi tiết đội ngũ nhà giáo theo cơ sở.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function chiTietTheoCoSo($co_so_id, $params){
        $queryBuilder = $this->table
        ->leftjoin('co_so_dao_tao','so_lieu_doi_ngu_nha_giao.co_so_id','=','co_so_dao_tao.id')
        ->leftjoin('nganh_nghe','so_lieu_doi_ngu_nha_giao.nghe_id','=','nganh_nghe.id')
        ->select('so_lieu_doi_ngu_nha_giao.*',
        DB::raw('co_so_dao_tao.ten as ten_co_so'),
        DB::raw('nganh_nghe.ten_nganh_nghe as ten_nghe'))
        ->where('so_lieu_doi_ngu_nha_giao.co_so_id', $co_so_id)
        ->where('nganh_nghe.ma_cap_nghe', 4);
        if(isset($params['nam']) && $params['nam'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.nam', $params['nam']);
        }
        if(isset($params['dot']) && $params['dot'] != null){
            $queryBuilder->where('so_lieu_doi_ngu_nha_giao.dot', $params['dot']);
        }

        return $queryBuilder->orderByDesc('so_lieu_doi_ngu_nha_giao.nam')
        ->orderByDesc('so_lieu_doi_ngu_nha_giao.dot')->paginate($params['page_size']);
    }



    /* Danh sách ngành nghề theo ID cơ sở.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function getNganhNgheTheoCoSo($co_so_id){
        $nganhnghe = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')
        ->join('nganh_nghe','giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id','=','nganh_nghe.id')
        ->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', $co_so_id)
        ->where('nganh_nghe.ma_cap_nghe', 4)
        ->select('nganh_nghe.*')
        ->get();
        return $nganhnghe;

    }

    /* Kiểm tra sự tồn tại của bản ghi đã có 4 trường co_so_id, nghe_id, nam, dot.
     * @author: phucnv
     * @created_at 2020-06-12
     */
    public function checkTonTaiKhiThem($params){
        $kq = $this->table
        ->where('so_lieu_doi_ngu_nha_giao.co_so_id', $params['co_so_id'])
        ->where('so_lieu_doi_ngu_nha_giao.nghe_id', $params['nghe_id'])
        ->where('so_lieu_doi_ngu_nha_giao.nam', $params['nam'])
        ->where('so_lieu_doi_ngu_nha_giao.dot', $params['dot'])
        ->select('so_lieu_doi_ngu_nha_giao.*')
        ->first();

        return $kq;
    }

    public function getSoLieuTheoDot($coSoId, $nam, $dot, $selects = ['*'])
    {
        return $this->table
            ->join('trang_thai', 'so_lieu_doi_ngu_nha_giao.trang_thai_id', '=', 'trang_thai.id')
            ->join('co_so_dao_tao', 'co_so_dao_tao.id', '=', 'so_lieu_doi_ngu_nha_giao.id')
            ->join(
                'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao',
                'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.id',
                '=',
                'co_so_dao_tao.id'
            )
            ->join('nganh_nghe', 'nganh_nghe.id', '=', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id')
            ->where('so_lieu_doi_ngu_nha_giao.dot', $dot)
            ->where('so_lieu_doi_ngu_nha_giao.nam', $nam)
            ->select($selects)
            ->get();
    }

    public function checkImportable($coSoId, $nam, $dot)
    {
        $result = $this->table
            ->select(['trang_thai_id'])
            ->where('co_so_id', $coSoId)
            ->where('nam', $nam)
            ->where('dot', $dot)
            ->first();

        return $result !== null && $result->trang_thai_id < 3;
    }

    public function update($id, $attributes = [])
    {
        return $this->model
            ->find($id)
            ->update($attributes);
    }

    public function insert($data)
    {
        return $this->model->create($data);
    }
}
