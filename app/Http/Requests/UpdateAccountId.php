<?php

namespace App\Http\Requests;

use App\Rules\CheckEmail;
use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Auth;
class UpdateAccountId extends FormRequest
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
            'phone' => 'required|numeric|digits_between:10,12',
            'name'  => 'required|regex:/^[\pL\s\-]+$/u|min:6|max:40'    
        ];
    }

    public function messages()
    {
        return [
                'phone.required' => 'Vui lòng nhập Số điện thoại',
                'phone.digits_between' => 'Số điện thoại 10 đến 12 số',
                'phone.numeric' => 'Số điện thoại không hợp lệ',
    
                'name.required' => 'Vui lòng nhập Họ và Tên',
                'name.regex' => 'Vui lòng nhập đúng Họ và Tên',
                'name.min' => 'Họ tên ít nhất 6 ký tự',  
                'name.max' => 'Họ tên không được vượt quá 40 ký tự'
 
        ];
    }
}
