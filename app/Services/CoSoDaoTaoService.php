<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\CoSoDaoTaoRepository;


class CoSoDaoTaoService extends AppService
{
    public function getRepository()
    {
        return \App\Repositories\CoSoDaoTaoRepository::class;
    }
    public function getCsdt($params)
    {
        return $this->repository->getCsdt($params);
    }

    public function getSingleCsdt($id)
    {
        return $this->repository->getSingleCsdt($id);
    }

    public function apiSearchCoSoDaoTao($params)
    {
        return $this->repository->apiSearchCoSoDaoTao($params);
    }

    public function addCoQuanChuQuan($attributes = [])
    {
        return $this->repository->addCoQuanChuQuan($attributes);
    }

    public function addQuyetDinh($attributes = [])
    {
        return $this->repository->addQuyetDinh($attributes);
    }

    public function checkTonTai($id)
    {
        return $this->repository->checkTonTai($id);
    }
}