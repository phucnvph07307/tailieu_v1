@extends('layouts.admin')
@section('title', "Thêm số liệu sinh viên đang quản lí")
@section('style')
{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<link href="{!! asset('tuyensinh/css/themtuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
    .batbuoc {
        color: red;
    }

    .error {
        color: red;
    }

    table input {
        border: 1px solid #000 !important;
    }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
    <form method="post" novalidate id="validate-form-add">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Sinh Viên Đang Quản Lý <small>Thêm Số Liệu</small>
                        </h3>
                    </div>
                </div>
            </div>
            <form action="{{'xuatbc.them-so-sv'}}" method="POST" class="m-form">
                {{-- <input type="hidden" name="page_size" value="{{$params['page_size']}}"> --}}
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tên cơ sở: <span class="batbuoc">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <select name="co_so_id" class="form-control select2"
                                            onchange="getdatacheck(this)" name="co_so_id" id="co_so_id">
                                            <option value="">Chọn </option>
                                            @foreach ($coso as $item)
                                            <option value="{{$item->id}}">{{$item->ten}}</option>
                                            @endforeach
                                        </select>
                                        @error('co_so_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label id="co_so_dao_tao-error" class="error" for="co_so_id"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Nghề : <span class="batbuoc">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-control select2" disabled onchange="getdatacheck(this)"
                                            name="nghe_id" id="nghe_id">
                                            <option value="">Chọn </option>
                                            @foreach ($nganhNghe as $item)
                                            <option class="form-control " value="{{$item->id}}">
                                                {{$item->ten_nganh_nghe}}
                                                - {{$item->id}}</option>
                                            @endforeach
                                        </select>
                                        @error('nghe_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label id="nghe_id-error" class="error" for="nghe_id"></label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Đợt : <span class="batbuoc">*</span> </label>
                                    <div class="col-lg-8">
                                        <select class="form-control select2" onchange="getdatacheck(this)" name="dot"
                                            id="dot">
                                            <option value="" selected>Chọn</option>
                                            <option value="1">Đợt 1</option>
                                            <option value="2">Đợt 2</option>
                                        </select>
                                        @error('dot')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label id="dot-error" class="error" for="dot"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Năm : <span class="batbuoc">*</span> </label>
                                    <div class="col-lg-8">
                                        <select name="nam" onchange="getdatacheck(this)" class="form-control select2"
                                            name="nam">
                                            <option value="">Chọn </option>
                                            @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                            <option @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif
                                                value="{{$item}}"> {{$item}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('nam')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <label id="nam-error" class="error" for="nam"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                <table class="table m-table m-table--head-bg-brand">
                    <thead>
                        <tr>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Cao đẳng</th>
                            <th scope="col">Trung cấp</th>
                            <th scope="col">Sơ cấp</th>
                            <th scope="col">Khác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tổng số</td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_Cao_dang"
                                    value="{{ old('so_luong_sv_Cao_dang') }}" type="number">
                                @error('so_luong_sv_Cao_dang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_Trung_cap"
                                    value="{{ old('so_luong_sv_Trung_cap') }}" type="number">
                                @error('so_luong_sv_Trung_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_So_cap"
                                    value="{{ old('so_luong_sv_So_cap') }}" type="number">
                                @error('so_luong_sv_So_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_he_khac"
                                    value="{{ old('so_luong_sv_he_khac') }}" type="number">
                                @error('so_luong_sv_he_khac')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label id="so_luong_sv_Cao_dang-error" class="error" for="so_luong_sv_Cao_dang"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_Trung_cap-error" class="error"
                                    for="so_luong_sv_Trung_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_So_cap-error" class="error" for="so_luong_sv_So_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_he_khac-error" class="error" for="so_luong_sv_he_khac"></label>
                            </td>
                        </tr>
                        {{-- <tr>
                    <td></td>
                    <td>
                        @if ($errors->has('so_luong_sv_Cao_dang'))
                        <span class="text-danger">{{ $errors->first('so_luong_sv_Cao_dang') }}</span>
                        @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_Trung_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_Trung_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_So_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_So_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_he_khac'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_he_khac') }}</span>
                            @endif
                        </td>
                        </tr> --}}
                        <tr>
                            <td>Số Lượng Sinh Viên Nữ</td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_nu_Cao_dang"
                                    value="{{ old('so_luong_sv_nu_Cao_dang') }}" type="number">
                                @error('so_luong_sv_nu_Cao_dang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_nu_Trung_cap"
                                    value="{{ old('so_luong_sv_nu_Trung_cap') }}" type="number">
                                @error('so_luong_sv_nu_Trung_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_nu_So_cap"
                                    value="{{ old('so_luong_sv_nu_So_cap') }}" type="number">
                                @error('so_luong_sv_nu_So_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_nu_khac"
                                    value="{{ old('so_luong_sv_nu_khac') }}" type="number">
                                @error('so_luong_sv_nu_khac')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label id="so_luong_sv_nu_Cao_dang-error" class="error"
                                    for="so_luong_sv_nu_Cao_dang"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_nu_Trung_cap-error" class="error"
                                    for="so_luong_sv_nu_Trung_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_nu_So_cap-error" class="error"
                                    for="so_luong_sv_nu_So_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_nu_khac-error" class="error" for="so_luong_sv_nu_khac"></label>
                            </td>
                        </tr>
                        {{-- <tr style="font-size: 1rem">
                    <td></td>
                    <td>
                        @if ($errors->has('so_luong_sv_nu_Cao_dang'))
                        <span class="text-danger">{{ $errors->first('so_luong_sv_nu_Cao_dang') }}</span>
                        @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_nu_Trung_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_nu_Trung_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_nu_So_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_nu_So_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_nu_khac'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_nu_khac') }}</span>
                            @endif
                        </td>
                        </tr> --}}
                        <tr>
                            <td>Số Lượng Sinh Viên Dân Tộc</td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_dan_toc_Cao_dang"
                                    value="{{ old('so_luong_sv_dan_toc_Cao_dang') }}" type="number">
                                @error('so_luong_sv_dan_toc_Cao_dang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_dan_toc_Trung_cap"
                                    value="{{ old('so_luong_sv_dan_toc_Trung_cap') }}" type="number">
                                @error('so_luong_sv_dan_toc_Trung_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_dan_toc_So_cap"
                                    value="{{ old('so_luong_sv_dan_toc_So_cap') }}" type="number">
                                @error('so_luong_sv_dan_toc_So_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_dan_toc_khac"
                                    value="{{ old('so_luong_sv_dan_toc_khac') }}" type="number">
                                @error('so_luong_sv_dan_toc_khac')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label id="so_luong_sv_dan_toc_Cao_dang-error" class="error"
                                    for="so_luong_sv_dan_toc_Cao_dang"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_dan_toc_Trung_cap-error" class="error"
                                    for="so_luong_sv_dan_toc_Trung_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_dan_toc_So_cap-error" class="error"
                                    for="so_luong_sv_dan_toc_So_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_dan_toc_khac-error" class="error"
                                    for="so_luong_sv_dan_toc_khac"></label>
                            </td>
                        </tr>
                        {{-- <tr>
                    <td></td>
                    <td>
                        @if ($errors->has('so_luong_sv_dan_toc_Cao_dang'))
                        <span class="text-danger">{{ $errors->first('so_luong_sv_dan_toc_Cao_dang') }}</span>
                        @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_dan_toc_Trung_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_dan_toc_Trung_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_dan_toc_So_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_dan_toc_So_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_dan_toc_khac'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_dan_toc_khac') }}</span>
                            @endif
                        </td>
                        </tr> --}}
                        <tr>
                            <td>Số Lượng Sinh Viên Hộ Khẩu Hà Nội</td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_ho_khau_HN_Cao_dang"
                                    value="{{ old('so_luong_sv_ho_khau_HN_Cao_dang') }}" type="number">
                                @error('so_luong_sv_ho_khau_HN_Cao_dang')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_ho_khau_HN_Trung_cap"
                                    value="{{ old('so_luong_sv_ho_khau_HN_Trung_cap') }}" type="number">
                                @error('so_luong_sv_ho_khau_HN_Trung_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_ho_khau_HN_So_cap"
                                    value="{{ old('so_luong_sv_ho_khau_HN_So_cap') }}" type="number">
                                @error('so_luong_sv_ho_khau_HN_So_cap')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_luong_sv_ho_khau_HN_khac"
                                    value="{{ old('so_luong_sv_ho_khau_HN_khac') }}" type="number">
                                @error('so_luong_sv_ho_khau_HN_khac')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <label id="so_luong_sv_ho_khau_HN_Cao_dang-error" class="error"
                                    for="so_luong_sv_ho_khau_HN_Cao_dang"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_ho_khau_HN_Trung_cap-error" class="error"
                                    for="so_luong_sv_ho_khau_HN_Trung_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_ho_khau_HN_So_cap-error" class="error"
                                    for="so_luong_sv_ho_khau_HN_So_cap"></label>
                            </td>
                            <td>
                                <label id="so_luong_sv_ho_khau_HN_khac-error" class="error"
                                    for="so_luong_sv_ho_khau_HN_khac"></label>
                            </td>
                        </tr>
                        {{-- <tr>
                    <td></td>
                    <td>
                        @if ($errors->has('so_luong_sv_ho_khau_HN_Cao_dang'))
                        <span class="text-danger">{{ $errors->first('so_luong_sv_ho_khau_HN_Cao_dang') }}</span>
                        @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_ho_khau_HN_Trung_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_ho_khau_HN_Trung_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_ho_khau_HN_So_cap'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_ho_khau_HN_So_cap') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($errors->has('so_luong_sv_ho_khau_HN_khac'))
                            <span class="text-danger">{{ $errors->first('so_luong_sv_ho_khau_HN_khac') }}</span>
                            @endif
                        </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Tổng số
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
                                            <th scope="col">Trong đó</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tổng số học sinh, sinh viên nữ</td>
                                            <td><input name="tong_so_nu" type="number" min="0"
                                                    class="form-control name-field">
                                                @error('tong_so_nu')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <label id="tong_so_nu-error" class="error" for="tong_so_nu"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tổng số học sinh, sinh viên dân tộc</td>
                                            <td><input name="tong_so_dan_toc_thieu_so" type="number" min="0"
                                                    class="form-control name-field">
                                                @error('tong_so_dan_toc_thieu_so')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <label id="tong_so_dan_toc_thieu_so-error" class="error"
                                                    for="tong_so_dan_toc_thieu_so"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tổng số học sinh, sinh viên hộ khẩu Hà Nội</td>
                                            <td><input name="tong_so_ho_khau_HN" type="number" min="0"
                                                    class="form-control name-field">
                                                @error('tong_so_ho_khau_HN')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <label id="tong_so_ho_khau_HN-error" class="error"
                                                    for="tong_so_ho_khau_HN"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tổng số học sinh, sinh viên các trình độ</td>
                                            <td><input name="tong_so_HSSV_co_mat_cac_trinh_do" type="number"
                                                    class="form-control name-field" min="0">
                                                @error('tong_so_HSSV_co_mat_cac_trinh_do')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <label id="tong_so_HSSV_co_mat_cac_trinh_do-error" class="error"
                                                    for="tong_so_HSSV_co_mat_cac_trinh_do"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="float: right">
                <div class="col-md-12">
                    <a style="color: white" href="{{route('xuatbc.ds-sv-dang-hoc')}}"><button type="button"
                            class="btn btn-danger mr-5">Hủy</button></a>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var routeCheck = "{{ route('xuatbc.check-ton-tai-svdql') }}";
    var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
    $(document).ready(function(){
  $('.select2').select2();
});
</script>
<script src="{!! asset('sinh_vien_dang_quan_li/sinh_vien_dang_quan_li.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endsection