<?php

/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/2/20
 * Time: 15:16
 */

namespace App\Services;


use App\Repositories\ChungNhanDangKyNgheRepository;

class ChungNhanDangKyService extends AppService
{
    public function getRepository()
    {
        return ChungNhanDangKyNgheRepository::class;
    }

    public function getCoSoDaoTaoTheoNghe($params)
    {

        return $this->repository->getCoSoDaoTaoTheoNghe($params);
    }

    public function getNgheTheoCoSoDaoTao($params, $bac_nghe = null)
    {

        return $this->repository->getNgheTheoCoSoDaoTao($params, $bac_nghe);
    }

    public function getNgheTheoGiayPhep($params, $bac_nghe = null)
    {
        return $this->repository->getNgheTheoGiayPhep($params, $bac_nghe);
    }
    public function xoaNgheTrongGiayPhep($params)
    {
        return $this->repository->xoaNgheTrongGiayPhep($params);
    }
    public function getTongSoTuyenSinhTheoNghe($params)
    {
        return $this->repository->getTongSoTuyenSinhTheoNghe($params);
    }
    public function getNgheTheoChiNhanh($params)
    {
        return $this->repository->getNgheTheoChiNhanh($params);
    }
}
