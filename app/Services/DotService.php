<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\DotRepository;
use App\Services\AppService;
use Illuminate\Support\Facades\DB;

class DotService extends AppService
{
    public function getRepository()
    {
        return \App\Repositories\DotRepository::class;
    }

    public function index($limit){
        return $this->repository->index($limit);
    }
    
    public function createDot($arrayAdd){
        return $this->repository->createDot($arrayAdd);
    }

    public function findById($id){
        return $this->repository->findById($id);
    }

    public function updateDot($arrayData,$id){
        $data = $arrayData->all();
        unset($data['_token']);
        $this->repository->updateDot($data, $id);
    }
}
?>