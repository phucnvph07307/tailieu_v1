<?php

namespace App\Http\Requests\Excel;

use Illuminate\Foundation\Http\FormRequest;

class ExcelNamDot extends FormRequest
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
            'truong_id' => 'required',
         ];
    }

    public function messages()
    {
        return [
            'truong_id.required' => 'Bạn chưa chọn trường',
        ];
    }
}
