<?php

namespace App\Repositories;

interface KetQuaTotNghiepGanVoiDoanhNghiepRepositoryInterface
{
    public function getKetQuaTotNghiepGanVoiDoanhNghiep($params, $limit = 20);
    public function createTotNghiepVoiDoanhNghiep($arrayData);
    public function updateTotNghiepVoiDoanhNghiep($key,$arrayData);
}
