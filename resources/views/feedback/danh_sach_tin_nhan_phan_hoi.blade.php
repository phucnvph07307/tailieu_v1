@extends('layouts.admin')
@section('title', "Danh sách tin nhắn phản hồi hệ thống")
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

    .fa-eye {
        cursor: pointer;
        color: blue;
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
                        Danh sách<small>Tin nhắn phản hồi hệ thống</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" id="page_size_hide" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Trạng thái</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="trang_thai">
                                        <option value="">Chọn</option>
                                        @foreach(config('common.trang_thai_ho_tro') as $key => $item)

                                        <option @if (isset($params['trang_thai']))
                                            {{( $params['trang_thai'] ==  $item ) ? 'selected' : ''}} @endif
                                            value="{{$item}}">
                                            {{( $item ==  1 ) ? 'Chưa phản hồi' : 'Đã phản hồi'}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Từ khóa</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input"
                                        value="{{isset($params['key_words'])? $params['key_words'] :''}}"
                                        name="key_words" placeholder="Nhập từ khóa">
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
                        <th rowspan="2">Tên</th>
                        <th rowspan="2">Email</th>
                        <th rowspan="2">Số điện thoại</th>
                        <th rowspan="2">Chi tiết</th>
                        <th rowspan="2">Trạng thái</th>
                        <th rowspan="2">Phản hồi</th>
                    </tr>

                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->ten_nguoi_gui}}</td>
                        <td>{{$item->email_nguoi_gui}}</td>
                        <td>{{$item->so_dien_thoai_nguoi_gui}}</td>
                        <td class="text-center"><i class="fas fa-eye" data-toggle="modal"
                                data-target="#myModal{{$item->id}}"></i></td>
                        <td class="text-center">
                            @if ($item->trang_thai ==  2 )
                            <div class="btn btn-success" role="alert">
                               Đã phản hồi
                              </div>
                            @else
                            <div class="btn btn-danger" role="alert">
                               Chưa phản hồi
                            </div>
                            @endif
                        </td>
                        <td>
                            <a
                                href="{{route('tu_van_ho_tro.chi-tiet',['id'=>$item->id])}}">{{( $item->trang_thai ==  1 ) ? 'Phản hồi' : ''}}</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="myModal{{$item->id}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Chi tiết tin nhắn phản hỏi hệ thống</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <h3>Tiêu đề: {{$item->tieu_de}}</h3>
                                            <p>Họ và tên: {{$item->ten_nguoi_gui}}</p>
                                            <p>Email: {{$item->email_nguoi_gui}} &nbsp;&nbsp;&nbsp; Số điện thoại:
                                                {{$item->so_dien_thoai_nguoi_gui}}</p>
                                            <p>Ngày gửi yêu cầu: {{\Carbon\Carbon::parse($item->created_at)->format("d-m-Y h:i:s")}}</p>
                                            <p>Trạng thái:         
                                                <button type="button" class="btn btn-success">   {{( $item->trang_thai ==  1 ) ? 'Chưa phản hồi' : 'Đã phản hồi'}}</button>
                                            </p>
                                            <div class="form-group m-form__group">
                                                <label for="">Nội dung:</label>
                                                <textarea class="form-control m-input m-input--solid"
                                                    disabled="disabled" rows="5">{{$item->noi_dung}}</textarea>
                                            </div>
                                            <div class="m-separator m-separator--space m-separator--dashed"></div>
                                            @if ($item->trang_thai ==  2 )
                                                <h3>Nội dung phản hồi</h3>
                                                <p>Người phản hồi: {{$item->listnguoiPhanHoi->name}}</p>
                                                <p>Ngày thực hiện phản hồi: {{\Carbon\Carbon::parse($item->listnguoiPhanHoi->updated_at)->format("d-m-Y h:i:s")}}
                                                <div class="form-group m-form__group">
                                                    <label for="">Nội dung phản hồi:</label>
                                                    <textarea class="form-control m-input m-input--solid"
                                                        disabled="disabled" rows="5">{{$item->noi_dung_phan_hoi}}</textarea>
                                                </div>
                                            @endif
                    
                                           
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                </div>

                            </div>
                        </div>
                    </div>
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
        $("#page-size").change(function(){  
            var url = new URL(window.location.href);
            var search_params = url.searchParams;
            search_params.set('page_size', $('#page-size').val());
            search_params.set('page',1);
            url.search = search_params.toString();
            var new_url = url.toString();
            window.location.href = new_url
          });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/vi.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    @endsection