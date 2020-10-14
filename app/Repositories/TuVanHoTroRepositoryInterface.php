<?php


namespace App\Repositories;


interface TuVanHoTroRepositoryInterface
{
    public function clientThemTuVanHoTro($data);

    public function findOne($data);
    public function traLoiYeuCau($id, $data);

}
