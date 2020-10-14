@extends('layouts.admin')
@section('title', "Chỉnh sửa giáo viên")
@section('content')
<div class="m-content">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chỉnh sửa giáo viên
                    </h3>
                </div>
            </div>
        </div>
        <div class="content p-5" style="background-color: #FFFFFF ; ">
            <form action="{{ route('ql-giao-vien.update', [ 'giaoVien' => $data['id_giao_vien'] ]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="ten_giao_vien" class="col-4">
                            Tên giáo viên
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="ten_giao_vien"
                                id="ten_giao_vien"
                                class="form-control col-12"
                                value="{{ $data['ten_giao_vien'] }}">
                            @error('ten_giao_vien')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="co_so_id" class="col-4">
                            Tên cơ sở đào tạo
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="co_so_id"
                                id="co_so_id"
                                class="form-control col-12 select2">
                                @foreach ($listCoSo as $coSo)
                                <option
                                    value="{{ $coSo->id }}"
                                    {{ $data['co_so_id'] == $coSo->id ? 'selected' : ''}}
                                    >
                                    {{ $coSo->ten }}
                                </option>
                                @endforeach
                            </select>
                            @error('co_so_id')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="gioi_tinh" class="col-4">
                            Giới tính
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                class="form-control col-12"
                                name="gioi_tinh"
                                id="gioi_tinh"
                                required>
                                <option value="" selected disabled>Chọn giới tính</option>
                                <option
                                    value="{{ config('common.giao_vien.gioi_tinh.nam') }}"
                                    {{ $data['gioi_tinh'] == config('common.giao_vien.gioi_tinh.nam') ? 'selected' : ''}}>
                                    Nam
                                </option>
                                <option
                                    value="{{ config('common.giao_vien.gioi_tinh.nu') }}"
                                    {{ $data['gioi_tinh'] == config('common.giao_vien.gioi_tinh.nu') ? 'selected' : ''}}>
                                    Nữ
                                </option>
                            </select>
                            @error('gioi_tinh')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="mon_chung" class="col-4">
                            Môn chung
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="mon_chung"
                                id="mon_chung"
                                class="form-control col-12"
                                value="{{ $data['mon_chung'] }}">
                            @error('mon_chung')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="nganh_nghe" class="col-4">
                            Ngành nghề
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                class="form-control col-12"
                                name="nganh_nghe[]"
                                id="nganh_nghe"
                                multiple
                                required>
                                @foreach ($data['nganh_nghe'] as $key => $nghe)
                                    <option value="{{ $key }}" selected>{{ $nghe }}</option>
                                @endforeach
                            </select>
                            @error('nganh_nghe[]')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="" class="col-4">
                            Dân tộc thiểu số
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="dan_toc_thieu_so"
                                class="form-control col-12"
                                id="">
                                <option
                                    {{ $data['dan_toc_thieu_so'] == config('common.giao_vien.dan_toc_thieu_so.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.dan_toc_thieu_so.khong') }}">
                                    Không
                                </option>
                                <option
                                    {{ $data['dan_toc_thieu_so'] == config('common.giao_vien.dan_toc_thieu_so.co') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.dan_toc_thieu_so.co') }}">
                                    Có
                                </option>
                            </select>
                            @error('dan_toc_thieu_so')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="chuc_danh" class="col-4">
                            Chức danh
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="chuc_danh"
                                class="form-control col-12"
                                id="chuc_danh">
                                <option
                                    {{ $data['chuc_danh'] == config('common.giao_vien.chuc_danh.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.chuc_danh.khong') }}">
                                    Chọn chức danh
                                </option>
                                <option
                                    {{ $data['chuc_danh'] == config('common.giao_vien.chuc_danh.giao_su') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.chuc_danh.giao_su') }}">
                                    Giáo sư
                                </option>
                                <option
                                    {{ $data['chuc_danh'] == config('common.giao_vien.chuc_danh.pho_giao_su') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.chuc_danh.pho_giao_su') }}">
                                    Phó Giáo sư
                                </option>
                            </select>
                            @error('chuc_danh')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="" class="col-4">Nhà giáo nhân dân</label>
                        <div class="col-8 p-0">
                            <select
                                name="nha_giao_nhan_dan"
                                class="form-control col-12"
                                id="nha_giao_nhan_dan">
                                <option
                                    {{ $data['nha_giao_nhan_dan'] == config('common.giao_vien.nha_giao_nhan_dan.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nha_giao_nhan_dan.khong') }}">
                                    Không
                                </option>
                                <option
                                    {{ $data['nha_giao_nhan_dan'] == config('common.giao_vien.nha_giao_nhan_dan.co') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nha_giao_nhan_dan.co') }}">
                                    Có
                                </option>
                            </select>
                            @error('nha_giao_nhan_dan')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="nha_giao_uu_tu" class="col-4">Nhà giáo ưu tú</label>
                        <div class="col-8 p-0">
                            <select
                                name="nha_giao_uu_tu"
                                class="form-control col-12"
                                id="nha_giao_uu_tu">
                                <option
                                    {{ $data['nha_giao_uu_tu'] == config('common.giao_vien.nha_giao_uu_tu.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nha_giao_uu_tu.khong') }}">
                                    Không
                                </option>
                                <option
                                    {{ $data['nha_giao_uu_tu'] == config('common.giao_vien.nha_giao_uu_tu.co') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nha_giao_uu_tu.co') }}">
                                    Có
                                </option>
                            </select>
                            @error('nha_giao_uu_tu')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="" class="col-4">
                            Loại hợp đồng
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="loai_hop_dong"
                                class="form-control col-12"
                                id="loai_hop_dong">
                                <option disabled selected>
                                    Chọn loại hợp đồng
                                </option>
                                <option
                                    {{ $data['loai_hop_dong'] == config('common.giao_vien.loai_hop_dong.bien_che') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.loai_hop_dong.bien_che') }}">
                                    Biên chế
                                </option>
                                <option
                                    {{ $data['loai_hop_dong'] == config('common.giao_vien.loai_hop_dong.hop_dong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.loai_hop_dong.hop_dong') }}">
                                    Hợp đồng
                                </option>
                                <option
                                    {{ $data['loai_hop_dong'] == config('common.giao_vien.loai_hop_dong.thinh_giang') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.loai_hop_dong.thinh_giang') }}">
                                    Thỉnh giảng
                                </option>
                            </select>
                            @error('loai_hop_dong')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_tien_sy" class="col-4">
                            Trình độ Tiến sỹ
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_tien_sy"
                                id="trinh_do_tien_sy"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_tien_sy'] }}">
                            @error('trinh_do_tien_sy')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_thac_sy" class="col-4">
                            Trình độ Thạc sỹ
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_thac_sy"
                                id="trinh_do_thac_sy"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_thac_sy'] }}">
                            @error('trinh_do_thac_sy')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_dai_hoc" class="col-4">
                            Trình độ Đại học
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_dai_hoc"
                                id="trinh_do_dai_hoc"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_dai_hoc'] }}">
                            @error('trinh_do_dai_hoc')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_cao_dang" class="col-4">
                            Trình độ Cao đẳng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_cao_dang"
                                id="trinh_do_cao_dang"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_cao_dang'] }}">
                            @error('trinh_do_cao_dang')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_trung_cap" class="col-4">
                            Trình độ Trung cấp
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_trung_cap"
                                id="trinh_do_trung_cap"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_trung_cap'] }}">
                            @error('trinh_do_trung_cap')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_khac" class="col-4">
                            Trình độ Khác
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="text"
                                name="trinh_do_khac"
                                id="trinh_do_khac"
                                class="form-control col-12"
                                value="{{ $data['trinh_do_khac'] }}">
                            @error('trinh_do_khac')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="" class="col-4">
                            Trình độ ngoại ngữ
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="trinh_do_ngoai_ngu"
                                class="form-control col-12"
                                id="trinh_do_ngoai_ngu">
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.0') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.0') }}">
                                    Chọn trình độ ngoại ngữ
                                </option>
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.1') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.1') }}">
                                    1
                                </option>
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.2') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.2') }}">
                                    2
                                </option>
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.3') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.3') }}">
                                    3
                                </option>
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.4') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.4') }}">
                                    4
                                </option>
                                <option
                                    {{ $data['trinh_do_ngoai_ngu'] == config('common.giao_vien.trinh_do_ngoai_ngu.5') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_ngoai_ngu.5') }}">
                                    5
                                </option>
                            </select>
                            @error('trinh_do_ngoai_ngu')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="trinh_do_nghe" class="col-4">
                            Trình độ<br>kỹ năng nghề
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="trinh_do_nghe"
                                class="form-control col-12"
                                id="trinh_do_nghe">
                                <option
                                    {{ $data['trinh_do_nghe'] == config('common.giao_vien.trinh_do_nghe.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_nghe.khong') }}">
                                    Chọn trình độ nghề
                                </option>
                                <option
                                    {{ $data['trinh_do_nghe'] == config('common.giao_vien.trinh_do_nghe.bac_1') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_nghe.bac_1') }}">
                                    Bậc 1
                                </option>
                                <option
                                    {{ $data['trinh_do_nghe'] == config('common.giao_vien.trinh_do_nghe.bac_2') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_nghe.bac_2') }}">
                                    Bậc 2
                                </option>
                                <option
                                    {{ $data['trinh_do_nghe'] == config('common.giao_vien.trinh_do_nghe.bac_3') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_nghe.bac_3') }}">
                                    Bậc 3
                                </option>
                            </select>
                            @error('trinh_do_nghe')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="nghiep_vu_su_pham" class="col-4">
                            Trình độ nghiệp vụ<br> sư phạm
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="nghiep_vu_su_pham"
                                class="form-control col-12"
                                id="nghiep_vu_su_pham">
                                <option
                                    {{ $data['nghiep_vu_su_pham'] == config('common.giao_vien.nghiep_vu_su_pham.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nghiep_vu_su_pham.khong') }}">
                                    Chọn trình độ nghiệp vụ sư phạm
                                </option>
                                <option
                                    {{ $data['nghiep_vu_su_pham'] == config('common.giao_vien.nghiep_vu_su_pham.cao_dang') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nghiep_vu_su_pham.cao_dang') }}">
                                    Cao đẳng
                                </option>
                                <option
                                    {{ $data['nghiep_vu_su_pham'] == config('common.giao_vien.nghiep_vu_su_pham.trung_cap') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nghiep_vu_su_pham.trung_cap') }}">
                                    Trung cấp
                                </option>
                                <option
                                    {{ $data['nghiep_vu_su_pham'] == config('common.giao_vien.nghiep_vu_su_pham.so_cap') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.nghiep_vu_su_pham.so_cap') }}">
                                    Sơ cấp
                                </option>
                            </select>
                            @error('nghiep_vu_su_pham')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="" class="col-4">
                            Trình độ tin học
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="trinh_do_tin_hoc"
                                class="form-control col-12"
                                id="trinh_do_tin_hoc">
                                <option
                                    {{ $data['trinh_do_tin_hoc'] == config('common.giao_vien.trinh_do_tin_hoc.khong') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_tin_hoc.khong') }}">
                                    Chọn trình độ tin học
                                </option>
                                <option
                                    {{ $data['trinh_do_tin_hoc'] == config('common.giao_vien.trinh_do_tin_hoc.co_ban') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_tin_hoc.co_ban') }}">
                                    Cơ bản
                                </option>
                                <option
                                    {{ $data['trinh_do_tin_hoc'] == config('common.giao_vien.trinh_do_tin_hoc.nang_cao') ? 'selected' : ''}}
                                    value="{{ config('common.giao_vien.trinh_do_tin_hoc.nang_cao') }}">
                                    Nâng cao
                                </option>
                            </select>
                            @error('trinh_do_tin_hoc')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 col-12">
                    <button type="reset" class="col-2 btn btn-danger mr-5">Hủy</button>
                    <button type="submit" class="col-2 btn btn-primary ">Chỉnh sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title', "Thêm giáo viên")

@section('style')
<style>
    .col-12 label {
        font-size: 1rem;
    }

    .required {
        color: red;
    }
</style>
@endsection

@section('script')
<script>
    $(".select2").select2();

    $('#nganh_nghe').select2({
        ajax: {
            url: "{{ route('nghe.search') }}",
            method: 'GET',
            data: function(params){
                var query = {
                    keyword: params.term || '',
                    page: params.page || 1
                }
                return query;
            },
            cache: true,
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.data,
                    pagination: {
                        more: data.current_page !== data.last_page
                    }
                };
            }
        }
    });
</script>
@endsection
