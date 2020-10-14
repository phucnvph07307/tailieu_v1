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
use App\Http\Requests\ResetPassWordEmail;

class AuthController extends Controller
{
    public function login(Request $request){
    	$phone_or_email = $request->phone;
    	$password = $request->password;
    	$remember = $request->has("remember") ? true : false;

    	if(Auth::attempt(["phone_number"=>$phone_or_email,"password"=>$password,"status"=>1],$remember)){
    		 return redirect('dashboard');
    	}else if(Auth::attempt(["email"=>$phone_or_email,"password"=>$password,"status"=>1],$remember)){
             return redirect('dashboard');
        }else{
    		 return redirect()->back()->with('thongbao','Tài khoản hoặc mật khẩu không đúng');
    	}
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }

    public function forgot_pass(Request $request){
        $email = $request->email;
        $checkUser = User::where("email",$email)->first();
        if(!$checkUser){
            return response()->json(['thongbaoloi'=>"Địa chỉ email không tồn tại"],200);
        }
        $code = bcrypt(md5(time().$email));
        $checkUser->code = $code;
        $checkUser->time_code= Carbon::now();
        $checkUser->save();
        $toemail = $checkUser->email;
        
        // 2020-05-30 - thienth 
        // update account.link_reset_password => link_reset_password
        $url = route('link_reset_password',['code'=>$checkUser->code,'email'=>$email]);
        $data=[
            'route'=>$url,
            'title'=>"Lấy lại mật khẩu"
        ];

        // 2020-05-30 - thienth 
        // update email_reset_pass => account.email_reset_pass
        Mail::send('account.email_reset_pass',$data,function($message) use ($toemail) {
            $message->to($toemail,'Reset password')->subject('Lấy lại mật khẩu');
        });

        return response()->json(['thongbaothanhcong'=>"Thành công ! Vui lòng kiểm tra email để thay đổi mật khẩu"],200);


    }
    public function reset_pass(Request $request){
        $code = $request->code;
        $email= $request->email;
        $checkUser = User::where([
            "code" => $code,
            "email" => $email
        ])->first();
        if($checkUser){
           return view('account.reset_pass');
        }else{
            return redirect()->back()->with('thongbao','Lỗi xác thực không thành công');         
        }
    }
    public function post_reset_pass(ResetPassWordEmail $request){
        $code = $request->code;
        $email= $request->email;
        $checkUser = User::where([
            "code" => $code,
            "email" => $email
        ])->first();

        $hethan =Carbon::parse($checkUser->time_code);
        $hientai= Carbon::now();

        // dd(!$hientai->diffInMinutes($hethan)>=1440);

        if(!$checkUser || $hientai->diffInMinutes($hethan)>=1440){
         return redirect()->back()->with('thongbao','Lỗi xác thực không thành công');
        };

        $checkUser->password = Hash::make($request->password);
        $checkUser->email_verified_at = Carbon::now();
        $checkUser->save();
        return redirect()->route('login')->with('success','Mật khẩu đã được thay đổi thành công, Mời bạn đăng nhập');
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

}
