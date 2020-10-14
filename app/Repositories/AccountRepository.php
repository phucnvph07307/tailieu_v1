<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Repositories\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function getTable()
    {
        return 'users';
    }


    /* Danh sách tất cả tài khoản.
     * @author: phucnv
     * @created_at 2020-06-30
     * @note: chuyển AccountController thầy Thiện Tối ưu code vào AccountRepository
     */
    public function getAllAccounts($keyword,$status,$role,$params){
        $userQuery = $this->table
            ->leftjoin('co_so_dao_tao', 'users.co_so_dao_tao_id', '=', 'co_so_dao_tao.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select(   'users.*',
                                DB::raw('co_so_dao_tao.ten as ten'),
                                DB::raw('model_has_roles.role_id as user_role'),
                                DB::raw('roles.name as role_name'));

        if(!empty($keyword)){
            $userQuery->where(function ($query) use ($keyword) {
                $query->where('users.name', 'like', '%' . $keyword . '%')
                    ->orWhere('users.phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('users.email', 'like', '%' . $keyword . '%');
            });
        }

        if(!empty($status)){
            $userQuery->where('users.status', '=', $status);
        }
        if(!empty($role)){
            $userQuery->where('model_has_roles.role_id', '=', $role);
        }

        return $userQuery->orderByDesc('id')->paginate($params['page_size']);
    }

    /* Thông tin Account và role_id
     * @author: phucnv
     * @created_at 2020-06-30
     */
    public function getAccountAndRole($id)
    { 
        return  DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->where('model_has_roles.model_id', '=', $id)
        ->first();
    }

    
    /* Danh sách roles.
     * @author: phucnv
     * @created_at 2020-06-30
     */
    public function getAllRoles()
    {
        return  DB::table('roles')->get();
    }

    /* Danh sách cơ sở.
     * @author: phucnv
     * @created_at 2020-07-01
     */
    public function getAllCoSoDaoTao()
    {
        return  DB::table('co_so_dao_tao')->get();
    }
}