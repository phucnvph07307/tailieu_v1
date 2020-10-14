<?php 
namespace App\Repositories;

interface HopTacQuocTeRepositoryInterface
{
    public function getDanhSachKetQuaHopTacQuocTe($params);
    public function checkTonTaiKhiThem($params);
    public function chiTietTheoCoSo($co_so_id, $params);
    // thanhnv6/27/2020
    public function createHopTacQuocTe($arrayData);
    public function updateHopTacQuocTe($key,$arrayData);
	
}
