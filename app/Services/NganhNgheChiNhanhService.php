<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\NganhNgheChiNhanhRepository;

class NganhNgheChiNhanhService extends AppService
{
    public function getRepository()
    {
        return NganhNgheChiNhanhRepository::class;
    }

    public function boSungNgheVaoChiNhanh($request)
    {
        $nghe_trung_cap = $request->get('nghe_trung_cap');
        $nghe_cao_dang = $request->get('nghe_cao_dang');

        $data = $request->all();
        $this->repository->boSungNgheVaoChiNhanh($data, $nghe_cao_dang, $nghe_trung_cap);
    }

    public function getNgheTheoChiNhanh($params)
    {
        return $this->repository->getNgheTheoChiNhanh($params);
    }
}
