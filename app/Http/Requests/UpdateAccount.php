<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Auth;
class UpdateAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = Auth::user();
        return [
            // 2020-05-30 - ThienTH - không cho cập nhật email
            // 'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|digits:10|unique:users,phone_number,' . $user->id,
            'name'  => 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40',
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 2020-05-30 - ThienTH - không cho cập nhật email
            // 'email.required'     => 'Vui lòng nhập địa chỉ email',
            // 'email.email'         => 'Vui lòng nhập đúng định dạng email',
            // 'email.unique'            => 'Địa chỉ email đã tồn tại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.digits' => 'Vui lòng nhập số có độ dài 10 ký tự',  
            'phone.unique' => 'Số điện thoại đã tồn tại',  
            'name.required' => 'Vui lòng nhập họ tên', 
            'name.regex' => 'Tên không chứa số hoặc ký tự đặc biệt',
            'name.min' => 'Họ tên ít nhất 6 ký tự',  
            'name.max' => 'Họ tên không được vượt quá 40 ký tự', 
            'avatar.mimes' => 'Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)', 
            'avatar.max' => 'Dung lượng ảnh không được vượt qua 10 MB', 
            'password.required' => 'Vui lòng xác nhận mật khẩu',   
        ];
    }
}
