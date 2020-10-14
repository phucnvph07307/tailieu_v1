@extends('layouts.admin')
@section('title', "Chi tiết đào tạo nghề cho người khuyết tật")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .m-table.m-table--border-danger,
    .m-table.m-table--border-danger th,
    .m-table.m-table--border-danger td {
        border-color: #bcb1b1;
    }

    table thead th[colspan="4"] {
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
        <div class="m-portlet__body table-responsive">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chi tiết <small>Thông tin đào tạo nghề cho người khuyết tật</small>
                        </h3>
                    </div>
                </div>
            </div>
            <table
                class="table table-bordered m-table m-table--border-danger m-table--head-bg-primary table-boder-white">
                <div class="col-12 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-2">
                        <select class="form-control" id="page-size">
                            @foreach(config('common.paginate_size.list') as $size)
                            <option @if (isset($params['page_size']))
                                {{( $params['page_size'] ==  $size ) ? 'selected' : ''}} @endif value="{{$size}}">
                                {{$size}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Mã Nghề</th>
                        <th rowspan="2">Tên Nghề</th>
                        <th colspan="3">Tuyển sinh</th>
                        <th colspan="3">Tốt nghiệp</th>
                        <th colspan="4">Kinh phí thực hiện</th>
                        <th rowspan="2">Thao tác</th>
                    </tr>
                    <tr class="text-center">
                        <th rowspan="2">Tổng tuyển sinh</th>
                        <th rowspan="2">Nữ</th>
                        <th rowspan="2">Hộ khẩu Hà Nội</th>
                        <th rowspan="2">Tổng tốt nghiệp</th>
                        <th rowspan="2">Nữ</th>
                        <th rowspan="2">Hộ khẩu Hà Nội</th>
                        <th rowspan="2">Tổng kinh phí</th>
                        <th rowspan="2">Ngân sách TW</th>
                        <th rowspan="2">Ngân sách TP</th>
                        <th rowspan="2">Ngân sách Khác</th>
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
                        <td>{{$item->tong_tuyen_sinh}}</td>
                        <td>{{$item->tuyen_sinh_nu}}</td>
                        <td>{{$item->tuyen_sinh_ho_khau_HN}}</td>
                        <td>{{$item->tong_tot_nghiep}}</td>
                        <td>{{$item->tot_nghiep_nu}}</td>
                        <td>{{$item->tot_nghiep_ho_khau_HN}}</td>
                        <td>{{$item->tong_ngan_sach}}</td>
                        <td>{{$item->ngan_sach_TW}}</td>
                        <td>{{$item->ngan_sach_TP}}</td>
                        <td>{{$item->ngan_sach_khac}}</td>
                        @can('cap_nhat_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat')
                        <td>
                            @if ($item->trang_thai<3) <a href="{{route('nhapbc.dao-tao-khuyet-tat.edit',[
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
    $('#ten_co_so').select2();
});
    </script>
    <script src="{!! asset('page_size/page_size.js') !!}"></script>
    @endsection