@extends('layouts.admin')
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
                        Tạo mới danh sách đội ngũ cán bộ quản lý
                    </h3>
                </div>
            </div>
        </div>
        <div class="content p-5" style="background-color: #FFFFFF ; ">
            <form action="{{ route('so-lieu-can-bo-quan-ly.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="co_so_dao_tao_id" class="col-4">
                            Tên cơ sở đào tạo
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="co_so_dao_tao_id"
                                id="co_so_dao_tao_id"
                                class="form-control select2">
                                @foreach ($listCoSo as $coSo)
                                <option
                                    value="{{ $coSo->id }}"
                                    {{ old('co_so_dao_tao_id') == $coSo->id ? 'selected' : ''}}
                                    >
                                    {{ $coSo->ten }}
                                </option>
                                @endforeach
                            </select>
                            @error('co_so_dao_tao_id')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="loai_hinh_dao_tao_id" class="col-4">
                            Loại hình đào tạo
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <input
                                id="loai_hinh_co_so_id"
                                disabled
                                class="form-control"
                                />
                            @error('loai_hinh_co_so_id')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="nam" class="col-4">
                            Năm
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="nam"
                                id="nam"
                                class="form-control select2">
                                @foreach ($listNam as $key => $value)
                                <option
                                    value="{{ $key }}"
                                    {{ old('nam') == $key ? 'selected' : ''}}
                                    >
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            @error('nam')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="dot" class="col-4">
                            Đợt
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <select
                                name="dot"
                                id="dot"
                                class="form-control select2">
                                @foreach ($listDot as $key => $value)
                                <option
                                    value="{{ $key }}"
                                    {{ old('dot') == $key ? 'selected' : ''}}
                                    >
                                    {{ $value }}
                                </option>
                                @endforeach
                            </select>
                            @error('dot')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="tong_so_quan_ly" class="col-4">
                            Tổng số cán bộ
                            <span class="required">*</span>
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="tong_so_quan_ly"
                                id="tong_so_quan_ly"
                                class="form-control"
                                value="{{ old('tong_so_quan_ly') }}">
                            @error('tong_so_quan_ly')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_cb_quan_ly_nu" class="col-4">
                            Số cán bộ nữ
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_cb_quan_ly_nu"
                                id="so_cb_quan_ly_nu"
                                class="form-control"
                                value="{{ old('so_cb_quan_ly_nu') }}">
                            @error('so_cb_quan_ly_nu')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_dan_toc" class="col-4">
                            Số cán bộ <br>dân tộc thiểu số
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_dan_toc"
                                id="so_dan_toc"
                                class="form-control"
                                value="{{ old('so_dan_toc') }}">
                            @error('so_dan_toc')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_cb_giang_day" class="col-4">
                            Số cán bộ tham gia giảng dạy
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_cb_giang_day"
                                id="so_cb_giang_day"
                                class="form-control"
                                value="{{ old('so_cb_giang_day') }}">
                            @error('so_cb_giang_day')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_cb_da_boi_duong" class="col-4">
                            Số cán bộ đã qua bồi dưỡng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_cb_da_boi_duong"
                                id="so_cb_da_boi_duong"
                                class="form-control"
                                value="{{ old('so_cb_da_boi_duong') }}">
                            @error('so_cb_da_boi_duong')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_danh_hieu" class="col-4">
                            Số danh hiệu <br>nhà giáo nhân dân/ưu tú
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_danh_hieu"
                                id="so_danh_hieu"
                                class="form-control"
                                value="{{ old('so_danh_hieu') }}">
                            @error('so_danh_hieu')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_hieu_truong" class="col-4">
                            Số hiệu trưởng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_hieu_truong"
                                id="so_hieu_truong"
                                class="form-control"
                                value="{{ old('so_hieu_truong') }}">
                            @error('so_hieu_truong')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_hieu_pho" class="col-4">
                            Số hiệu phó
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_hieu_pho"
                                id="so_hieu_pho"
                                class="form-control"
                                value="{{ old('so_hieu_pho') }}">
                            @error('so_hieu_pho')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_truong_khoa" class="col-4">
                            Số trưởng khoa/phòng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_truong_khoa"
                                id="so_truong_khoa"
                                class="form-control"
                                value="{{ old('so_truong_khoa') }}">
                            @error('so_truong_khoa')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_pho_phong" class="col-4">
                            Số phó phòng/khoa
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_pho_phong"
                                id="so_pho_phong"
                                class="form-control"
                                value="{{ old('so_pho_phong') }}">
                            @error('so_pho_phong')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_to_truong" class="col-4">
                            Số tổ trưởng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_to_truong"
                                id="so_to_truong"
                                class="form-control"
                                value="{{ old('so_to_truong') }}">
                            @error('so_to_truong')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_trinh_do_tien_sy" class="col-4">
                            Số Tiến sỹ
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_trinh_do_tien_sy"
                                id="so_trinh_do_tien_sy"
                                class="form-control"
                                value="{{ old('so_trinh_do_tien_sy') }}">
                            @error('so_trinh_do_tien_sy')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_trinh_do_thac_sy" class="col-4">
                            Số Thạc sỹ
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_trinh_do_thac_sy"
                                id="so_trinh_do_thac_sy"
                                class="form-control"
                                value="{{ old('so_trinh_do_thac_sy') }}">
                            @error('so_trinh_do_thac_sy')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_trinh_do_cao_dang" class="col-4">
                            Số Cao đẳng
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_trinh_do_cao_dang"
                                id="so_trinh_do_cao_dang"
                                class="form-control"
                                value="{{ old('so_trinh_do_cao_dang') }}">
                            @error('so_trinh_do_cao_dang')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_trinh_do_trung_cap" class="col-4">
                            Số Trung cấp
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_trinh_do_trung_cap"
                                id="so_trinh_do_trung_cap"
                                class="form-control"
                                value="{{ old('so_trinh_do_trung_cap') }}">
                            @error('so_trinh_do_trung_cap')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-flex align-items-center mt-3">
                        <label for="so_trinh_do_khac" class="col-4">
                            Số Trình độ khác
                        </label>
                        <div class="col-8 p-0">
                            <input
                                type="number"
                                name="so_trinh_do_khac"
                                id="so_trinh_do_khac"
                                class="form-control"
                                value="{{ old('so_trinh_do_khac') }}">
                            @error('so_trinh_do_khac')
                            <small class="required">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 col-12">
                    <button type="reset" class="col-2 btn btn-danger mr-5">Hủy</button>
                    <button type="submit" class="col-2 btn btn-primary ">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('title', "Tạo mới danh sách đội ngũ cán bộ quản lý")

@section('style')
<style>
    .required {
        color: red;
    }
</style>
@endsection

@section('script')
<script>
    $(".select2").select2();
    var listCoSo = {!!  $listCoSo->toJson()  !!};
    let id = $("#co_so_dao_tao_id").val();
    let coSo = listCoSo.find(element => element['id'] == id);
    $("#loai_hinh_co_so_id").val(coSo.loai_hinh_co_so);
    console.log(listCoSo);
    $("#co_so_dao_tao_id").change(() => {
        let id = $("#co_so_dao_tao_id").val();
        let coSo = listCoSo.find(element => element['id'] == id);
        $("#loai_hinh_co_so_id").val(coSo.loai_hinh_co_so);
    });
</script>
@if (session('edit'))
<script>
    Swal.fire({
        title: 'Dữ liệu đã tồn tại',
        text: "Bạn có thể chuyển tới Chỉnh sửa!",
        icon: 'warning',
        showCancelButton: true,
        showconfirmButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Edit'
        }).then((result) => {
            if (result.value) {
                window.location.href = '{{ route('so-lieu-can-bo-quan-ly.edit',['so_lieu_can_bo_quan_ly'=> session('edit')]) }}';
            }
        })
</script>
@endif
@endsection
