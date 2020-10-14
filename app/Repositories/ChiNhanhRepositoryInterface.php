<?php


namespace App\Repositories;


interface ChiNhanhRepositoryInterface
{
    public function getChiNhanh($params);

    public function getSingleChiNhanh($id);

    public function getChiNhanhThuocCSDT($id, $params);
}
