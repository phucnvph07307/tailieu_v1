<?php 
namespace App\Repositories;

interface SinhVienTotNghiepInterface
{
	public function index($pardam, $limit);
	public function getTenCoSoDaoTao();
	public function getmanganhnghe($id);
	// public function getDataSeachCoSo($id);
	// public function getCoSoTuyenSinhTheoLoaiHinh($id);
	public function getTenQuanHuyen();
	public function getXaPhuongTheoQuanHuyen($id);
	public function getNganhNghe($ma_cap_nghe);
	public function getNgheTheoCapBac($id, $cap_nghe);
	public function getChiTietTongHopTotNghiep($coSoId,$limit,$queryData);
	public function getSuaSoLieuTotNghiep($id);
	public function getCheckTonTaiSoLieuTotNghiep($arrcheck);
	public function postThemSoLieuTotNghiep($getdata);
}
?>
