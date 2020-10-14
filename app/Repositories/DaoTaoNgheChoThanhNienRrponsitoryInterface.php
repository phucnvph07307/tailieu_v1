<?php
namespace App\Repositories;

interface DaoTaoNgheChoThanhNienRrponsitoryInterface
{
    public function index($params,$limit);
    public function getTenCoSoDaoTao();
    public function getTenQuanHuyen();
    public function getXaPhuongTheoQuanHuyen($id);
    public function getNganhNghe($ma_cap_nghe);
    public function getNgheTheoCapBac($id, $cap_nghe);
    public function getChiTietDaoTaoNgheThanhNien($coSoId,$limit,$queryData);
    public function edit($id);
    public function getNganhNgheThuocCoSo($id);
    public function getCheckDaoTaoThanhNien($arrcheck);
    public function store($getdata);
}
?>
