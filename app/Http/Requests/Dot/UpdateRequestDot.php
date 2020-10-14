<?php

namespace App\Http\Requests\Dot;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Dot\CheckDotCreate;
class UpdateRequestDot extends FormRequest
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
            'time_start' => 
            [  
                'required',
                 app()->make(CheckDotCreate::class),
            ],
            'time_end' => 'required|after_or_equal:time_start'
            
         ];
    }

    public function messages()
    {
        return [
            'time_start.required' => 'Bạn chưa nhập thời gian bắt đầu',
            'time_end.required' => 'Bạn chưa nhập thời gian kết thúc',
            'time_end.after_or_equal' => 'Thời gian kết thúc phải sau thời gian bắt đầu'
        ];
    }
}
