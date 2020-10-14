<?php

namespace App\Repositories;

interface LienKetDaoTaoRepositoryInterface
{
    public function getTongHopLienKetDaoTao($params, $limit = 20);
    public function getTenQuanHuyen();
    public function getCoSo();
    public function getNganhNghe($ma_cap_nghe);
    public function getNgheTheoCapBac($id, $cap_nghe);
    public function getLoaiHinhCoSo();
    public function chitietlienketdaotao($co_so_id, $queryData, $limit, $bac_nghe);
    public function sualienketdaotao($id, $bac_nghe);

    // thanhnv6/27/2020 
    public function createLienKetDaoTao($arrayData);
    public function updateLienKetDaoTao($key, $arrayData);
}
