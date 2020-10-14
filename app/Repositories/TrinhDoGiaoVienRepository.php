<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\TrinhDoGiaoVien;

class TrinhDoGiaoVienRepository extends BaseRepository implements TrinhDoGiaoVienRepositoryInterface
{
    protected $model;

    public function __construct(TrinhDoGiaoVien $model)
    {
        $this->model = $model;
        $this->table = $model;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
