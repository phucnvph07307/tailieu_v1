@extends('layouts.admin')
@section('title', "Chi tiết số liệu tốt nghiệp")
@section('style')
{{-- <link href="{!! asset('tuyensinh/css/chitiettuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
    .m-table.m-table--border-danger,
    .m-table.m-table--border-danger th,
    .m-table.m-table--border-danger td {
        border-color: #bcb1b1;
    }

    table thead th[colspan="2"],
    th[colspan="3"],
    th[colspan="4"],
    th[colspan="5"],
    th[colspan="6"],
    th[colspan="7"],
    th[colspan="8"],
    th[colspan="9"] {
        border-bottom-width: 1px;
        border-bottom: 1px solid #bcb1b1 !important;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__body">
            <h3>Cơ sở đào tạo: {{$thongtincoso->ten}}</h3>
            <p>Loại hình cơ sở: {{$thongtincoso->loai_hinh_co_so}}</p>
            <p>Địa chỉ: {{$thongtincoso->dia_chi}}</p>
            <p>Phường/Xã: {{$thongtincoso->ten_xa_phuong}}</p>
            <p>Quận/Huyện: {{$thongtincoso->ten_quan_huyen}}</p>
        </div>
    </div>

    <div class="m-portlet">
        <form action="" method="get" class="m-form">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="nam" id="nam">
                                        <option value="" selected>Chọn</option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option @if (isset($params['nam']))
                                            {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif value="{{$item}}">
                                            {{$item}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="dot" id="dot">
                                        <option value="">Chọn</option>
                                        <option @if (isset($params['dot']))
                                            {{( $params['dot'] ==  1 ) ? 'selected' : ''}} @endif value="1">Đợt 1
                                        </option>
                                        <option value="2" @if (isset($params['dot']))
                                            {{( $params['dot'] ==  2 ) ? 'selected' : ''}} @endif>Đợt 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="m-portlet">

        @if (session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
        @endif
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết <small>Thông tin tốt nghiệp</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-12 form-group m-form__group d-flex justify-content-end">
            <label class="col-lg-2 col-form-label">Kích thước:</label>
            <div class="col-lg-2">
                <select class="form-control" id="page-size">
                    @foreach(config('common.paginate_size.list') as $size)
                    <option @if (isset($params['page_size'])) {{( $params['page_size'] ==  $size ) ? 'selected' : ''}}
                        @endif value="{{$size}}">{{$size}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="m-portlet__body " style="overflow-x:auto;">
            <table style="width: 280%;"
                class="table table-bordered m-table m-table--border-danger m-table--head-bg-primary ">
                <thead>
                    <tr class=" text-center ">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Mã nghề</th>
                        <th rowspan="2">Tên nghề</th>
                        <th rowspan="2">Tổng số người học <br> tốt nghiệp</th>
                        <th colspan="3">Trong đó</th>
                        <th colspan="7">Trình độ Cao đẳng</th>
                        <th colspan="8">Trình độ trung cấp</th>
                        <th colspan="6">Trình độ sơ cấp</th>
                        <th colspan="6">Trình độ đào tạo khác</th>

                        <th colspan="9">Số người có việc làm ngay sau khi tốt nghiệp</th>
                        <th colspan="8">Mức lương trung bình (Triệu đồng / tháng)</th>
                        @can('cap_nhat_chi_tiet_tong_hop_ket_qua_tot_nghiep')
                        <th rowspan="2">Thao tác</th>
                        @endcan
                    </tr>
                    <tr class="pt-3 row2">
                        {{-- start trong đó --}}
                        <th>Nữ</th>
                        <th>Dân tộc thiểu số ít người</th>
                        <th>Hộ khẩu Hà Nội</th>
                        {{-- end trong đó --}}

                        {{-- start trình độ cao đẳng --}}
                        <th>Số SV nhập học đầu khóa</th>
                        <th>Số SV đủ điều kiện thi xét TN</th>
                        <th>Số SV tốt nghiệp</th>
                        <th>Nữ</th>
                        <th>Dân tộc thiểu số ít người</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Số HSSV tốt nghiệp khá giỏi</th>
                        {{-- end trình độ cao đẳng --}}




                        {{-- start Trình độ trung cấp --}}
                        <th>Số SV nhập học đầu khóa</th>
                        <th>Số SV đủ điều kiện thi xét TN</th>
                        <th>Số SV tốt nghiệp</th>
                        <th>Nữ</th>
                        <th>Dân tộc thiểu số ít người</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Hộ khẩu HN thuộc đối tượng tốt nghiệp THCS</th>
                        <th>Số HSSV tốt nghiệp khá giỏi</th>
                        {{-- end Trình độ trung cấp --}}



                        {{-- start Trình độ sơ cấp --}}
                        <th>Số SV nhập học đầu khóa</th>
                        <th>Số SV đủ điều kiện thi xét TN</th>
                        <th>Số SV tốt nghiệp</th>
                        <th>Nữ</th>
                        <th>Dân tộc thiểu số ít người</th>
                        <th>Hộ khẩu Hà Nội</th>
                        {{-- end Trình độ sơ cấp --}}


                        {{-- start Trình độ sơ cấp --}}
                        <th>Số SV nhập học đầu khóa</th>
                        <th>Số SV đủ điều kiện thi xét TN</th>
                        <th>Số SV tốt nghiệp</th>
                        <th>Nữ</th>
                        <th>Dân tộc thiểu số ít người</th>
                        <th>Hộ khẩu Hà Nội</th>
                        {{-- end Trình độ sơ cấp --}}


                        {{-- start việc làm tốt nghiệp --}}
                        <th>Cao Đẳng</th>
                        <th>Hộ khẩu Hà Nội trình độ Cao Đẳng</th>
                        {{-- end việc làm tốt nghiệp --}}

                        {{-- start việc làm tốt nghiệp --}}
                        <th>Trung Cấp</th>
                        <th>Hộ khẩu Hà Nội trình độ Trung Cấp</th>
                        <th>Hộ khẩu HN thuộc đối tượng tốt nghiệp THCS</th>
                        {{-- end việc làm tốt nghiệp --}}


                        {{-- start việc làm tốt nghiệp --}}
                        <th>Sơ Cấp</th>
                        <th>Hộ khẩu Hà Nội trình độ Sơ Cấp</th>
                        {{-- end việc làm tốt nghiệp --}}

                        {{-- start việc làm tốt nghiệp --}}
                        <th>Đào Tạo Nghề Khác</th>
                        <th>Hộ khẩu Hà Nội đào tạo nghề Khác</th>
                        {{-- end việc làm tốt nghiệp --}}

                        {{-- start mức lương tb --}}
                        <th>Cao đẳng</th>
                        <th>Hộ khẩu Hà Nội trình độ Cao Đẳng</th>
                        {{-- end mức lương tb --}}

                        {{-- start mức lương tb --}}
                        <th>Trung cấp</th>
                        <th>Hộ khẩu Hà Nội trình độ Trung Cấp</th>
                        {{-- end mức lương tb --}}

                        {{-- start mức lương tb --}}
                        <th>Sơ cấp</th>
                        <th>Hộ khẩu Hà Nội trình độ Sơ Cấp </th>
                        {{-- end mức lương tb --}}

                        {{-- start mức lương tb --}}
                        <th>Đào tạo nghề Khác</th>
                        <th>Hộ khẩu Hà Nội đào tạo nghề Khác</th>
                        {{-- end mức lương tb --}}


                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>
                        <td>{{$item->nghe_id}}</td>
                        <td>{{$item->ten_nganh_nghe}}</td>
                        <td>{{$item->Tong_SoNguoi_TN}}</td>
                        <td>{{$item->NU_SV_TN}}</td>
                        <td>{{$item->DanToc_ThieuSo_ItNguoi}}</td>
                        <td>{{$item->HoKhauHN}}</td>
                        <td>{{$item->SoSV_NhapHoc_DauKhoa_TrinhDoCD}}</td>
                        <td>{{$item->SoSV_Du_DieuKienThi_XetTN_TrinhDoCD}}</td>
                        <td>{{$item->SoSV_TN_TrinhDoCD}}</td>
                        <td>{{$item->SoLuong_Nu_SV_CD}}</td>
                        <td>{{$item->DanToc_ThieuSo_ItNguoi_CD}}</td>
                        <td>{{$item->SoSV_HoKhauHN_CD}}</td>
                        <td>{{$item->SoLuong_HSSV_TN_Kha_Gioi_CD}}</td>






                        <td>{{$item->SoSV_NhapHoc_DauKhoa_TrinhDoTC}}</td>
                        <td>{{$item->SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC}}</td>
                        <td>{{$item->SoSV_TN_TrinhDoTC}}</td>
                        <td>{{$item->SoLuong_Nu_SV_TC}}</td>
                        <td>{{$item->DanToc_ThieuSo_ItNguoi_TC}}</td>
                        <td>{{$item->SoSV_HoKhauHN_TC}}</td>
                        <td>{{$item->HoKhau_HN_Thuoc_DoiTuong_TN_TC}}</td>
                        <td>{{$item->SoLuong_HSSV_TN_Kha_Gioi_TC}}</td>



                        <td>{{$item->SoSV_NhapHoc_DauKhoa_TrinhDoSC}}</td>
                        <td>{{$item->SoSV_Du_DieuKienThi_XetTN_TrinhDoSC}}</td>
                        <td>{{$item->SoSV_TN_TrinhDoSC}}</td>
                        <td>{{$item->SoLuong_Nu_SV_SC}}</td>
                        <td>{{$item->DanToc_ThieuSo_ItNguoi_SC}}</td>
                        <td>{{$item->SoSV_HoKhauHN_SC}}</td>



                        <td>{{$item->SoSV_NhapHoc_DauKhoa_NgheKhac}}</td>
                        <td>{{$item->SoSV_DuKienThi_XetTN_NgheKhac}}</td>
                        <td>{{$item->SoSV_TN_NgheKhac}}</td>
                        <td>{{$item->SoLuong_Nu_SV_NgheKhac}}</td>
                        <td>{{$item->DanToc_ThieuSo_ItNguoi_NgheKhac}}</td>
                        <td>{{$item->SoNguoi_HoKhauHN_NgheKhac}}</td>






                        <td>{{$item->SoNguoi_CoViecLamNgay_SauKhi_TN_CD}}</td>
                        <td>{{$item->CoViecLam_HoKhauHN_TrinhDoCD}}</td>

                        <td>{{$item->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC}}</td>
                        <td>{{$item->CoViecLam_HoKhauHN_TrinhDo_TC}}</td>
                        <td>{{$item->SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC}}</td>


                        <td>{{$item->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC}}</td>
                        <td>{{$item->SoLuong_HoKhauHN_TrinhDoSC}}</td>

                        <td>{{$item->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac}}</td>
                        <td>{{$item->SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac}}</td>

                        <td>{{number_format($item->MucLuong_TB_CD)}}</td>
                        <td>{{number_format($item->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD)}}</td>

                        <td>{{number_format($item->MucLuong_TB_TC)}}</td>
                        <td>{{number_format($item->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC)}}</td>


                        <td>{{number_format($item->MucLuong_TB_SC)}}</td>
                        <td>{{number_format($item->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC)}}</td>

                        <td>{{number_format($item->MucLuong_TB_NgheKhac)}}</td>
                        <td>{{number_format($item->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac)}}
                        </td>

                        @can('cap_nhat_chi_tiet_tong_hop_ket_qua_tot_nghiep')
                        <td>
                            @if ($item->trang_thai<3) <a href="{{route('xuatbc.sua-tong-hop',['id'=>$item->id])}}">
                                Sửa</a>
                                @endif
                        </td>
                        @endcan
                        
                    </tr>
                    @endforeach

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="m-portlet__foot d-flex justify-content-end">
            {{$data->links()}}
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{!! asset('page_size/page_size.js') !!}"></script>
@endsection