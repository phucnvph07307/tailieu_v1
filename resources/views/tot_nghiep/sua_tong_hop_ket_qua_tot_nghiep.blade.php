@extends('layouts.admin')
@section('title', "Cập nhật liệu tốt nghiệp")
@section('style')

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
    <form action="{{route('xuatbc.post_sua-tong-hop',['id'=>$data_tot_nghiep_id->id])}}" id="validate-form"
        method="post">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Cập nhật<small>Tuyển sinh</small>
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
                                    <select disabled class="form-control ">
                                        <option value="">{{$data_tot_nghiep_id->ten}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Mã ngành nghề<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " disabled>
                                        <option>{{$data_tot_nghiep_id->ten_nganh_nghe}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm tuyển sinh<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " disabled>
                                        <option>{{$data_tot_nghiep_id->nam}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt tuyển sinh<span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control " disabled>
                                        <option>{{$data_tot_nghiep_id->dot}}</option>
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
                                        <td><input type="number" value="{{$data_tot_nghiep_id->Tong_SoNguoi_TN}}"
                                                name="Tong_SoNguoi_TN" class="form-control m-input">
                                            @error('Tong_SoNguoi_TN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tổng số nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->NU_SV_TN}}"
                                                name="NU_SV_TN" class="form-control m-input">
                                            @error('NU_SV_TN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Tổng số dân tộc thiểu số ít người</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->DanToc_ThieuSo_ItNguoi}}"
                                                name="DanToc_ThieuSo_ItNguoi" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->HoKhauHN}}" step="1"
                                                name="HoKhauHN" class="form-control m-input">
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
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_NhapHoc_DauKhoa_TrinhDoCD}}"
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi sét TN</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_Du_DieuKienThi_XetTN_TrinhDoCD}}"
                                                name="SoSV_Du_DieuKienThi_XetTN_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_Du_DieuKienThi_XetTN_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_TN_TrinhDoCD}}"
                                                name="SoSV_TN_TrinhDoCD" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoLuong_Nu_SV_CD}}"
                                                name="SoLuong_Nu_SV_CD" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->DanToc_ThieuSo_ItNguoi_CD}}"
                                                name="DanToc_ThieuSo_ItNguoi_CD" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_HoKhauHN_CD}}"
                                                name="SoSV_HoKhauHN_CD" class="form-control m-input">
                                            @error('SoSV_HoKhauHN_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số HSSV tốt nghiệp khá, giỏi</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoLuong_HSSV_TN_Kha_Gioi_CD}}"
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
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_NhapHoc_DauKhoa_TrinhDoSC}}"
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi sét TN</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_Du_DieuKienThi_XetTN_TrinhDoSC}}"
                                                name="SoSV_Du_DieuKienThi_XetTN_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_Du_DieuKienThi_XetTN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_TN_TrinhDoSC}}"
                                                name="SoSV_TN_TrinhDoSC" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoLuong_Nu_SV_SC}}"
                                                name="SoLuong_Nu_SV_SC" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->DanToc_ThieuSo_ItNguoi_SC}}"
                                                name="DanToc_ThieuSo_ItNguoi_SC" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_HoKhauHN_SC}}"
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
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_NhapHoc_DauKhoa_TrinhDoTC}}"
                                                name="SoSV_NhapHoc_DauKhoa_TrinhDoTC" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi sét TN</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC}}"
                                                name="SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_TN_TrinhDoTC}}"
                                                name="SoSV_TN_TrinhDoTC" class="form-control m-input">
                                            @error('SoSV_TN_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoLuong_Nu_SV_TC}}"
                                                name="SoLuong_Nu_SV_TC" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->DanToc_ThieuSo_ItNguoi_TC}}"
                                                name="DanToc_ThieuSo_ItNguoi_TC" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_HoKhauHN_TC}}"
                                                name="SoSV_HoKhauHN_TC" class="form-control m-input">
                                            @error('SoSV_HoKhauHN_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Trong đó hộ khẩu Hà Nội thuộc đối tượng tốt nghiệp THCS</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->HoKhau_HN_Thuoc_DoiTuong_TN_TC}}"
                                                name="HoKhau_HN_Thuoc_DoiTuong_TN_TC" class="form-control m-input">
                                            @error('HoKhau_HN_Thuoc_DoiTuong_TN_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số HSSV tốt nghiệp khá, giỏi</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoLuong_HSSV_TN_Kha_Gioi_TC}}"
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
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_NhapHoc_DauKhoa_NgheKhac}}"
                                                name="SoSV_NhapHoc_DauKhoa_NgheKhac" class="form-control m-input">
                                            @error('SoSV_NhapHoc_DauKhoa_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số sinh viên đủ điều kiện thi sét TN</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoSV_DuKienThi_XetTN_NgheKhac}}"
                                                name="SoSV_DuKienThi_XetTN_NgheKhac" class="form-control m-input">
                                            @error('SoSV_DuKienThi_XetTN_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Số sinh viên tốt nghiệp</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoSV_TN_NgheKhac}}"
                                                name="SoSV_TN_NgheKhac" class="form-control m-input">
                                            @error('SoSV_TN_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tốt nghiệp Nữ</td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->SoLuong_Nu_SV_NgheKhac}}"
                                                name="SoLuong_Nu_SV_NgheKhac" class="form-control m-input">
                                            @error('SoLuong_Nu_SV_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dân tộc thiểu số ít người</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->DanToc_ThieuSo_ItNguoi_NgheKhac}}"
                                                name="DanToc_ThieuSo_ItNguoi_NgheKhac" class="form-control m-input">
                                            @error('DanToc_ThieuSo_ItNguoi_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoNguoi_HoKhauHN_NgheKhac}}"
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
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoNguoi_CoViecLamNgay_SauKhi_TN_CD}}"
                                                name="SoNguoi_CoViecLamNgay_SauKhi_TN_CD" class="form-control m-input">
                                            @error('SoNguoi_CoViecLamNgay_SauKhi_TN_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->CoViecLam_HoKhauHN_TrinhDoCD}}"
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
                                                value="{{$data_tot_nghiep_id->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC}}"
                                                name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoLuong_HoKhauHN_TrinhDoSC}}"
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
                                                value="{{$data_tot_nghiep_id->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC}}"
                                                name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->CoViecLam_HoKhauHN_TrinhDo_TC}}"
                                                name="CoViecLam_HoKhauHN_TrinhDo_TC" class="form-control m-input">
                                            @error('CoViecLam_HoKhauHN_TrinhDo_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội Trình độ Trung cấp tốt nghiệp THCS</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC}}"
                                                name="SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC"
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
                                                value="{{$data_tot_nghiep_id->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac}}"
                                                name="SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac"
                                                class="form-control m-input">
                                            @error('SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac}}"
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
                                        <td><input type="number" value="{{$data_tot_nghiep_id->MucLuong_TB_CD}}"
                                                name="MucLuong_TB_CD" class="form-control m-input">
                                            @error('MucLuong_TB_CD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->MucLuong_TB_TC}}"
                                                name="MucLuong_TB_TC" class="form-control m-input">
                                            @error('MucLuong_TB_TC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->MucLuong_TB_SC}}"
                                                name="MucLuong_TB_SC" class="form-control m-input">
                                            @error('MucLuong_TB_SC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number" value="{{$data_tot_nghiep_id->MucLuong_TB_NgheKhac}}"
                                                name="MucLuong_TB_NgheKhac" class="form-control m-input">
                                            @error('MucLuong_TB_NgheKhac')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hộ khẩu Hà Nội</td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD}}"
                                                name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC}}"
                                                name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC}}"
                                                name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC"
                                                class="form-control m-input">
                                            @error('MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td><input type="number"
                                                value="{{$data_tot_nghiep_id->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac}}"
                                                name="MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac"
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>

            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection
