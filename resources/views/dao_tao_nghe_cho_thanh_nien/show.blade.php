@extends('layouts.admin')
@section('title', "Chi tiết tổng hợp đào tạo nghề cho thanh niên")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" /><style>
    .m-table.m-table--border-danger, .m-table.m-table--border-danger th, .m-table.m-table--border-danger td{
        border-color: #bcb1b1 ;
    } 
    table thead th[colspan="4"]{
        border-bottom-width:1px;
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
                                        <option value="" selected >Chọn</option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option 
                                        @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}}  
                                                @endif
                                                value="{{$item}}"> {{$item}}
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
                                        <option value="" >Chọn</option>
                                        <option
                                        @if (isset($params['dot']))
                                            {{( $params['dot'] ==  1 ) ? 'selected' : ''}}  
                                        @endif
                                        value="1" >Đợt 1</option>
                                        <option value="2"
                                        @if (isset($params['dot']))
                                        {{( $params['dot'] ==  2 ) ? 'selected' : ''}}  
                                        @endif
                                        >Đợt 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Ngành nghề</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="nganh_nghe" id="nganh_nghe">
                                        <option value="" selected >Chọn</option>
                                        @foreach ($nganh_nghe_cap_4_thuoc_co_so as $item)
                                        <option 
                                        @if (isset($params['nganh_nghe']))
                                                {{( $params['nganh_nghe'] ==  $item ) ? 'selected' : ''}}  
                                                @endif
                                                value="{{$item->id}}"> {{$item->id}}-{{$item->ten_nganh_nghe}}
                                            </option>
                                        @endforeach
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
        <div class="col-12 form-group m-form__group d-flex justify-content-end">
            <label class="col-lg-2 col-form-label">Kích thước:</label>
            <div class="col-lg-2">
                <select class="form-control" id="page-size">
                    @foreach(config('common.paginate_size.list') as $size)
                    <option @if (isset($params['page_size']))
                        {{( $params['page_size'] ==  $size ) ? 'selected' : ''}} @endif value="{{$size}}">{{$size}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

    <div class="m-portlet">
        @if (session('thongbao')) 
            <div class="alert alert-success">
            {{session('thongbao')}}
            </div>
            @endif 

        <div class="m-portlet__body table-responsive" style="overflow-x:auto;">
            <table style="width: 250%;" class="table table-bordered m-table m-table--border-danger m-table--head-bg-primary table-boder-white">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Mã Nghề</th>
                        <th rowspan="2">Tên Nghề</th>
                        <th rowspan="2">Thời gian đào tạo <br>(Tháng)</th>
                        <th colspan="3">Tổng số Tuyển sinh</th>
                        <th colspan="3">Tuyển sinh bộ đội xuất ngũ </th>
                        <th colspan="3">Tuyển sinh CA hoàn thành nghĩa vụ </th>
                        <th colspan="3">Tuyển sinh thanh niên tình nguyện</th>
                        <th colspan="3">Tổng số tốt nghiệp</th>
                        <th colspan="3">Bộ đội xuất ngũ tốt nghiệp</th>
                        <th colspan="3">CA hoàn thành nghĩa vụ tốt nghiệp</th>
                        <th colspan="3">Thanh niên tình nguyện tốt nghiệp</th>
                        <th colspan="4">Kinh phí</th>
                        <th rowspan="2">Thao tác</th> 
                    </tr>
                    <tr class="pt-3 row2">
                        <th>Tổng số học viên các đối tượng</th>
                        <th>Tổng số nữ</th>
                        <th>Tổng số hộ khẩu Hà Nội</th>

                        <th>Tổng tuyển sinh theo trình độ</th>
                        <th>Tuyển sinh nữ theo trình độ</th>
                        <th>Tuyển sinh hộ khẩu Hà Nội theo trình độ</th>
                        <th>Tổng tuyển sinh theo trình độ</th>
                        <th>Tuyển sinh nữ theo trình độ</th>
                        <th>Tuyển sinh hộ khẩu Hà Nội theo trình độ</th>
                        <th>Tổng tuyển sinh theo trình độ</th>
                        <th>Tuyển sinh nữ theo trình độ</th>
                        <th>Tuyển sinh hộ khẩu Hà Nội theo trình độ</th>

                        <th>Tổng số học viên các đối tượng</th>
                        <th>Tổng số nữ</th>
                        <th>Tổng số hộ khẩu Hà Nội</th>

                        <th>Tổng tốt nghiệp theo trình độ</th>
                        <th>Tốt nghiệp nữ theo trình độ</th>
                        <th>Tốt nghiệp hộ khẩu Hà Nội theo trình độ</th>
                        <th>Tổng tốt nghiệp theo trình độ</th>
                        <th>Tốt nghiệp nữ theo trình độ</th>
                        <th>Tốt nghiệp hộ khẩu Hà Nội theo trình độ</th>
                        <th>Tổng tuyển sinh theo trình độ</th>
                        <th>Tốt nghiệp nữ theo trình độ</th>
                        <th>Tốt nghiệp hộ khẩu Hà Nội theo trình độ</th>

                        <th>Tổng kinh phí</th>
                        <th>Trung ương</th>
                        <th>Thành phố</th>
                        <th>Khác</th>
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
                        <td>{{$item->thoi_gian_dao_tao}}</td>
                        <td>{{$item->tong_tuyen_sinh}}</td>
                        <td>{{$item->nu_tuyen_sinh}}</td>
                        <td>{{$item->ho_khau_HN_tuyen_sinh}}</td>
                        <td>{{$item->tong_tuyen_sinh_bo_doi_xuat_ngu}}</td>
                        <td>{{$item->tuyen_sinh_bo_doi_nu}}</td>
                        <td>{{$item->tuyen_sinh_bo_doi_ho_khau_HN}}</td>
                        <td>{{$item->tong_tuyen_sinh_Ca}}</td>
                        <td>{{$item->tuyen_sinh_ca_nu}}</td>
                        <td>{{$item->tuyen_sinh_ca_ho_khau_HN}}</td>
                        <td>{{$item->tong_tuyen_sinh_thanh_nien}}</td>
                        <td>{{$item->tuyen_sinh_thanh_nien_nu}}</td>
                        <td>{{$item->tuyen_sinh_thanh_nien_ho_khau_HN}}</td>
                        <td>{{$item->tong_tot_nghiep}}</td>
                        <td>{{$item->tong_tot_nghiep_nu}}</td>
                        <td>{{$item->tong_tot_nghiep_ho_khau_HN}}</td>
                        <td>{{$item->tong_tot_nghiep_bo_doi}}</td>
                        <td>{{$item->tong_nghiep_bo_doi_nu}}</td>
                        <td>{{$item->tong_nghiep_bo_doi_ho_khau_HN}}</td>
                        <td>{{$item->tong_tot_nghiep_ca}}</td>
                        <td>{{$item->tot_nghiep_ca_nu}}</td>
                        <td>{{$item->tot_nghiep_ca_ho_khau_HN}}</td>
                        <td>{{$item->tong_tot_nghiep_thanh_nien}}</td>
                        <td>{{$item->tot_nghiep_thanh_nien_nu}}</td>
                        <td>{{$item->tot_nghiep_thanh_nien_ho_khau_HN}}</td>
                        <td>{{number_format($item->tong_kinh_phi)}}</td>
                        <td>{{number_format($item->ngan_sach_TW)}}</td>
                        <td>{{number_format($item->ngan_sach_TP)}}</td>
                        <td>{{number_format($item->ngan_sach_khac)}}</td>
                        @can('cap_nhat_tong_hop_nghe_cho_thanh_nien')
                            <td >
                                @if ($item->trang_thai<3)  <a href="{{route('nhapbc.dao-tao-thanh-nien.edit',[
                                    'id' => $item->id,
                                ])}}">Sửa</a>
                                @endif
                            </td>
                        @endcan
                    </tr> 
                    @endforeach
                   
                </tbody>
            </table>
        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
            {{$data->links()}}
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('#nganh_nghe').select2();
});
</script>
<script src="{!! asset('page_size/page_size.js') !!}"></script>
@endsection