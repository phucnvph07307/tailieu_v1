<?php

namespace App\Http\Requests\PhanQuyen;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class UpdatePhanQuyen extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required',
        ];
        return $rules;
    }
}