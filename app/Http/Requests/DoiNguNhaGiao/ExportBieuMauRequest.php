<?php

namespace App\Http\Requests\DoiNguNhaGiao;

use Illuminate\Foundation\Http\FormRequest;

class ExportBieuMauRequest extends FormRequest
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
            'co_so_id' => 'required|integer|exists:co_so_dao_tao,id',
        ];
    }
}
