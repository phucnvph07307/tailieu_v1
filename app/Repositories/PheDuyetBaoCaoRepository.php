<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\PheDuyetBaoCao;

class PheDuyetBaoCaoRepository extends BaseRepository implements PheDuyetBaoCaoRepositoryInterface
{
    protected $model;

    public function __construct(
        PheDuyetBaoCao $pheDuyetBaoCao
    ) {
        $this->model = $pheDuyetBaoCao;
        parent::__construct();
    }

    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getDanhSachBaoCao(array $params = [])
    {
        $query = $this->model;
        if (isset($params['co_so_dao_tao_id'])) {
            $query->where('co_so_dao_tao_id', $params['co_so_dao_tao_id']);
        }

        return $query->paginate(10);
    }

    public function updateBaoCao($id, array $params = [])
    {
        return $this->model
            ->where('id', $id)
            ->update($params);
    }
}
