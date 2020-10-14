<?php

namespace App\Repositories;

interface SoLieuCanBoQuanLyRepositoryInterface
{
	public function getFilterData();
	public function getList(array $params = [], int $limit = 20);
	public function getListByCoSo(int $coSoId, int $limit = 20, array $params = []);
	public function checkTonTaiKhiThem($params);
}