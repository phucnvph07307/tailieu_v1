<?php

namespace App\Repositories;

interface AccountRepositoryInterface
{
    public function getAllAccounts($keyword,$status,$role,$params);
    public function getAccountAndRole($id);
    public function getAllRoles();
}
