<?php

namespace App\Http\Requests\DoiNguNhaGiao;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DoiNguNhaGiao\ImportFileCheckDigitRule;

class ImportRequest extends FormRequest
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
            'file_import' => [
                'required',
                'mimes:xls,xlsx',
                app()->make(ImportFileCheckDigitRule::class),
            ],
        ];
    }
}
