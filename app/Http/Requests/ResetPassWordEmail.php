<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassWordEmail extends FormRequest
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
        return [
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,30}$/',
            'password_confirm' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'password.required'         => 'Mật khẩu không được để rỗng',
            'password.regex'            => 'Mật khẩu phải từ 6 đến 30 ký tự chứa ít nhất chữ 1 chữ thường và 1 chữ số',
            'password_confirm.required' => 'Nhập lại mật khẩu',
            'password_confirm.same' => 'Mật khẩu nhập lại chưa giống nhau',   
        ];
    }
}
