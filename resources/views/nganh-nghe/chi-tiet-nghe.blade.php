
@extends('layouts.admin')
@section('title', 'Chi tiết ngành nghề')
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
                        Ngành nghề <small>Chi tiết nghề</small>
                    </h3>
                </div>
            </div>
        </div>

        <form action="" method="get" class="m-form">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở:</label>
                                <div class="col-lg-8">
                                    <input type="text" value="" name="ten_co_so"
                                        class="form-control m-input" placeholder="từ khóa tên cơ sở">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select class="form-control" id="page-size">
                                       <option value="">2019</option>
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
        <div class="m-portlet__body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="m-portlet__head-caption col-lg-6">
                    <div class="m-portlet__head-title">
                        <h5 class="m-portlet__head-text">
                            Tên nghề: 
                        </h5>
                    </div>
                </div>

                <div class="col-5 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-4 col-form-label">Kích thước:</label>
                    <div class="col-lg-7">
                        <select class="form-control" id="page-size">
                            @foreach(config('common.paginate_size.list') as $size)
                                <option
                                        @if($params['page_size'] == $size)
                                            selected
                                        @endif
                                        value="{{$size}}">{{$size}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <th>Tên cơ sở đào tạo</th>
                    <th>Loại hình cơ sở</th>
                    <th>Quy mô tuyển sinh</th>
                    <th>Tổng số sinh viên đã tuyển</th>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->ten }}</td>
                        <td></td>
                        <td></td>
                        <td>@if($item->tong_so_tuyen_sinh != null)
                            <b>{{ $item->tong_so_tuyen_sinh }}</b>
                            @else
                            <span class="text-danger">Không tìm thấy số liệu</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-danger">Không tìm thấy dữ liệu cho nghề này !</td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
    var currentUrl = '{{route($route_name, ['ma_nghe' => $params['ma_nghe']])}}';
    $(document).ready(function(){
        $('#page-size').change(function(){
            var loai_hinh_co_so = $('[name="loai_hinh_co_so"]').val();
            var quan_huyen = $('[name="ma_quan_huyen"]').val();
            var keyword = $('[name="keyword"]').val();
            var page_size = $(this).val();
            var reloadUrl = `${currentUrl}?loai_hinh_co_so=${loai_hinh_co_so}&quan_huyen=${quan_huyen}&keyword=${keyword}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });

    });
    </script>
@endsection