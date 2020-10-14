<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/2/20
 * Time: 15:16
 */

namespace App\Services;


use App\Repositories\PhuongXaRepository;

class PhuongXaService extends AppService
{
    public function getRepository()
    {
        return PhuongXaRepository::class;
    }

    public function getAll(){
        return $this->repository->getAll();
    }

    public function getPhuongXaTheoQuan($quanId){
        return $this->repository->getPhuongXaTheoQuan($quanId);
    }
}