<?php

namespace App\Http\Requests\ChiTieuTuyenSinh;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChiTieuTuyenSinhRequest extends FormRequest
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
        $data = $this->all();
        unset($data['_token']);
        $getDataCheck=[];
        foreach ($data as $item=>$value) {
            if($value == null){
                $getDataCheck[$item] = 'min:0|';
            }else{
                $getDataCheck[$item] = 'min:0|integer|';
            }
        }
        return $getDataCheck;
    }
    public function messages()
    {
        return [
                'integer' => 'Hãy điền số',
                'min' => 'Số liệu nhỏ nhất là 0'
        ];
    }
}
