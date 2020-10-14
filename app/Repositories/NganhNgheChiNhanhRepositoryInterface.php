<?php


namespace App\Repositories;


interface NganhNgheChiNhanhRepositoryInterface
{
    public function boSungNgheVaoChiNhanh($data, $nghe_cao_dang = [], $nghe_trung_cap = []);
    public function getNgheTheoChiNhanh($params);
}
