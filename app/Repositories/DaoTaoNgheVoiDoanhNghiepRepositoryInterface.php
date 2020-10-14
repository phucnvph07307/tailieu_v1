<?php
namespace App\Repositories;

interface DaoTaoNgheVoiDoanhNghiepRepositoryInterface
{
    public function index($params,$limit);
    public function getTenCoSoDaoTao();
    public function getTenQuanHuyen();
    public function getXaPhuongTheoQuanHuyen($id);
    public function getNganhNghe($ma_cap_nghe);
    public function show($coSoId,$limit,$queryData);
    public function edit($id);
    public function getNganhNgheThuocCoSo($id);
    public function getCheckTonTaiDaoTaoGanVoiDoanhNghiep($arrcheck);
    
    public function getKhuyetTatCsNamDotNoJoin($id_truong,$year,$dot);
    public function getKhuyetTatCsNamDot($id_truong,$year,$dot);
    public function getTuyenSinhDaoTaoDoanhNghiepCsNamDot($id_truong, $year,$dot);
    public function getTuyenSinhDaoTaoDoanhNghiepTimeFromTo($id_truong, $fromDate,$toDate);
}
?>
