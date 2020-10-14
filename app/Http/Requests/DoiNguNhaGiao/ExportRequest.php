<?php

namespace App\Http\Requests\DoiNguNhaGiao;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
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
            'nam' => 'required|integer|in:' . implode(',', config('common.nam.list')),
            'dot' => 'required|integer|in:' . implode(',', config('common.dot')),
            'co_so_id' => 'required|array',
            'co_so_id.*' => 'required|integer|exists:co_so_dao_tao,id',
        ];
    }
}
