@extends('layouts.admin')
@section('title', 'Cập nhật kết quả tốt nghiệp đào tạo nghề gắn với doanh nghiệp')
@section('style')

<style>
    .batbuoc {
        color: red;
    }

    table input {
        border: 1px solid #000 !important;
    }

    th,
    td {
        border-right: 1px solid #fff;
    }

    th {
        text-align: center;
    }

    .error {
        color: red;
    }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
    <form
        action="{{route('xuatbc.post-sua-ket-qua-tot-nghiep-voi-doanh-nghiep', ['id' => $data->id, 'co_so_id' => $data->co_so_id])}}"
        method="post" id="validate-form-update" novalidate>
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chỉnh sửa kết quả tốt nghiệp gắn với doanh nghiệp
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở đào tạo</label>
                                <div class="col-lg-8">
                                    <select class="form-control  " name="ten_co_so" id="ten_co_so" disabled>
                                        <option value="">{{$data->ten}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select class="form-control  " name="nam" id="nam" disabled>
                                        <option value="">{{$data->nam}}</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên nghề đào tạo</label>
                                <div class="col-lg-8">
                                    <select class="form-control " name="ten_nganh_nghe" id="ten_nganh_nghe" disabled>
                                        <option value="">{{$data->nghe_id}} - {{$data->ten_nganh_nghe}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select class="form-control  " name="dot" id="dot" disabled>
                                        <option value="">{{$data->dot}}</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Kết quả HSSV tốt nghiệp gắn với doanh nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Cao đẳng</th>
                                        <th scope="col">Trung cấp</th>
                                        <th scope="col">Sơ cấp</th>
                                        <th scope="col">Dưới 3 tháng </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số HSSV nhập học đầu khóa</td>
                                        <td><input type="number" min="0" name="nhap_hoc_dau_tot_nghiep_CD"
                                                class="form-control name-field"
                                                value="{{$data->nhap_hoc_dau_tot_nghiep_CD}}">@error('nhap_hoc_dau_tot_nghiep_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror</td>

                                        <td><input type="number" min="0" name="nhap_hoc_dau_tot_nghiep_TC"
                                                class="form-control name-field"
                                                value="{{$data->nhap_hoc_dau_tot_nghiep_TC}}">@error('nhap_hoc_dau_tot_nghiep_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror</td>

                                        <td><input type="number" min="0" name="nhap_hoc_dau_tot_nghiep_SC"
                                                class="form-control name-field"
                                                value="{{$data->nhap_hoc_dau_tot_nghiep_SC}}">@error('nhap_hoc_dau_tot_nghiep_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror</td>

                                        <td><input type="number" min="0" name="duoi_3_thang_tot_nghiep_nhap_hoc_dau"
                                                class="form-control name-field"
                                                value="{{$data->duoi_3_thang_tot_nghiep_nhap_hoc_dau}}">@error('duoi_3_thang_tot_nghiep_nhap_hoc_dau')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror</td>
                                    </tr>
                                    <td>
                                    <td><label id="nhap_hoc_dau_tot_nghiep_CD-error" class="error"
                                            for="nhap_hoc_dau_tot_nghiep_CD"></label></td>
                                    <td><label id="nhap_hoc_dau_tot_nghiep_TC-error" class="error"
                                            for="nhap_hoc_dau_tot_nghiep_TC"></label></td>
                                    <td><label id="nhap_hoc_dau_tot_nghiep_SC-error" class="error"
                                            for="nhap_hoc_dau_tot_nghiep_SC"></label></td>
                                    <td><label id="duoi_3_thang_tot_nghiep_nhap_hoc_dau-error" class="error"
                                            for="duoi_3_thang_tot_nghiep_nhap_hoc_dau"></label></td>
                                    </td>
                                    <tr>
                                        <td>Số HSSV tốt nghiệp</td>
                                        <td><input type="number" min="0" name="tot_nghiep_CD"
                                                class="form-control name-field" value="{{$data->tot_nghiep_CD}}">
                                            @error('tot_nghiep_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <td><input type="number" min="0" name="tot_nghiep_TC"
                                                class="form-control name-field" value="{{$data->tot_nghiep_TC}}">
                                            @error('tot_nghiep_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <td><input type="number" min="0" name="tot_nghiep_SC"
                                                class="form-control name-field" value="{{$data->tot_nghiep_SC}}">
                                            @error('tot_nghiep_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <td><input type="number" min="0" name="duoi_3_thang_tot_nghiep"
                                                class="form-control name-field"
                                                value="{{$data->duoi_3_thang_tot_nghiep}}">
                                            @error('duoi_3_thang_tot_nghiep')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><label id="tot_nghiep_CD-error" class="error" for="tot_nghiep_CD"></label>
                                        </td>
                                        <td><label id="tot_nghiep_TC-error" class="error" for="tot_nghiep_TC"></label>
                                        </td>
                                        <td><label id="tot_nghiep_SC-error" class="error" for="tot_nghiep_SC"></label>
                                        </td>
                                        <td><label id="duoi_3_thang_tot_nghiep-error" class="error"
                                                for="duoi_3_thang_tot_nghiep"></label></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start kết quả giải quyết việc làm -->
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Kết quả giải quyết việc làm
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <tbody>
                                    <tr>
                                        <td>Tên doanh nghiệp</td>
                                        <td><input type="text" name="ten_doanh_nghiep" class="form-control"
                                                value="{{$data->ten_doanh_nghiep}}"></td>
                                    </tr>
                                    <tr>
                                        <td>Số HSSV được doanh nghiệp tuyển dụng sau tốt nghiệp</td>
                                        <td><input type="number" min="0" name="so_HSSV_duoc_tuyen_dung"
                                                class="form-control name-field"
                                                value="{{$data->so_HSSV_duoc_tuyen_dung}}">
                                            @error('so_HSSV_duoc_tuyen_dung')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Mức lương doanh nghiệp trả cho HSSV</td>
                                        <td><input type="number" min="0" name="muc_luong_doanh_nghiep_tra"
                                                class="form-control name-field"
                                                value="{{$data->muc_luong_doanh_nghiep_tra}}">
                                            @error('muc_luong_doanh_nghiep_tra')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Tổng số HSSV tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <tbody>
                                    <tr>
                                        <td>Tổng số</td>
                                        <td><input type="number" min="0" name="tong_HSSV_tot_nghiep"
                                                class="form-control name-field" value="{{$data->tong_HSSV_tot_nghiep}}">
                                            @error('tong_HSSV_tot_nghiep')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End kết quả giải quyết việc làm  -->

        <div class="row mt-4" style="float: right">
            <div class="col-md-12">
                <a style="color: white;"
                    href="{{route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $data->co_so_id])}}"><button
                        type="button" class="btn btn-danger mr-5">Hủy</button></a>
                @if ($data->trang_thai >= 3)

                @else
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var routeCheck = "{{ route('so_lieu_tuyen_sinh.check_so_lieu') }}";
var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
$(document).ready(function(){
  $('#co_so_dao_tao').select2();
  $('#ma_nganh_nghe').select2();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('tuyensinh/js/tuyensinh.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
<script src="{!! asset('lien_ket_dao_tao/validate-update-lkdt.js') !!}"></script>
@endsection