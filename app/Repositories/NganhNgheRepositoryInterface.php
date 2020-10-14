<?php


namespace App\Repositories;


interface NganhNgheRepositoryInterface
{
    //    publc function getCsdt();
    public function getAllNganhNghe($bac_nghe, $co_so_id);

    public function boSungNganhNgheVaoCoSo($attributes, $nghe_cao_dang = [], $nghe_trung_cap = []);
    public function getListNganhNghe(array $listIds = [], $selects = ['*']);
}
