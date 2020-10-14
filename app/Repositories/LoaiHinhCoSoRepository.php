<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\LoaiHinhCoSo;

class LoaiHinhCoSoRepository extends BaseRepository implements LoaiHinhCoSoRepositoryInterface
{
    protected $model;

    public function __construct(LoaiHinhCoSo $loaiHinhCoSo)
    {
        parent::__construct();

        $this->model = $loaiHinhCoSo;
        $this->table = $loaiHinhCoSo->getTable();
    }

    public function getTable()
    {
        return 'loai_hinh_co_so';
    }

    public function getAll()
    {
        return $this->model->get();
    }
}
