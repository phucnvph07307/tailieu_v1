<?php

namespace App\Http\Requests\Excel;

use Illuminate\Foundation\Http\FormRequest;

class ExportDuLieu extends FormRequest
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
                'dateFrom' => 'required',
                'dateTo' => 'required|after_or_equal:dateFrom',
                'truong_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'dateFrom.required' => 'Bạn chưa nhập ngày bắt đầu xuất',
            'dateTo.required' => 'Bạn chưa nhập ngày kết thúc đầu xuất',
            'truong_id.required' => 'Bạn chưa chọn trường',
            'dateTo.after_or_equal' => 'Sai lệch thời gian',
        ];
    }
}
