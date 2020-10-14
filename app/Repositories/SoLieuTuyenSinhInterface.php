<?php
namespace App\Repositories;

interface SoLieuTuyenSinhInterface
{
	public function getSoLuongTuyenSinh($params, $limit = 10);
	public function getChiTietSoLuongTuyenSinh($coSoId,$limit,$queryData);
	public function getTenCoSoDaoTao();
	public function getmanganhnghe($id);
	public function postthemsolieutuyensinh($getdata);
	public function getsuasolieutuyensinh($id);
	public function getCheckTonTaiSoLieuTuyenSinh($arrcheck);
	public function getDataSeachCoSo($id);
	public function getCoSoTuyenSinhTheoLoaiHinh($id);
	public function getTenQuanHuyen();
	public function getXaPhuongTheoQuanHuyen($id);
	public function getNganhNghe($ma_cap_nghe);
	public function getNgheTheoCapBac($id, $cap_nghe);
}
?>
