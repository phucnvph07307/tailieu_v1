<?php

namespace App\Repositories;

interface GiaoVienRepositoryInterface
{
    public function getFilterData();
    public function giaoVienTheoTruong($id_truong);
    public function getList($params, $limit = 10);
}
