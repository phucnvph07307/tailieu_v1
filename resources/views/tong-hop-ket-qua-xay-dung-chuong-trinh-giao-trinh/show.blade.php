@extends('layouts.admin')
@section('title', "Chi tiết tổng hợp kết quả xây dựng chương trình , giáo trình")
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
                        Chi tiết<small>tổng hợp kết quả xây dựng chương trình , giáo trình</small>
                    </h3>
                </div>
            </div>
        </div>
    <form action="" method="get" class="m-form pt-5">
        <input type="hidden" name="page_size" value="20">
        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                           
                            <label class="col-lg-2 col-form-label">Năm</label>
                            <div class="col-lg-8">
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
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Đợt</label>
                            <div class="col-lg-8">
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
                <div class="row">
                    <div class="col-md-6 pt-3">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Tên nghề</label>
                            <div class="col-lg-8">
                                <select name="nghe_id" id="" class="form-control select2">
                                    <option value="">-----Chọn ngành nghề-----</option>
                                    @forelse ($params['get_nganh_nghe_theo_co_so'] as $item)
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
                </div>
            </div>
        </div>
        <div class="row justify-content-center pb-5">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>

        </div>
    </form>
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
                        <th rowspan="3">Năm</th>
                        <th rowspan="3">Đợt</th>
                       
                        <th rowspan="3">Mã Nghề</th>
                        <th colspan="10">Xây dựng mới</th>
                        <th colspan="10">Chỉnh sửa</th>
                        @can('cap_nhat_tong_hop_xay_dung_chuong_trinh_giao_trinh')
                            <th rowspan="3">Thao tác</th>
                        @endcan
                        
                        
                    </tr>
                    <tr class="text-center">

                        <th rowspan="2">Tên nghề</th>
                        <th colspan="4">Xây dựng mới<br>chương trình</th>
                        <th colspan="4">Xây dựng mới<br>giáo trình</th>
                        <th rowspan="2">Kinh phí thực hiện xây dựng mới <br> (triệu đồng)</th>

                        <th rowspan="2">Tên nghề</th>
                        <th colspan="4">Chỉnh sửa<br>chương trình</th>
                        <th colspan="4">Chỉnh sửa<br>giáo trình</th>
                        <th rowspan="2">Kinh phí thực hiện chỉnh sửa <br> (triệu đồng)</th>
                    </tr>
                    <tr class="text-center">
                        <th rowspan="1">Tổng</th>
                        <th rowspan="1">CĐ</th>
                        <th rowspan="1">TC</th>
                        <th rowspan="1">SC</th>
                        <th rowspan="1">Tổng</th>
                        <th rowspan="1">CĐ</th>
                        <th rowspan="1">TC</th>
                        <th rowspan="1">SC</th>
                        <th rowspan="1">Tổng</th>
                        <th rowspan="1">CĐ</th>
                        <th rowspan="1">TC</th>
                        <th rowspan="1">SC</th>
                        <th rowspan="1">Tổng</th>
                        <th rowspan="1">CĐ</th>
                        <th rowspan="1">TC</th>
                        <th rowspan="1">SC</th>
                    </tr>
                </thead>
               
                <tbody>
                @php
                $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                @endphp
                  @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->nam }}</td>
                        <td>{{ $item->dot }}</td>
                        <td>{{ $item->ma_nghe }}</td>  

                        <td>{{ $item->ten_nghe }}</td>
                        <td>{{ $item->tong_so_XD_chuong_trinh_moi }}</td>
                        <td>{{ $item->XD_chuong_trinh_moi_CD }}</td>
                        <td>{{ $item->XD_chuong_trinh_moi_TC }}</td>
                        <td>{{ $item->XD_chuong_trinh_moi_SC }}</td>
                        
                        <td>{{ $item->tong_so_XD_giao_trinh_moi }}</td>
                        <td>{{ $item->XD_giao_trinh_moi_CD }}</td>
                        <td>{{ $item->XD_giao_trinh_moi_TC }}</td>
                        <td>{{ $item->XD_giao_trinh_moi_SC }}</td>
                        <td>{{ ($item->kinh_phi_thuc_hien_xd_moi/1000000) }}</td>
                        
                        <td>{{ $item->ten_nghe }}</td>
                        <td>{{ $item->tong_so_chuong_trinh_chinh_sua }}</td>
                        <td>{{ $item->sua_chuong_trinh_CD }}</td>
                        <td>{{ $item->sua_chuong_trinh_TC }}</td>
                        <td>{{ $item->sua_chuong_trinh_SC }}</td>
                        
                        <td>{{ $item->tong_so_giao_trinh_chinh_sua }}</td>
                        <td>{{ $item->sua_giao_trinh_CD }}</td>
                        <td>{{ $item->sua_giao_trinh_TC }}</td>
                        <td>{{ $item->sua_giao_trinh_SC }}</td>
                        <td>{{ ($item->kinh_phi_thuc_hien_chinh_sua/1000000) }}</td>
                        @can('cap_nhat_tong_hop_xay_dung_chuong_trinh_giao_trinh')
                        <td>    
                            <a target="_blank"
                            href="{{ route('xuatbc.edit-ds-xd-giao-trinh',['id'=>$item->id]) }}"
                                class="btn btn-info btn-sm">Cập nhật</a>
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
        var currentUrl = `{{route($route_name,['co_so_id'=>$thongtincoso[0]->id])}}`;
        $(document).ready(function () {
            $('#page-size').change(function () {
                var dot = $('[name="dot"]').val();
                var nam = $('[name="nam"]').val();
                var nghe_id = $('[name="nghe_id"]').val();
                var page_size = $(this).val();
                var reloadUrl =
                    `${currentUrl}?dot=${dot}&nam=${nam}&nghe_id=${nghe_id}&page_size=${page_size}`;
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
            title: 'Cập nhật thành công !',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
    @endif
@endsection