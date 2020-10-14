<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;

class PermissionsSeeder extends Seeder
{

    public function run()
    {
        $permission_arr = [];
        array_push($permission_arr, Permission::create(['name' => 'them_so_luong_sinh_vien_dang_theo_hoc']));
        array_push($permission_arr, Permission::create(['name' => 'sua_so_luong_sinh_vien_dang_theo_hoc']));
        $xemSoLuongSinhVienTheoHoc = Permission::create(['name' => 'xem_so_luong_sinh_vien_dang_theo_hoc']);
        array_push($permission_arr, $xemSoLuongSinhVienTheoHoc);
        $IT = Role::create(['name' => 'IT']);
        $IT->syncWithoutDetachingPermissions($permission_arr);
        $quanLy = Role::create(['name' => 'QuanLy']);
        $quanLy->givePermissionTo($xemSoLuongSinhVienTheoHoc);

        $userSuper = User::create([
            'name' => 'Thienth',
            'phone_number' => '0965122343',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin@admin123'),
        ]);
        $userSuper->assignRole('IT');
        $userViews = User::create([
            'name' => 'Cuongnc',
            'phone_number' => '0965122243',
            'email' => 'view@gmail.com',
            'password' => Hash::make('admin@admin123'),
        ]);
        $userViews->assignRole('QuanLy');
        User::create([
            'name' => 'Tiennh',
            'phone_number' => '0965123322',
            'email' => 'users@gmail.com',
            'password' => Hash::make('admin@admin123'),
        ]);
    }
}