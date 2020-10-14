<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/2/20
 * Time: 15:16
 */

namespace App\Services;

use App\Repositories\NganhNgheRepository;
use Illuminate\Support\Facades\DB;

class NganhNgheService extends AppService
{
    public function getRepository()
    {
        return NganhNgheRepository::class;
    }

    public function getNganhNghe($params)
    {

        return $this->repository->getNganhNghe($params);
    }

    public function apiTimKiemNgheTheoKeyword($params)
    {
        return $this->repository->timKiemNgheTheoKeyword($params);
    }

    public function getAllNganhNghe($bac_nghe, $co_so_id)
    {
        return $this->repository->getAllNganhNghe($bac_nghe, $co_so_id);
    }

    public function boSungNganhNgheVaoCoSo($request, $unsetColums = [])
    {
        $nghe_cao_dang = $request->get('nghe_cao_dang');
        $nghe_trung_cap = $request->get('nghe_trung_cap');
        $attributes = $request->all();
        if (count($unsetColums) > 0) {
            foreach ($unsetColums as $col) {
                unset($attributes[$col]);
            }
        }
        return $this->repository->boSungNganhNgheVaoCoSo($attributes, $nghe_cao_dang, $nghe_trung_cap);
    }

    public function search(array $params = [])
    {
        $selects = [
            'id',
            DB::raw("CONCAT(ten_nganh_nghe, ' - ', id) AS text"),
        ];

        return $this->repository
            ->search($params, $selects)
            ->toArray();
    }
    // Quanglx lấy nghề theo cấp độ
    public function getNganhNgheTheoCapDo($length)
    {
       return $this->repository->getNganhNgheTheoCapDo($length);
    }

    public function store($request)
    {
       $data = $request->all();
       $dataStore =[];
       $dataStore['id']=$data['id'];
       switch (strlen($dataStore['id'])) {
           case '7':
              $ma_cap_nghe = 4;
               break;
            case '5':
                $ma_cap_nghe = 3;
            break;
            case '3':
                $ma_cap_nghe = 2;
                break;     
           default:
               break;
       }
       $dataStore['ten_nganh_nghe']= $data['ten_nganh_nghe'];
       $dataStore['ma_cap_nghe'] = $ma_cap_nghe;
       $dataStore['bac_nghe']= substr($dataStore['id'],0,1);

       return $this->repository->create($dataStore);
    }

    public function updateData($request,$id)
    {
       $data = $request->all();
    //    dd($data);
       $dataStore =[];
       $dataStore['id']=$data['id_nghe_4'];
       switch (strlen($dataStore['id'])) {
           case '7':
              $ma_cap_nghe = 4;
               break;
            case '5':
                $ma_cap_nghe = 3;
            break;
            case '3':
                $ma_cap_nghe = 2;
                break;     
           default:
               break;
       }
       $dataStore['ten_nganh_nghe']= $data['ten_nganh_nghe'];
       $dataStore['ma_cap_nghe'] = $ma_cap_nghe;
       $dataStore['bac_nghe']= substr($dataStore['id'],0,1);
       return $this->repository->updateData($dataStore,$id);
    }
}
