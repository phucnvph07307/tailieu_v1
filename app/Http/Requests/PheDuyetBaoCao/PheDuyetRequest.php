<?php

namespace App\Http\Requests\PheDuyetBaoCao;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\PheDuyetBaoCaoService;
use App\Rules\PheDuyet\CheckRoleUserPheDuyetRule;
use App\Models\PheDuyetBaoCao;

class PheDuyetRequest extends FormRequest
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
        $baoCao = PheDuyetBaoCao::find($this->bao_cao_id);
        $listTrangThaiId = app(PheDuyetBaoCaoService::class)
            ->getListTrangThaiCoTheThayDoi($baoCao);

        return [
            'bao_cao_id' => 'required|exists:tien_do_phe_duyet,id',
            'trang_thai' => [
                'required',
                'integer',
                'min:0',
                'exists:trang_thai,id',
                'in:' . implode(',', $listTrangThaiId),
                app(CheckRoleUserPheDuyetRule::class),
            ],
            'li_do_tu_choi' => 'required_if:trang_thai,2',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'integer' => ':attribute không hợp lệ.',
            'min' => ':attribute không hợp lệ.',
            'exists' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes()
    {
        return [
            'trang_thai' => 'Trạng thái',
            'li_do_tu_choi' => 'Lí do từ chối',
        ];
    }
}
