<?php

namespace App\Http\Requests\SoLieuCanBoQuanLy;

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
        return [
            "co_so_dao_tao_id" => 'required|integer|exists:co_so_dao_tao,id',
            "nam" => "required|integer|in:" . implode(',', config('common.nam.list')),
            "dot" => "required|integer|in:" . implode(',', config('common.dot')),
            "tong_so_quan_ly" => 'required|integer|min:0',
            "so_cb_quan_ly_nu" => 'nullable|integer|min:0',
            "so_dan_toc" => 'nullable|integer|min:0',
            "so_cb_giang_day" => 'nullable|integer|min:0',
            "so_cb_da_boi_duong" => 'nullable|integer|min:0',
            "so_danh_hieu" => 'nullable|integer|min:0',
            "so_hieu_truong" => 'nullable|integer|min:0',
            "so_hieu_pho" => 'nullable|integer|min:0',
            "so_truong_khoa" => 'nullable|integer|min:0',
            "so_to_truong" => 'nullable|integer|min:0',
            "so_pho_phong" => 'nullable|integer|min:0',
            "so_trinh_do_tien_sy" => 'nullable|integer|min:0',
            "so_trinh_do_thac_sy" => 'nullable|integer|min:0',
            "so_trinh_do_cao_dang" => 'nullable|integer|min:0',
            "so_trinh_do_trung_cap" => 'nullable|integer|min:0',
            "so_trinh_do_khac" => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường :attribute không được để trống',
            'integer' => 'Trường :attribute phải là số nguyên',
            'min' => 'Trường :attribute phải là số dương',
            'exists' => 'Trường :attribute không hợp lệ',
            'in' => 'Trường :attribute không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'co_so_dao_tao_id' => 'Tên cơ sở đào tạo',
            'loai_hinh_co_so_id' => 'Loại hình đào tạo',
            'nam' => 'Năm',
            'dot' => 'Đợt',
            'tong_so_quan_ly' => 'Tổng số quản lý',
            'so_cb_quan_ly_nu' => 'Số cán bộ quản lý nữ',
            'so_pho_phong' => 'Số cán bộ dân tộc',
            'so_cb_giang_day' => 'Số cán bộ tham gia giảng dạy',
            'so_cb_da_boi_duong' => 'Số cán bộ đã qua bồi dưỡng',
            'so_danh_hieu' => 'Số danh hiệu nhà giáo nhân dân/ưu tú',
            'so_hieu_truong' => 'Số hiệu trưởng',
            'so_hieu_pho' => 'Số hiệu phó',
            'so_truong_khoa' => 'Số trưởng khoa',
            'so_dan_toc' => 'Số phó khoa',
            'so_to_truong' => 'Số tổ trưởng',
            'so_trinh_do_tien_sy' => 'Số tiến sỹ',
            'so_trinh_do_thac_sy' => 'Số thạc sỹ',
            'so_trinh_do_cao_dang' => 'Số cao đẳng',
            'so_trinh_do_trung_cap' => 'Số trung cấp',
            'so_trinh_do_khac' => 'Số trình độ khác',
        ];
    }
}
