<?php

namespace App\Http\Requests\NganhNghe;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules(){

        return [
           'id_nghe_4' => 'unique:nganh_nghe,id,'.request()->id,
           'nghe_cap_3' => 'required',
           'number_nghe_4' => 'required|digits:2',
           'ten_nganh_nghe' => 'required',
        ]; 
    }
    
    public function messages()
    {
        return [
            'required'=>'Không được để trống',
            'unique' => 'Mã ngành nghề đã tồn tại',
            'digits' => 'Nhập số có độ dài 2 kí tự',
        ];
    }
}
