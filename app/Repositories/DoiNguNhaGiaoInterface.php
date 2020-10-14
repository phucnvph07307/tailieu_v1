<?php
namespace App\Repositories;

interface DoiNguNhaGiaoInterface
{
	public function getDanhSachDoiNguNhaGiao($params);
	public function getNganhNgheTheoCoSo($co_so_id);
	public function chiTietTheoCoSo($co_so_id, $params);
	public function checkTonTaiKhiThem($params);
	public function getSoLieuTheoDot($coSoId, $nam, $dot);
	public function checkImportable($coSoId, $nam, $dot);
}
