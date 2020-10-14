@extends('layouts.admin')
@section('title', "Tổng hợp kết quả xây dựng chương trình , giáo trình")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
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
                        Tổng hợp<small>kết quả xây dựng chương trình , giáo trình</small>
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
                                <label class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-10">
                                    <select name="co_so_id" class="form-control select2">
                                        <option value="">-----Chọn cơ sở-----</option>
                                        @foreach ($params['get_co_so'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['co_so_id']) &&
                                            $params['co_so_id']==$item->id)
                                            selected
                                            @endif>
                                            {{ $item->ten }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-10">
                                    <select name="nam" class="form-control select2">
                                        <option value="">-----Chọn năm-----</option>

                                        @foreach(config('common.nam.list') as $nam)
                                        <option @if(isset($params['nam']) && $params['nam']==$nam) selected @endif
                                            value="{{$nam}}">{{$nam}}</option>
                                        @endforeach

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
                                    <select name="nghe_id" id="" class="form-control select2">
                                        <option value="">-----Chọn ngành nghề-----</option>
                                        @forelse ($params['get_nganh_nghe'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['nghe_id']) &&
                                            $params['nghe_id']==$item->id)
                                            selected
                                            @endif>

                                            {{ $item->id }} --- {{ $item->ten_nganh_nghe }}
                                        </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-10">
                                    <select name="dot" class="form-control select2">
                                        <option value="">-----Chọn đợt-----</option>
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
      
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="row mb-4 bieumau">
        <div class="col-lg-2">
            <a href=""><i class="la la-download">Tải xuống biểu mẫu</i></a>
        </div>
        <div class="col-lg-8">
            <a href=""><i class="la la-upload">Tải lên file excel</i></a>
        </div>
        @can('them_moi_tong_hop_xay_dung_chuong_trinh_giao_trinh')
        <div class="col-lg-2 text-center">
            <a target="_blank" href="{{ route('xuatbc.create-ds-xd-giao-trinh') }}" class="btn btn-success btn-sm">Thêm mới</a>                      
        </div>
        @endcan
    </div>
    <div class="m-portlet">
        <div class="table-responsive pt-5">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <div class="m-portlet__body table-responsive">
           
            <table class="table table-bordered m-table m-table- m-table--head-bg-primary table-boder-white">
                
                <thead>
                    <tr class="text-center">
                        <th rowspan="3">STT</th>
                        <th rowspan="3">Tên cơ sở</th>
                        
                        <th rowspan="3">Năm</th>
                        <th rowspan="3">Đợt</th>
                        <th colspan="9">Xây dựng mới</th>
                        <th colspan="9">Chỉnh sửa</th>
                        @can('chi_tiet_tong_hop_xay_dung_chuong_trinh_giao_trinh')
                        <th rowspan="3">Thao tác</th>
                        @endcan
                    </tr>
                    <tr class="text-center">
                        
                        <th colspan="4">Chương trình </th>
                        <th colspan="4">Giáo trình</th>
                        <th rowspan="2">Kinh phí <br> ( triệu đồng)</th>
                       
                        <th colspan="4">Chương trình </th>
                        <th colspan="4">Giáo trình</th>
                        <th rowspan="2">Kinh phí <br> ( triệu đồng)</th>

                    </tr>
                    <tr>
                        <th>Tổng số</th>
                        <th>Cao đẳng</th>
                        <th>Trung cấp</th>
                        <th>Sơ cấp</th>

                        <th>Tổng số</th>
                        <th>Cao đẳng</th>
                        <th>Trung cấp</th>
                        <th>Sơ cấp</th>

                        <th>Tổng số</th>
                        <th>Cao đẳng</th>
                        <th>Trung cấp</th>
                        <th>Sơ cấp</th>

                        <th>Tổng số</th>
                        <th>Cao đẳng</th>
                        <th>Trung cấp</th>
                        <th>Sơ cấp</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                    @endphp
                   @foreach ($data as $item)
                   <tr>
                       <td>{{ $i++ }}</td>
                       <td>{{ $item->ten }}</td>
                     
                       <td>{{ $item->nam }}</td>
                       <td>{{ $item->dot }}</td>
                       
                       {{-- Xây dựng --}}
                       <td>{{ $item->total_tong_so_XD_chuong_trinh_moi }}</td>
                       <td>{{ $item->total_XD_chuong_trinh_moi_CD }}</td>
                       <td>{{ $item->total_XD_chuong_trinh_moi_TC }}</td>
                       <td>{{ $item->total_XD_chuong_trinh_moi_SC }}</td>

                       <td>{{ $item->total_tong_so_XD_giao_trinh_moi }}</td>
                       <td>{{ $item->total_XD_giao_trinh_moi_CD }}</td>
                       <td>{{ $item->total_XD_giao_trinh_moi_TC }}</td>
                       <td>{{ $item->total_XD_giao_trinh_moi_SC }}</td>

                       <td>{{ ($item->total_kinh_phi_thuc_hien_xd_moi / 1000000) }}</td>


                       {{-- Chỉnh sửa --}}
                       <td>{{ $item->total_tong_so_chuong_trinh_chinh_sua }}</td>
                       <td>{{ $item->total_sua_chuong_trinh_CD }}</td>
                       <td>{{ $item->total_sua_chuong_trinh_TC }}</td>
                       <td>{{ $item->total_sua_chuong_trinh_SC }}</td>

                       <td>{{ $item->total_tong_so_giao_trinh_chinh_sua }}</td>
                       <td>{{ $item->total_sua_giao_trinh_CD }}</td>
                       <td>{{ $item->total_sua_giao_trinh_TC }}</td>
                       <td>{{ $item->total_sua_giao_trinh_SC }}</td>

                       <td>{{ ($item->total_kinh_phi_thuc_hien_chinh_sua / 1000000) }}</td>
                        @can('chi_tiet_tong_hop_xay_dung_chuong_trinh_giao_trinh')
                            <td>
                                <a class="btn btn-info" href="{{ route('xuatbc.show-ds-xd-giao-trinh',['co_so_id' => $item->co_so_id]) }}" target="_blank">Chi tiết</a>
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
</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function () {
        $('#page-size').change(function () {
            var co_so_id = $('[name="co_so_id"]').val();
            var dot = $('[name="dot"]').val();
            var nam = $('[name="nam"]').val();
            var nghe_id = $('[name="nghe_id"]').val();
            var page_size = $(this).val();
            var reloadUrl =
                `${currentUrl}?dot=${dot}&nam=${nam}&co_so_id=${co_so_id}&nghe_id=${nghe_id}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });

        $('.select2').select2();

    });
</script>
@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Thêm thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@endsection