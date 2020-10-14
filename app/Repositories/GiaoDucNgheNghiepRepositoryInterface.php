<?php
namespace App\Repositories;

interface GiaoDucNgheNghiepRepositoryInterface
{
    public function index($params,$limit);
    public function getTenCoSoDaoTao();
    public function getTenQuanHuyen();
    public function getXaPhuongTheoQuanHuyen($id);
    public function getNganhNghe($ma_cap_nghe);
    public function edit($id);
    public function getNganhNgheThuocCoSo($id);
    public function getCheckTonTaiGiaoDucNgheNghiep($arrcheck);
    // thanhnv
    public function getThongTinDangKyTimeFromTo($id_truong, $fromDate,$toDate);
    public function getGiaoDucNgheNghiepCsNamDot($id_truong, $year,$dot);
    public function getAllCsJoinChuQuanVaDangKyGiay();
    public function getSomeCsJoinChuQuanVaDangKyGiay($listCoSoId);
    public function getOnlyOneCsJoinChuQuanVaDangKyGiay($id_coso);
}
?>
