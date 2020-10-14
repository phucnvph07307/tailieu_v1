<?php

namespace App\Repositories;

interface ChinhSachSinhVienRepositoryInterface
{
    public function getChinhSachSinhVien($params, $limit = 20);
    public function checktontaiChinhSachSinhVien($requestParams);
    public function getsuaChinhSachSinhVien($id);
    public function postthemChinhSachSinhVien($data);
}
