<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class quan_ly_tai_khoan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_arr = [];
        array_push($permission_arr, Permission::create(['name' => 'them_tai_khoan']));
        array_push($permission_arr, Permission::create(['name' => 'sua_tai_khoan']));
    }
}