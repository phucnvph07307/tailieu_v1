<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Requests\PhanQuyen\StorePhanQuyen;
use App\Http\Requests\PhanQuyen\UpdatePhanQuyen;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Repositories\PhanQuyenRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PhanQuyenController extends Controller
{
    private $PhanQuyenRepository;

    public function __construct(PhanQuyenRepository $roleRepo)
    {
        $this->PhanQuyenRepository = $roleRepo;
    }

    public function getQuyen(Request $request)
    {
        $params = $request->all();
        $data = $this->PhanQuyenRepository->getQuyen($params);
        $role = $request->has('role') ? $request->role : null;
        $roleList = Role::all();
        return view('account.phan_quyen_tai_khoan', compact('data','role','roleList'));
    }

    public function themQuyen()
    {
        $data = Permission::all();
        // dd($data);
        return view('account.them-quyen', compact('data'));
    }

    public function saveQuyen(StorePhanQuyen $request)
    {
        $input = $request->except([
            '_token',
            'permissions',
        ]);
        $role = $this->PhanQuyenRepository->create($input);
        $role->givePermissionTo($request->permissions);
        $data = $this->PhanQuyenRepository->all();
        return view('account.phan_quyen_tai_khoan', compact('data'));
    }

    public function suaQuyen($id)
    {
        $role = $this->PhanQuyenRepository->find($id);
        $role->load(['permissions']);
        $dataRole = [];
        foreach ($role->permissions as $key => $value) {
            array_push($dataRole, $value->toArray()["id"]);
        }
        // dd($dataRole);
        return view('account.sua-quyen', compact('dataRole', 'role'));
    }

    public function updateQuyen(UpdatePhanQuyen $request, $id)
    {
        $role = $this->PhanQuyenRepository->find($id);
        $input = $request->except([
            '_token',
            'permissions',
        ]);
        $role = $this->PhanQuyenRepository->update($input, $id);
        $role->permissions()->detach();
        $role->givePermissionTo($request->permissions);
        $dataRole = [];
        foreach ($role->permissions as $key => $value) {
            array_push($dataRole, $value->toArray()["id"]);
        }
        return view('account.sua-quyen', compact('dataRole', 'role'));
    }
}