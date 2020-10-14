<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;
use App\Models\NganhNghe;

class NganhNgheRepository extends BaseRepository implements NganhNgheRepositoryInterface
{
    public function __construct(
        NganhNghe $nganhNghe
    ) {
        parent::__construct();
        $this->model = $nganhNghe;
    }

    public function getTable()
    {
        return 'nganh_nghe';
    }

    public function getNganhNghe($params)
    {
        $queryBuilder = $this->table
            ->select(
                'id',
                'ten_nganh_nghe',
                'bac_nghe',
                DB::raw('(SELECT
                            count( DISTINCT csdt.ten ) 
                        FROM
                            giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao dk
                            INNER JOIN co_so_dao_tao csdt ON dk.co_so_id = csdt.id 
                        WHERE
                            dk.nghe_id = nganh_nghe.id) as csdt_count')
        )
        ->where('bac_nghe', $params['bac_nghe'])
        ->where('ma_cap_nghe', $params['ma_cap_nghe']);
        if (isset($params['keyword']) && $params['keyword'] != null) {
            $queryBuilder->where(function ($query) use ($params) {

                $query->orWhere('ten_nganh_nghe', 'like', "%" . $params['keyword'] . "%")
                    ->orwhere('id',  'like', $params['keyword'] . "%");
            });
        }
        return $queryBuilder->paginate($params['page_size']);
    }

    public function timKiemNgheTheoKeyword($params)
    {
        $resultCount = 25;

        $offset = ($params['page'] - 1) * $resultCount;
        $queryBuilder = $this->table
            ->select(
                'id',
                DB::raw('concat(id, " - ", ten_nganh_nghe) as text')
            )
            ->where('ma_cap_nghe', 4)
            ->where(function ($query) use ($params) {
                $query->where('ten_nganh_nghe', 'like', "%" . $params['keyword'] . "%")
                    ->orWhere('id', 'like', $params['keyword'] . "%");
            });

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

    public function getAllNganhNghe($bac_nghe, $co_so_id = null)
    {
        $query = $this->model->select('nganh_nghe.*')
            ->where('bac_nghe', $bac_nghe)
            ->where('ma_cap_nghe', 4);

        if (!empty($co_so_id)) {
            $query->whereNotIn('id', function ($q) use ($co_so_id) {
                $q->select('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id')
                    ->from('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')
                    ->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', $co_so_id + 0);
            });
        }
        return $query->get();
    }

    public function boSungNganhNgheVaoCoSo($attributes, $nghe_cao_dang = [], $nghe_trung_cap = [])
    {
        $arrayInsert = [];
        if (isset($nghe_cao_dang)) {
            for ($i = 0; $i < count($nghe_cao_dang); $i++) {
                $arrayInsert[] = [
                    'co_so_id' => $attributes['co_so_id'],
                    'nghe_id' => $nghe_cao_dang[$i],
                    'giay_phep_id' => $attributes['giay_phep_id'],
                    'trang_thai' => '1'
                ];
            }
        }

        if (isset($nghe_trung_cap)) {
            for ($i = 0; $i < count($nghe_trung_cap); $i++) {
                $arrayInsert[] = [
                    'co_so_id' => $attributes['co_so_id'],
                    'nghe_id' => $nghe_trung_cap[$i],
                    'giay_phep_id' => $attributes['giay_phep_id'],
                    'trang_thai' => '1'
                ];
            }
        }
        return DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')
            ->insert($arrayInsert);
    }

    public function getListNganhNghe(array $listIds = [], $selects = ['*'])
    {
        $query =  $this->model
            ->select($selects);

        if (!empty($listIds)) {
            $query->whereIn('id', $listIds);
        }
        $query->where('ma_cap_nghe', 4);

        return $query->get();
    }

    public function search(array $params = [], array $selects = ['*'])
    {
        $limit = config('common.paginate_size.default');
        $queryBuilder = $this->model
            ->select($selects);
        $queryBuilder->where('ma_cap_nghe', 4);
        if (
            isset($params['keyword']) && !empty($params['keyword'])
        ) {
            $queryBuilder->where(function ($query) use ($params) {
                $query->where('ten_nganh_nghe', 'like', "%".$params['keyword']."%")
                    ->orwhere('id', 'like', "%".$params['keyword']."%");
            });
        }

        return $queryBuilder->paginate($limit);
    }

    public function getNganhNgheTheoCoSo($co_so_id)
    {
        $nganhnghe = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')
            ->join('nganh_nghe', 'giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.nghe_id', '=', 'nganh_nghe.id')
            ->where('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao.co_so_id', $co_so_id)
            ->where('nganh_nghe.ma_cap_nghe', 4)
            ->select('nganh_nghe.*')
            ->get();
        return $nganhnghe;
    }

    // Quanglx lấy nghề theo cấp độ
    public function getNganhNgheTheoCapDo($length)
    {
        return $this->model->whereRaw('LENGTH(id) = ?',[$length])->get();
    }

    public function getNgheTheoCapBac($id, $cap_nghe)
	{
		$data = $this->model->where('id', 'like', $id.'%')->where('ma_cap_nghe', $cap_nghe)->orderBy('ten_nganh_nghe')->get();
		return $data;
    }
    
    public function store($data)
	{
		return $this->model->insert($data);
    }
    
    public function updateData($data,$id)
    {
        return $this->model->where('id',$id)->update($data);
    }
}
