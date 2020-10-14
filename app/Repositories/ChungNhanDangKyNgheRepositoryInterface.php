<?php


namespace App\Repositories;


interface ChungNhanDangKyNgheRepositoryInterface
{
    public function getNgheTheoCoSoDaoTao($params, $bac_nghe = null);
    public function getNgheTheoGiayPhep($params, $bac_nghe = null);
    public function xoaNgheTrongGiayPhep($params);
    public function getTongSoTuyenSinhTheoNghe($params);
    public function getNgheTheoChiNhanh($params);
}
