<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
use Hash;
use Storage;
use App\Http\Requests\ResetPassWord;
use App\Http\Requests\RegisterAccount;
use App\Http\Requests\UpdateAccount;
use App\Http\Requests\UpdateAccountId;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Services\AccountService;

class AccountController extends Controller
{

    protected $AccountService;

    public function __construct(
        AccountService $AccountService)
    {
        $this->AccountService = $AccountService;
    }

    public function index(Request $request)
    {
        $keyword = $request->has('keyword') ? $request->keyword : null;
        $keyword = trim($keyword);
        $status = $request->has('status') ? $request->status : null;
        $role = $request->has('role') ? $request->role : null;
        $params = $request->all();
        // 2020-06-29 - ThienTH - lấy danh sách roles
        $roleList = Role::all();
        // dd($roleList);

        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $users = $this->AccountService->getAllAccounts($keyword,$status,$role,$params);
        $users->appends(request()->input())->links();

        return view('account.list_account', compact('users', 'keyword',
                                                                'status', 'role', 'params',
                                                                'route_name', 'roleList'));
    }

    public function create()
    {
        return route('account.create_account');
    }


    public function edit($id)
    {
        $check_account = $this->AccountService->findById($id);
        if (!$check_account) {
            return redirect()->route('account.list');
        }
        $user = $this->AccountService->getAccountAndRole($id);
        $data = $this->AccountService->getAllRoles();
        $co_so = $this->AccountService->getAllCoSoDaoTao();
       
        return view('account.edit_account', [
            'data' => $data,
            'user' => $user,
            'co_so' => $co_so
        ]);
    }

    public function updateID(UpdateAccountId $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->co_so_dao_tao_id = $request->co_so_dao_tao_id;
        $user->roles()->sync(['role_id' => $request->role]);
        $user->save();
        return redirect()->route('account.list' , ['user' => $user->id])->withInput()->with('mess', 'Cập nhật tài khoản thành công');
    }
    public function checkName(Request $request){
        $name = $request->name;
        $pattern = '/^[\pL\s\-]+$/u';
        $kq = preg_match($pattern, $name);
        echo $kq == 1 ? "true" : "false";
    }
       
}