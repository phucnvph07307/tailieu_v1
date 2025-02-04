<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/2/20
 * Time: 15:16
 */

namespace App\Services;


use App\Repositories\PhuongXaRepository;
use App\Repositories\QuanHuyenRepository;

class QuanHuyenService extends AppService
{
    public function getRepository()
    {
        return QuanHuyenRepository::class;
    }

    public function getAll(){
        return $this->repository->getAll();
    }
}