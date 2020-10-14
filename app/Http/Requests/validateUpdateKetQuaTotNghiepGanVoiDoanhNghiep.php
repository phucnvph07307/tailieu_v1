<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateUpdateKetQuaTotNghiepGanVoiDoanhNghiep extends FormRequest
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
        $data = \Arr::except($this->all(), [
            '_token',
            'ten_doanh_nghiep'
        ]);
        $getDataCheck = [];
        foreach ($data as $item => $value) {
            if ($value == null) {
                $getDataCheck[$item] = 'min:0|';
            } else {
                $getDataCheck[$item] = 'min:0|integer|';
            }
        }
        return $getDataCheck;
    }

    public function messages()
    {
        return [
            'min' => ':attribute không được nhỏ hơn 0',
            'integer' => ':attribute nguyên',
        ];
    }

    public function attributes()
    {
        $data = \Arr::except($this->all(), [
            '_token',
            'ten_doanh_nghiep'
        ]);
        $attributes = [];
        foreach ($data as $item => $value) {
            $attributes[$item] = "Nhập số";
        }
        return $attributes;
    }
}
