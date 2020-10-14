<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\DotRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Dot;

class DotRepository extends BaseRepository implements DotRepositoryInterface
{

    protected $model;
    public function __construct(
        Dot $model
    ) {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'dot';
    }

    public function index($limit){
        $data = $this->model->paginate($limit);
        return $data;
    }

    public function getAll(){
        $data = $this->model->all();
        return $data;
    }

    public function findById($id){
        $data = $this->model->where('id', $id)->first();
        return $data;
    }

    public function createDot($arrayAdd){
       return  $this->model->create($arrayAdd);
    }
    public function updateDot($arrayAdd,$id){
        return  $this->model->find($id)->update($arrayAdd);
    }
    public function deleteId($id){
        return  $this->model->where('id',$id)->delete();
    }
}
?>