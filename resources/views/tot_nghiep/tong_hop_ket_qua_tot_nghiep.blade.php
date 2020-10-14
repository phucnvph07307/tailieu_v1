@extends('layouts.admin')
@section('title', "Tổng hợp kết quả tốt nghiệp")
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
                        Tốt nghiệp <small>Danh sách</small>
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
                                        @if(isset($params['nganh_nghe']))
                                        name="{{strlen($params['nganh_nghe'])==3?'nganh_nghe':''}}" @endif
                                        id="nghe_cap_2">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($nghe_cap_2 as $item)
                                        <option @if (isset($params['nganh_nghe']))
                                            {{( substr($params['nganh_nghe'],0,3) ==  $item->id ) ? 'selected' : ''}}
                                            @endif value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}
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
                                        @if(isset($params['nganh_nghe']))
                                        name="{{strlen($params['nganh_nghe'])==5?'nganh_nghe':''}}" @endif
                                        id="nghe_cap_3">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($nghe_cap_3 as $item)
                                        <option @if (isset($params['nganh_nghe']))
                                            {{( substr($params['nganh_nghe'],0,5) ==  $item->id ) ? 'selected' : ''}}
                                            @endif value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}
                                        </option>
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
                                        @if(isset($params['nganh_nghe']))
                                        name="{{strlen($params['nganh_nghe'])==7?'nganh_nghe':''}}" @endif
                                        id="nghe_cap_4">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($nghe_cap_4 as $item)
                                        <option @if (isset($params['nganh_nghe']))
                                            {{( substr($params['nganh_nghe'],0,7) ==  $item->id ) ? 'selected' : ''}}
                                            @endif value="{{$item->id}}">{{$item->id}}-{{$item->ten_nganh_nghe}}
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
    <section class="action-nav d-flex align-items-center justify-content-between mt-4 mb-4">
    
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
            <div class="col-lg-8">
                <a href="javascript:" data-toggle="modal" data-target="#moDalExportData"><i class="fa fa-file-excel"
                        aria-hidden="true"></i>
                    Xuất dữ liệu ra Excel</a>
            </div>
  
    </section>
    <div class="m-portlet">
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
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <th scope="col">STT</th>
                    <th scope="col">Tên cơ sở đào tạo</th>
                    <th scope="col">Loại hình cơ sở</th>
                    <th scope="col">Quận Huyện</th>
                    <th scope="col">Xã Phường Thị Trấn</th>
                    <th scope="col">Tổng số sinh viên tốt nghiệp</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Chức năng</th>
                    @can('them_moi_tong_hop_ket_qua_tot_nghiep')
                    <th>
                        <a href="{{ route('xuatbc.them-tong-hop') }}" class="btn btn-success btn-sm">Thêm mới</a>
                    </th>
                    @endcan
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$item->ten}}</td>
                        <td>{{$item->loai_hinh_co_so}}</td>
                        <td>{{$item->quan_huyen}}</td>
                        <td>{{$item->xa_phuong}}</td>
                        <td>{{$item->tong_so_nguoi_tn}}</td>
                        <td>{{$item->trang_thai}}</td>
                        @can('xem_chi_tiet_tong_hop_ket_qua_tot_nghiep')
                        <td>
                            <a href="{{route('xuatbc.chi-tiet-tong-hop',[
                            'id' => $item->id,
                        ])}}">Chi tiết</a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="m-portlet__foot d-flex justify-content-end">
        {{$data->links()}}
    </div>
</div>


{{-- thanhnv --}}
@php
$routeLayFormBieuMau = 'layformbieumautotnghiep';
$routeImportError = 'import.error.ket-qua-tot-nghiep';
$routeExportData = 'exportdatatotnghiep';
@endphp

@include('layouts.formExcel.from', [
    'routeLayFormBieuMau' => $routeLayFormBieuMau,
    'routeImportError' => $routeImportError,
    'routeExportData' => $routeExportData
])



@endsection
@section('script')
{{-- thanhnv update change to service 6/25/2020 --}}
<script>
    var routeImport = "{{route('import.ket-qua-tot-nghiep')}}";
</script>
<script src="{!! asset('excel-js/js-xuat-time.js') !!}"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
{{-- end --}}
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
        axios.post(url_tuyen_sinh_theo_loai_hinh, {
            id:  $("#loai_hinh").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="">Chọn cơ sở</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.id}" >${element.ten}</option>`   
            });
            $('#co_so_id').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    
    $("#devvn_quanhuyen" ).change(function() {
        axios.post(url_xa_phuong_theo_quan_huyen, {
                    id:  $("#devvn_quanhuyen").val(),
        })
        .then(function (response) {
            var htmldata = '<option value="" selected  >Chọn</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.xaid}" >${element.name}</option>`   
            });
            $('#devvn_xaphuongthitran').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    
    function getNgheTheoCapBac(id){
        setNameNganhNgheSearch(id)
        var cap_nghe = $(id).val().length==3 ? 3: 4
        axios.post(url_nghe_theo_nghe_cap_bac, {
            id:  $(id).val(),
            cap: cap_nghe
        })
        .then(function (response) {
            var htmldata = '<option value="" selected  >Chọn nghề</option>'
                response.data.forEach(element => {
                    htmldata+=`<option value="${element.id}">${element.id}-${element.ten_nganh_nghe}</option>`  
            });
            if ($(id).val().length==3 || $(id).val().length==0) {
                $('#nghe_cap_3').html(htmldata);
            }else{
                $('#nghe_cap_4').html(htmldata);
            }
            
        })
        .catch(function (error) {
            console.log(error);
        });
    }
    function setNameNganhNgheSearch(id) {
        var nganh_nghe = $('.nganh_nghe')
        for (let index = 0; index < nganh_nghe.length; index++) {
            $(nganh_nghe[index]).attr('name','')       
        }
        $(id).attr('name','nganh_nghe')
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