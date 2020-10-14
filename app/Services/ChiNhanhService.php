<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;


class ChiNhanhService extends AppService
{
    public function getRepository()
    {
        return \App\Repositories\ChiNhanhRepository::class;
    }
    public function getChiNhanh($params)
    {
        return $this->repository->getChiNhanh($params);
    }

    public function getSingleChiNhanh($id)
    {
        return $this->repository->getSingleChiNhanh($id);
    }

    public function getChiNhanhThuocCSDT($id, $params)
    {
        return $this->repository->getChiNhanhThuocCSDT($id, $params);
    }
}
