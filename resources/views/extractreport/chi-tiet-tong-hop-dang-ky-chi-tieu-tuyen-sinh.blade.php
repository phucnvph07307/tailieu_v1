@extends('layouts.admin')
@section('title', "Chi tiết tổng hợp số lượng đăng ký chỉ tiêu tuyển sinh")
@section('style')
{{-- <link href="{!! asset('tuyensinh/css/chitiettuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
    .m-table.m-table--border-danger,
    .m-table.m-table--border-danger th,
    .m-table.m-table--border-danger td {
        border-color: #BCB1B1;
    }

    table thead th[colspan="4"] {
        border-bottom-width: 1px;
        border-bottom: 1px solid #BCB1B1 !important;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết <small>Thông tin cơ sở</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <h3>Cơ sở đào tạo: {{$thongtincoso[0]->ten}}</h3>
            <p>Loại hình cơ sở: {{$thongtincoso[0]->loai_hinh_co_so}}</p>
            <p>Địa chỉ: {{$thongtincoso[0]->dia_chi}}</p>
            <p>Phường/Xã: {{$thongtincoso[0]->tenxaphuong}}</p>
            <p>Quận/Huyện: {{$thongtincoso[0]->tenquanhuyen}}</p>



        </div>
    </div>
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết<small>số lượng đăng ký chỉ tiêu tuyển sinh</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form pt-5">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-10">
                                    <select name="nam" class="form-control select2">
                                        <option value="">Chọn </option>

                                        @foreach(config('common.nam.list') as $nam)
                                        <option @if(isset($params['nam']) && $params['nam']==$nam) selected @endif
                                            value="{{$nam}}">{{$nam}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-10">
                                    <select name="dot" class="form-control select2">
                                        <option value="">Chọn</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.1'))
                                            selected @endif value="{{config('common.dot.1')}}">
                                            {{config('common.dot.1')}}</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.2'))
                                            selected @endif value="{{config('common.dot.2')}}">
                                            {{config('common.dot.2')}}</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên ngành nghề</label>
                                <div class="col-lg-10">
                                    <select name="nghe_id[]" id="nghe_id" class="form-control select2"
                                        multiple="multiple">
                                        @forelse ($params['get_nganh_nghe_theo_co_so'] as $item)
                                        <option @if (isset($params['nghe_id'])) @foreach ($params['nghe_id'] as
                                            $params4) {{($params4 ==  $item->id ) ? 'selected' : ''}} @endforeach @endif
                                            value="{{ $item->id }}">

                                            {{ $item->id }} - {{ $item->ten_nganh_nghe }}
                                        </option>
                                        @empty
                                        @endforelse
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
        <div class="m-portlet__body table-responsive">
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
                        <th rowspan="2">Mã ngành nghề</th>
                        <th rowspan="2">Tên ngành nghề</th>

                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th colspan="3">Đăng ký chỉ tiêu tuyển sinh</th>
                        <th rowspan="2">
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Cao đẳng</th>
                        <th rowspan="2">Trung cấp</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->ma_nghe }}</td>
                        <td>{{ $item->ten_nghe }}</td>


                        <td>{{ $item->nam }}</td>
                        <td>{{ $item->dot }}</td>

                        <td>{{ $item->tong }}</td>
                        <td>{{ $item->so_dang_ki_CD }}</td>
                        <td>{{ $item->so_dang_ki_TC }}</td>
                        @can('cap_nhat_tong_hop_dang_ky_chi_tieu_tuyen_sinh')
                        <td>
                            <a target="_blank"
                                href="{{ route('xuatbc.sua-dang-ky-chi-tieu-tuyen-sinh',['id'=>$item->id]) }}"
                                class="btn btn-info btn-sm">Sửa</a>
                        </td>
                        @endcan
                    </tr>


                    @endforeach
                </tbody>
            </table>
            <div>
                @if ($thongbao)
                <div class="thongbao border" style="color: red; text-align: center;">
                    <h4 class="m-portlet__head-text ">
                        {{$thongbao}}
                    </h4>
                </div>
                @endif
            </div>
        </div>

        <div class="m-portlet__foot d-flex justify-content-end">
            {!! $data->links() !!}
        </div>
    </div>
    @endsection
    @section('script')
    <script src="{!! asset('page_size/page_size.js') !!}"></script>
    <script>
        $(document).ready(function () {
        $('.select2').select2();
    });
    </script>
    @if (session('success'))
    <script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Cập nhật thành công !',
        showConfirmButton: false,
        timer: 3500
    })
    </script>
    @endif
    @endsection