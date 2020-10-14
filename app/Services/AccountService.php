<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;


class AccountService extends AppService
{
    public function getRepository()
    {
        return \App\Repositories\AccountRepository::class;
    }
    
    public function getAllAccounts($keyword,$status,$role,$params)
    {
        return $this->repository->getAllAccounts($keyword,$status,$role,$params);
    }

    public function getAccountAndRole($id)
    {
        return $this->repository->getAccountAndRole($id);
    }

    public function getAllRoles()
    {
        return $this->repository->getAllRoles();
    }

    public function getAllCoSoDaoTao()
    {
        return $this->repository->getAllCoSoDaoTao();
    }
    
}
