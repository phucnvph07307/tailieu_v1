@extends('layouts.admin')
@section('title', "Thêm số liệu tốt nghiệp")
@section('style')
{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<link href="{!! asset('tuyensinh/css/themtuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
    .batbuoc,
    .error {
        color: red;
    }

    table input {
        border: 1px solid #000 !important;
    }

    .alert-danger {
        margin-top: 10px;
    }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
    <form action="{{route('xuatbc.post-them-tong-hop')}}" method="post" id="validate-form">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm mới<small>Tốt nghiệp</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở đào tạo <span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " onchange="getdatacheck(this)" name="co_so_id"
                                        id="co_so_dao_tao">
                                        <option value="">Chọn</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                    @error('co_so_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Mã ngành nghề<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " disabled onchange="getdatacheck(this)" name="nghe_id"
                                        id="ma_nganh_nghe">
                                        <option value="" selected>Mã ngành nghề</option>
                                    </select>
                                    @error('nghe_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm tốt nghiệp<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " onchange="getdatacheck(this)" name="nam" id="nam">
                                        <option value="">Chọn</option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option @if (isset($params['nam']))
                                            {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif value="{{$item}}">
                                            {{$item}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('nam')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt tốt nghiệp<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " onchange="getdatacheck(this)" name="dot" id="dot">
                                        <option value="" selected>Chọn</option>
                                        <option value="1">Đợt 1</option>
                                        <option value="2">Đợt 2</option>
                                    </select>
                                    @error('dot')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    Kết quả tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Trong đó</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tổng số người học tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('Tong_SoNguoi_TN') }}" va
                                                name="Tong_SoNguoi_TN" class="form-control m-input">
                                            @error('Tong_SoNguoi_TN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tổng số nữ</td>
                                        <td><input type="number" value="{{ old('NU_SV_TN') }}" old va name="NU_SV_TN"
                                                class="form-control m-input">
                                            @error('NU_SV_TN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Tổng số dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{ old('DanToc_ThieuSo_ItNguoi') }}" va
                                                name="DanToc_ThieuSo_ItNguoi" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{ old('HoKhauHN') }}" va name="HoKhauHN"
                                                class="form-control m-input">
                                            @error('HoKhauHN')
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
        {{-- start trình độ cao đẳng --}}
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Kết quả tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Cao đẳng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số sinh viên nhập học đầu khóa</td>
                                        <td><input type="number" value="{{ old('SoSV_NhapHoc_DauKhoa_TrinhDoCD') }}" va
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi xét TN</td>
                                        <td><input type="number"
                                                value="{{ old('SoSV_Du_DieuKienThi_XetTN_TrinhDoCD') }}" va
                                                name="SoSV_Du_DieuKienThi_XetTN_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_Du_DieuKienThi_XetTN_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('SoSV_TN_TrinhDoCD') }}" va
                                                name="SoSV_TN_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{ old('SoLuong_Nu_SV_CD') }}" va
                                                name="SoLuong_Nu_SV_CD" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{ old('DanToc_ThieuSo_ItNguoi_CD') }}" va
                                                name="DanToc_ThieuSo_ItNguoi_CD" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('SoSV_HoKhauHN_CD') }}" va
                                                name="SoSV_HoKhauHN_CD" class="form-control m-input">
                                            @error('SoSV_HoKhauHN_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số HSSV tốt nghiệp khá, giỏi</td>
                                        <td><input type="number" value="{{ old('SoLuong_HSSV_TN_Kha_Gioi_CD') }}" va
                                                name="SoLuong_HSSV_TN_Kha_Gioi_CD" class="form-control m-input">
                                            @error('SoLuong_HSSV_TN_Kha_Gioi_CD')
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
                                    Kết quả tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Sơ cấp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số sinh viên nhập học đầu khóa</td>
                                        <td><input type="number" value="{{ old('SoSV_NhapHoc_DauKhoa_TrinhDoSC') }}" va
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi xét TN</td>
                                        <td><input type="number"
                                                value="{{ old('SoSV_Du_DieuKienThi_XetTN_TrinhDoSC') }}" va
                                                name="SoSV_Du_DieuKienThi_XetTN_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_Du_DieuKienThi_XetTN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('SoSV_TN_TrinhDoSC') }}" va
                                                name="SoSV_TN_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{ old('SoLuong_Nu_SV_SC') }}" va
                                                name="SoLuong_Nu_SV_SC" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{ old('DanToc_ThieuSo_ItNguoi_SC') }}" va
                                                name="DanToc_ThieuSo_ItNguoi_SC" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('SoSV_HoKhauHN_SC') }}" va
                                                name="SoSV_HoKhauHN_SC" class="form-control m-input">
                                            @error('SoSV_HoKhauHN_SC')
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
        {{-- end trung cấp cao  đẳng --}}
        {{-- start trung cấp cao đẳng --}}
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Kết quả tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Trung cấp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số sinh viên nhập học đầu khóa</td>
                                        <td><input type="number" value="{{ old('SoSV_NhapHoc_DauKhoa_TrinhDoTC') }}" va
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoTC" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi xét TN</td>
                                        <td><input type="number"
                                                value="{{ old('SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC') }}" va
                                                name="SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('SoSV_TN_TrinhDoTC') }}" va
                                                name="SoSV_TN_TrinhDoTC" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{ old('SoLuong_Nu_SV_TC') }}" va
                                                name="SoLuong_Nu_SV_TC" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{ old('DanToc_ThieuSo_ItNguoi_TC') }}" va
                                                name="DanToc_ThieuSo_ItNguoi_TC" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('SoSV_HoKhauHN_TC') }}" va
                                                name="SoSV_HoKhauHN_TC" class="form-control m-input">
                                            @error('SoSV_HoKhauHN_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Trong đó hộ khẩu Hà Nội thuộc đối tượng tốt nghiệp THCS</td>
                                        <td><input type="number" value="{{ old('HoKhau_HN_Thuoc_DoiTuong_TN_TC') }}" va
                                                name="HoKhau_HN_Thuoc_DoiTuong_TN_TC" class="form-control m-input">
                                            @error('HoKhau_HN_Thuoc_DoiTuong_TN_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số HSSV tốt nghiệp khá, giỏi</td>
                                        <td><input type="number" value="{{ old('SoLuong_HSSV_TN_Kha_Gioi_TC') }}" va
                                                name="SoLuong_HSSV_TN_Kha_Gioi_TC" class="form-control m-input">
                                            @error('SoLuong_HSSV_TN_Kha_Gioi_TC')
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
                                    Kết quả tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Trình độ khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số sinh viên nhập học đầu khóa</td>
                                        <td><input type="number" value="{{ old('SoSV_NhapHoc_DauKhoa_NgheKhac') }}" va
                                                name="SoSV_NhapHoc_DauKhoa_NgheKhac" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi xét TN</td>
                                        <td><input type="number" value="{{ old('SoSV_DuKienThi_XetTN_NgheKhac') }}" va
                                                name="SoSV_DuKienThi_XetTN_NgheKhac" class="form-control m-input">
                                            @error('SoSV_DuKienThi_XetTN_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('SoSV_TN_NgheKhac') }}" va
                                                name="SoSV_TN_NgheKhac" class="form-control m-input">
                                            @error('SoSV_TN_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{ old('SoLuong_Nu_SV_NgheKhac') }}" va
                                                name="SoLuong_Nu_SV_NgheKhac" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{ old('DanToc_ThieuSo_ItNguoi_NgheKhac') }}" va
                                                name="DanToc_ThieuSo_ItNguoi_NgheKhac" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('SoNguoi_HoKhauHN_NgheKhac') }}" va
                                                name="SoNguoi_HoKhauHN_NgheKhac" class="form-control m-input">
                                            @error('SoNguoi_HoKhauHN_NgheKhac')
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
        {{-- end trung cấp cao  đẳng --}}
        {{-- start trung cấp cao đẳng --}}
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Số người có việc làm ngay sau khi tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Cao đẳng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số người có việc làm ngay sau khi tốt nghiệp</td>
                                        <td><input type="number" value="{{ old('SoNguoi_CoViecLamNgay_SauKhi_TN_CD') }}"
                                                va name="SoNguoi_CoViecLamNgay_SauKhi_TN_CD"
                                                class="form-control m-input">
                                            @error('SoNguoi_CoViecLamNgay_SauKhi_TN_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('CoViecLam_HoKhauHN_TrinhDoCD') }}" va
                                                name="CoViecLam_HoKhauHN_TrinhDoCD" class="form-control m-input">
                                            @error('CoViecLam_HoKhauHN_TrinhDoCD')
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
                                    Số người có việc làm ngay sau khi tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Sơ cấp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số người có việc làm ngay sau khi tốt nghiệp</td>
                                        <td><input type="number"
                                                value="{{ old('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC') }}" va
                                                name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('SoLuong_HoKhauHN_TrinhDoSC') }}" va
                                                name="SoLuong_HoKhauHN_TrinhDoSC" class="form-control m-input">
                                            @error('SoLuong_HoKhauHN_TrinhDoSC')
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
        {{-- end trung cấp cao  đẳng --}}
        {{-- start trung cấp cao đẳng --}}
        <div class="row">
            <div class="col-xl-6">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Số người có việc làm ngay sau khi tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Trung cấp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số người có việc làm ngay sau khi tốt nghiệp</td>
                                        <td><input type="number"
                                                value="{{ old('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC') }}" va
                                                name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{ old('CoViecLam_HoKhauHN_TrinhDo_TC') }}" va
                                                name="CoViecLam_HoKhauHN_TrinhDo_TC" class="form-control m-input">
                                            @error('CoViecLam_HoKhauHN_TrinhDo_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội Trình độ Trung cấp tốt nghiệp THCS</td>
                                        <td><input type="number"
                                                value="{{ old('SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC') }}"
                                                va name="SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC')
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
                                    Số người có việc làm ngay sau khi tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <table class="table m-table m-table--head-bg-brand">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="4">Trình độ khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số người có việc làm ngay sau khi tốt nghiệp</td>
                                        <td><input type="number"
                                                value="{{ old('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac') }}"
                                                va name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{ old('SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac') }}" va
                                                name="SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac"
                                                class="form-control m-input">
                                            @error('SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac')
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
        {{-- end trung cấp cao  đẳng --}}
        {{-- start kế hoạch tuyển sinh --}}
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Mức lương trung bình
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
                                        <th scope="col">Khác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mức lương trung bình</td>
                                        <td><input type="number" value="{{ old('MucLuong_TB_CD') }}" va
                                                name="MucLuong_TB_CD" class="form-control m-input">
                                            @error('MucLuong_TB_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{ old('MucLuong_TB_TC') }}" va
                                                name="MucLuong_TB_TC" class="form-control m-input">
                                            @error('MucLuong_TB_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{ old('MucLuong_TB_SC') }}" va
                                                name="MucLuong_TB_SC" class="form-control m-input">
                                            @error('MucLuong_TB_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{ old('MucLuong_TB_NgheKhac') }}" va
                                                name="MucLuong_TB_NgheKhac" class="form-control m-input">
                                            @error('MucLuong_TB_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{ old('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD') }}"
                                                va name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{ old('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC') }}"
                                                va name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{ old('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC') }}"
                                                va name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{ old('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac') }}"
                                                va name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac')
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
        {{-- end kế hoạch tuyển sinh --}}

        @if (session('thongbao'))
        <div class="thongbao" style="color: red; text-align: center;">
            {{session('thongbao')}}
        </div>
        @endif
        <div class="row mt-4" style="float: right">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger mr-5"><a style="color: white"
                        href="{{route('xuatbc.ds-tot-nghiep')}}">Hủy</a></button>
                <button type="submit" class="btn btn-primary">Thêm mới</button>

            </div>
        </div>
    </form>

</div>
@endsection
@section('script')
<script>
    var routeCheck = "{{ route('xuatbc.check_so_lieu_tot_nghiep') }}";
var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
$(document).ready(function(){
  $('#co_so_dao_tao').select2();
  $('#ma_nganh_nghe').select2();
});

</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('tong_hop_ket_qua_tot_nghiep/tong_hop_ket_qua_tot_nghiep.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection