<?php


namespace App\Repositories;


interface GiayPhepRepositoryInterface
{
    public function getGiayPhep($id);
    public function store(array $params = []);
    public function updateGiayPhep($id, array $params = []);
    public function getGiayPhepThepCoSo($params);
}
