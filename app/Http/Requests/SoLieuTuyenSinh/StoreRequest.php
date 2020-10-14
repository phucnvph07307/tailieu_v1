<?php

namespace App\Http\Requests\SoLieuTuyenSinh;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        unset($data['_token'],$data['co_so_id'],$data['nghe_id'],$data['nam'],$data['dot'],$data['bao_cao_url']);
        $getDataCheck=[];
        $getDataCheck['co_so_id'] = 'required|';
        $getDataCheck['nghe_id'] = 'required|';
        $getDataCheck['nam'] = 'required|';
        $getDataCheck['dot'] = 'required|';
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
            'required'=>'Không được để trống',
            'min' => ':attribute không được nhỏ hơn 0',
            'integer' => ':attribute nguyên',
        ];
    }

    public function attributes()
    {
        $data = $this->all();
        unset($data['_token']);
        $attributes=[];
        foreach ($data as $item=>$value) {
            $attributes[$item]="Nhập số";
        }
        return $attributes;
    }
}
