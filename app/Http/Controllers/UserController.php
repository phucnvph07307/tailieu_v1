<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;
// use Hash;
use Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetPassWord;
use App\Http\Requests\RegisterAccount;
use App\Http\Requests\UpdateAccount;
class UserController extends Controller
{
    public function getdangkytaikhoan(){
        $user = DB::table('roles')->get();
        $co_so = DB::table('co_so_dao_tao')->get();
        return view('account.dang_ky', compact('user','co_so'));
    }

    public function dangkytaikhoan(RegisterAccount $request){
        $params = $request->all();
        unset($params['can_bo']);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->co_so_dao_tao_id = $request->co_so_dao_tao_id;
        $user->avatar = "uploads/avatars/user.png";
        $code = bcrypt(md5(time().$request->email));
        $user->password=bcrypt(md5(time().$request->email));
        $user->code = $code;
        $user->time_code= Carbon::now();
        $user->save();
        DB::table('model_has_roles')->insert(['role_id'=>$request->role,
                                              'model_type'=> 'App\User' ,
                                              'model_id'=>$user->id]);
        $email = $user->email;
        $url = route('link_reset_password',['code'=>$user->code,'email'=>$email]);
        $data=[
            'route'=>$url,
            'title'=>"Tài khoản được đăng ký thành công"
        ];

        Mail::send('account.email_dang_ky',$data,function($message) use ($email) {
            $message->to($email,'Reset password')->subject('Bạn đã được đăng ký tài khoản');
        });
         return redirect()->back()->with('thongbao','Đăng ký tài khoản thành công');
    }

    public function getcapnhattaikhoan(){
       $user = Auth::user();
        return view('account.cap_nhat_tai_khoan', compact('user'));
    }

    public function capnhattaikhoan(UpdateAccount $request){
        $user = Auth::user();
       
        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()->with('thongbaoloi','Xác nhận mật khẩu không chính xác');
        }
        
        // 2020-05-30 - ThienTH - không cho cập nhật
        // $user->email=$request->email;
        $user->phone_number=$request->phone;
        $user->name=$request->name;
        $get_avatar =$request->file("avatar");
        if($get_avatar){
            $path = $request->file('avatar')->store('uploads/avatars');
            $user->avatar=$path;
        }
       
        $user->save();
        return redirect()->back()->with('thongbao','Cập nhật tài khoản thành công');
    }
    public function getdoimatkhau(){
        $user = Auth::user();
        $email= $user->email;
        return view('account.doi_mat_khau', compact('email'));
    }

    //đổi mật khẩu khi login
    public function doimatkhau(ResetPassWord $request){
        $user = Auth::user();
        if(!Hash::check($request->password_old, $user->password)){
            return redirect()->back()->with('thongbaoloi','Xác nhận mật khẩu không chính xác');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect()->route('login')->with('success','Mật khẩu đã được thay đổi thành công, Mời bạn đăng nhập');
    }

    public function checkemail(Request $request){
        $email = $request->name;
        $queryUser = User::where('email', $email);
        $id = isset($request->id) ? $request->id : -1;
        if($id != -1){
	        $queryUser->where('id', '!=', $id);
        }
        
        $numberEmail = $queryUser->count();
        echo $numberEmail == 0 ? "true" : "false";
    }

    public function checkphone(Request $request){
        $phone = $request->name;
        $queryUser = User::where('phone_number', $phone);
        $id = isset($request->id) ? $request->id : -1;
        if($id != -1){
	        $queryUser->where('id', '!=', $id);
        }
        $numberPhone = $queryUser->count();
        echo $numberPhone == 0 ? "true" : "false";
    }

    public function create(RegisterAccount $request ){
        return User::create([
            'name' => $request['name'],
            'phone_number' =>$request['phone_number'],
            'email' => $request['email'],
            'password' =>Hash::make($request['password']),
        ]);
    }
   


}