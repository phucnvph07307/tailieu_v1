<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Repositories\BaseRepository;



class PhanQuyenRepository extends AppRepository
{

    protected $fieldSearchable = [
        'name',
        'permissions',
    ];


    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }


    public function getQuyen($params)
    {
       $query = $this->model::query();
        if(isset($params['role']) && $params['role'] != null){
            $query->where('id','=',$params['role']);
        }
        return $query->get();
    }
}