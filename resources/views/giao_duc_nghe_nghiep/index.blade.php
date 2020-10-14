@extends('layouts.admin')
@section('title', "Quản lý giáo dục nghề nghiệp")
@section('content')
@section('style')
<link href="{!! asset('tong_hop_nghe_nguoi_khuyet_tat/css/tong_hop_nghe_nguoi_khuyet_tat.css') !!}" rel="stylesheet"
    type="text/css" />
<style>
    .fa-check {
        color: blue
    }

    .table-bordered td {
        border: 1px solid #d5d7db;
    }
</style>
@endsection
<div class="m-content container-fluid">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load" src="{!! asset('images/loading.gif') !!}" alt="">
    </div>
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Thông tin đăng ký giáo dục nghề nghiệp
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Loại hình cơ sở</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="loai_hinh" id="loai_hinh">
                                        <option value="0" selected>Chọn loại hình cơ sở</option>
                                        @foreach($loaiHinh as $item)
                                        <option @if (isset($params['loai_hinh']))
                                            {{(  $params['loai_hinh'] ==  $item->id ) ? 'selected' : ''}} @endif
                                            value="{{ $item->id }}">{{ $item->loai_hinh_co_so }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="co_so_id" id="co_so_id">
                                        <option value="">Chọn cơ sở</option>
                                        @foreach ($coso as $item)
                                        <option @if (isset($params['co_so_id']))
                                            {{( $params['co_so_id'] ==  $item->id ) ? 'selected' : ''}} @endif
                                            value="{{ $item->id }}">{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="nam" id="nam">
                                        <option value="" selected disabled>Chọn</option>

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
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Nghề cấp 2</label>
                                <div class="col-lg-8">
                                    <select class="form-control nganh_nghe" onchange="getNgheTheoCapBac(this)"
                                        name="nghe_cap_2" id="nghe_cap_2">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($nghe_cap_2 as $item)
                                        <option @if (isset($params['nghe_cap_2']))
                                            {{($params['nghe_cap_2']==  $item->id ) ? 'selected' : ''}} @endif
                                            value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="dot" id="dot">
                                        <option value="" selected disabled>Chọn</option>
                                        <option @if (isset($params['dot']))
                                            {{( $params['dot'] ==  1 ) ? 'selected' : ''}} @endif value="1">Đợt 1
                                        </option>
                                        <option @if (isset($params['dot']))
                                            {{( $params['dot'] ==  2 ) ? 'selected' : ''}} @endif value="2">Đợt 2
                                        </option>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Nghề cấp 3</label>
                                <div class="col-lg-8">
                                    <select class="form-control nganh_nghe" onchange="getNgheTheoCapBac(this)"
                                        name="nghe_cap_3" id="nghe_cap_3">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($nghe_cap_3 as $item)
                                        <option @if (isset($params['nghe_cap_3']))
                                            {{($params['nghe_cap_3'] ==  $item->id ) ? 'selected' : ''}} @endif
                                            value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Quận\Huyện</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="devvn_quanhuyen" id="devvn_quanhuyen">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($quanhuyen as $item)
                                        <option @if (isset($params['devvn_quanhuyen']))
                                            {{( $params['devvn_quanhuyen'] ==  $item->maqh ) ? 'selected' : ''}} @endif
                                            value="{{$item->maqh}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Nghề cấp 4</label>
                                <div class="col-lg-8">
                                    <select class="form-control nganh_nghe" onchange="setNameNganhNgheSearch(this)"
                                        multiple="multiple" name="nghe_cap_4[]" id="nghe_cap_4">
                                        @foreach ($nghe_cap_4 as $item)
                                        <option @if (isset($params['nghe_cap_4'])) @foreach ($params['nghe_cap_4'] as
                                            $params4) {{($params4 ==  $item->id ) ? 'selected' : ''}} @endforeach @endif
                                            value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Xã\Phường</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="devvn_xaphuongthitran"
                                        id="devvn_xaphuongthitran">
                                        <option value="">Chọn xã phường</option>
                                        @foreach ($xaphuongtheoquanhuyen as $item)
                                        <option @if (isset($params['devvn_xaphuongthitran']))
                                            {{( $params['devvn_xaphuongthitran'] ==  $item->xaid ) ? 'selected' : ''}}
                                            @endif value="{{$item->xaid}}">{{$item->name}}</option>
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
    <div class="row mb-5 bieumau">
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#exportBieuMauModal">
                <i class="fa fa-download" aria-hidden="true"></i>
                Tải xuống biểu mẫu
            </a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" id="upImport-file" data-target="#moDalImport"><i
                    class="fa fa-upload" aria-hidden="true"></i>
                Tải lên file Excel</a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#moDalExportData"><i class="fa fa-file-excel"
                    aria-hidden="true"></i>
                Xuất dữ liệu ra Excel</a>
        </div>
        @can('them_moi_tong_hop_giao_duc_nghe_nghiep')
        <div class="col-lg-6 " style="text-align: right">
            <a href="{{route('xuatbc.quan-ly-giao-duc-nghe-nghiep.create')}}"><button type="button" class="btn btn-info .bg-info">Thêm
                    mới</button></a>
        </div>
        @endcan
    </div>
    <div class="m-portlet">
        @if (session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
        @endif
        <div class="m-portlet__body">
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
            <table class="table table-bordered m-table table-boder-white m-table--head-bg-primary table-responsive">
                <thead>
                    <tr>
                        <th scope="col 1" rowspan="2">STT</th>
                        <th scope="col 1" rowspan="2">Loại hình cơ sở</th>
                        <th scope="col 1" rowspan="2">Cơ sở đào tạo</th>
                        <th scope="col 1" rowspan="2">Cơ quan chủ quản</th>
                        <th scope="col 1" rowspan="2">Quận Huyện</th>
                        <th scope="col 1" rowspan="2">Xã Phường <br> Thị Trấn</th>
                        <th scope="col 1" rowspan="2" class="text-center">Quyết đinh thành lập/ <br>đổi tên/sáp
                            nhập/giải thể</th>
                        <th scope="col 1" colspan="4" class="text-center">Giấy chứng nhận đăng ký hoạt động GDNN</th>
                        <th scope="col 1" colspan="8" class="text-center">Tên ngành, nghề/ quy mô được cấp trong GCN
                        </th>
                        @can('cap_nhat_tong_hop_giao_duc_nghe_nghiep')
                            <th scope="col 1" rowspan="2">Thao tác</th>
                        @endcan
                    </tr>



                    <tr class="pt-3 row2">
                        <th>Số ngày tháng năm cấp/ <br>địa điểm dào tạo</th>
                        <th>Chưa được cấp</th>
                        <th>Năm cấp ban đầu</th>
                        <th>Năm cấp bổ sung</th>

                        <th>STT</th>
                        <th>Mã Nghề</th>
                        <th>Tên ngành nghề</th>
                        <th>Năm</th>
                        <th>Đợt</th>
                        <th>Mã cấp II</th>
                        <th>Quy mô tuyển sinh TC</th>
                        <th>Quy mô tuyển sinh SC</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    $check ='fa fa-check';
                    @endphp

                    @foreach ($data as $item)
                    @foreach ($item->detail as $key => $value)

                    <tr>
                        @if ($key==0)
                            <td rowspan="{{count($item->detail)}}">{{ $i++ }}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->loai_hinh_co_so}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->ten}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->co_quan_chu_quan}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->quan_huyen}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->xa_phuong}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->quyet_dinh}}</td>
                            <td rowspan="{{count($item->detail)}}">{{$item->so_ngay_thang_nam_cap_dia_diem_dao_tao}}</td>
                            <td class="text-center " rowspan="{{count($item->detail)}}">
                                <i class="{{$item->giay_chung_nhan==1 ? $check :''}}"></i>

                            </td>
                            <td class="text-center " rowspan="{{count($item->detail)}}">
                                <i class="{{$item->giay_chung_nhan==2 ? $check :''}}"></i>
                            </td>
                            <td class="text-center " rowspan="{{count($item->detail)}}">
                                <i class="{{$item->giay_chung_nhan==3 ? $check :''}}"></i>
                            </td>
                        @endif
                            <td>{{$key=$key+1}}</td>
                            <td>{{$value->nghe_id}}</td>
                            <td>{{$value->ten_nganh_nghe}}</td>
                            <td>{{$value->nam}}</td>
                            <td>{{$value->dot}}</td>
                            <td>{{$value->ma_cap_2}}</td>
                            <td>{{$value->quy_mo_tuyen_sinh_TC}}</td>
                            <td>{{$value->quy_mo_tuyen_sinh_SC}}</td>
                            @can('cap_nhat_tong_hop_giao_duc_nghe_nghiep')
                            <td>
                                @if ($value->trang_thai<3) <a href="{{route('xuatbc.quan-ly-giao-duc-nghe-nghiep.edit',[
                                        'id' => $value->id,
                                    ])}}">Sửa</a>
                                    @endif
                            </td>
                            @endcan
                    </tr>
                    @endforeach
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>
    <div class="m-portlet__foot d-flex justify-content-end">

    </div>
    
    {{-- thanhnv form nv form import export --}}
    @include('layouts.formExcel.from', [
        'routeLayFormBieuMau' => 'layformbieumau.quan-ly-giao-duc-nghe-nghiep',
        'routeImportError' => 'import.error.quan-ly-giao-duc-nghe-nghiep',
        'routeExportData' => 'exportdata.quan-ly-giao-duc-nghe-nghiep',
    ])

</div>
@endsection
@section('script')

{{-- thanhnv update change to service 6/25/2020 --}}
<script>
    var routeImport = "{{route('import.quan-ly-giao-duc-nghe-nghiep')}}";
</script>
<script src="{!! asset('excel-js/js-xuat-time.js') !!}"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
{{-- end --}}
<script>
    $(document).ready(function() {
        $('#co_so_id').select2();
    });
</script>
<script src="{{ asset('js/so_lieu_tuyen_sinh/tong_hop_so_lieu.js') }}"></script>
<script type="text/javascript">
    var url_tuyen_sinh_theo_loai_hinh = "{{route('csTuyenSinhTheoLoaiHinh')}}"
    var url_xa_phuong_theo_quan_huyen = "{{route('getXaPhuongTheoQuanHuyen')}}"
    var url_nghe_theo_nghe_cap_bac= "{{route('getNgheTheoCapBac')}}"
        $(document).ready(function(){
        $('#co_so_id').select2();
        $('#devvn_quanhuyen').select2();
        $('#devvn_xaphuongthitran').select2();
        $('#nghe_cap_2').select2();
        $('#nghe_cap_3').select2();
        $('#nghe_cap_4').select2();
    });
    $("#loai_hinh" ).change(function() {
        $('#preload').css('display','block')
        axios.post(url_tuyen_sinh_theo_loai_hinh, {
            id:  $("#loai_hinh").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="">Chọn cơ sở</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.id}" >${element.ten}</option>`   
            });
            $('#co_so_id').html(htmldata);
            $('#preload').css('display','none')
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    
    $("#devvn_quanhuyen" ).change(function() {
        $('#preload').css('display','block')
        axios.post(url_xa_phuong_theo_quan_huyen, {
                    id:  $("#devvn_quanhuyen").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="" selected  >Chọn</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.xaid}" >${element.name}</option>`   
            });
            $('#devvn_xaphuongthitran').html(htmldata);
            $('#preload').css('display','none')
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    
    function getNgheTheoCapBac(id){
        $('#preload').css('display','block')
        var cap_nghe = $(id).val().length==3 ? 3: 4
        axios.post(url_nghe_theo_nghe_cap_bac, {
            id:  $(id).val(),
            cap: cap_nghe
        })
        .then(function (response) {        
            if ($(id).val().length==3 || $(id).val().length==0) {
                var htmldata = '<option value="" selected  >Chọn Nghề</option>'
                    response.data.forEach(element => {
                        htmldata+=`<option value="${element.id}">${element.id}-${element.ten_nganh_nghe}</option>`   
                    });
                $('#nghe_cap_3').html(htmldata);
            }else{
                var htmldata = ''
                    response.data.forEach(element => {
                        htmldata+=`<option value="${element.id}">${element.id}-${element.ten_nganh_nghe}</option>`  
                    });
                $('#nghe_cap_4').html(htmldata);
            }
            $('#preload').css('display','none')
            
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    
      $("#page-size").change(function(){  
        $("#page_size_hide").val($('#page-size').val())
        var url = new URL(window.location.href);
        var search_params = url.searchParams;
        search_params.set('page_size', $("#page_size_hide").val());
        search_params.set('page',1);
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.href = new_url
      });
    
    
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
@endsection