@extends('layouts.admin')
@section('title', 'Kết quả tốt nghiệp đào tạo nghề gắn với doanh nghiệp')
@section('style')
<link href="{!! asset('tong_hop_nghe_nguoi_khuyet_tat/css/tong_hop_nghe_nguoi_khuyet_tat.css') !!}" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')

<div class="m-content container-fluid">
    <div class="m-portlet">
        <div id="preload" class="preload-container text-center" style="display: none">
            <img id="gif-load" src="{!! asset('images/loading.gif') !!}" alt="">
        </div>
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Kết quả học sinh, sinh viên tốt nghiệp đào tạo nghề gắn với doanh nghiệp
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
                                        <option value="" selected>Chọn</option>
                                        @foreach ($loai_hinh as $item)
                                        <option @if (isset($params['loai_hinh']))
                                            {{( $params['loai_hinh'] ==  $item->id ) ? 'selected' : ''}} @endif
                                            value="{{$item->id}}">{{$item->loai_hinh_co_so}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" name="co_so_id" id="co_so_id">
                                        <option value="">Chọn</option>

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
                                    <select class="form-control select2" name="nam" id="nam">
                                        <option value="">Chọn</option>
                                        @foreach (config('common.nam.list') as $item)
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
                                    <select class="form-control nganh_nghe select2" onchange="getNgheTheoCapBac(this)"
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
                                    <select class="form-control select2" name="dot" id="dot">
                                        <option value="">Chọn</option>
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
                                    <select class="form-control nganh_nghe select2" onchange="getNgheTheoCapBac(this)"
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
                                    <select class="form-control select2" name="devvn_quanhuyen" id="devvn_quanhuyen">
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
                                    <select class="form-control nganh_nghe select2" id="nghe_cap_4"
                                        onchange="setNameNganhNgheSearch(this)" @if (isset($params['nganh_nghe']))
                                        name="{{strlen($params['nganh_nghe'])==7?'nganh_nghe':''}}" @endif>
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
                                    <select class="form-control select2" name="devvn_xaphuongthitran"
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
            <a href="javascript:" data-toggle="modal" data-target="#moDal">
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
        @can('them_moi_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep')
        <div class="col-lg-6 " style="text-align: right">
            <a href="{{route('xuatbc.them-ket-qua-tot-nghiep-voi-doanh-nghiep')}}"><button type="button"
                    class="btn btn-info .bg-info">Thêm mới</button></a>
        </div>
        @endcan
    </div>
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
            @if (session('thongbao'))
            <div class="alert alert-success" role="alert">
                <strong>{{session('thongbao')}}</strong>
            </div>
            @endif
            <table class="table table-bordered m-table  m-table--head-bg-primary table-responsive">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên cơ sở đào tạo</th>

                        <th scope="col">Năm</th>
                        <th scope="col">Đợt</th>
                        <th scope="col">Tổng số HSSV tốt nghiệp</th>
                        <th scope="col">Số HSSV được tuyển dụng sau khi tốt nghiệp</th>
                        <th scope="col">Mức lương doanh nghiệp trả cho HSSV</th>
                        <th scope="col" colspan="2">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1)
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->ten}}</td>
                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>

                        <td>{{$item->tong_tot_nghiep}}</td>
                        <td>{{$item->tong_tuyen_dung}}</td>
                        <td>{{number_format($item->tong_muc_luong,'0',',','.')}}</td>
                        @can('chi_tiet_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep')
                        <td><a href="{{route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $item->co_so_id])}}"
                                class=".text-info">Chi tiết</a></td>
                        @endcan
                    </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>
    <div class="m-portlet__foot d-flex justify-content-end">

    </div>
    <form action="{{route('layformbieumau.ket-qua-tot-nghiep-gan-voi-doanh-nghiep')}}" method="post">
        @csrf
        <div class="modal fade" id="moDal" tabindex="-1" role="dialog" aria-labelledby="moDalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moDalLabel">Hãy chọn trường</h5>
                        <button type="button" id="closeFileBieuMau" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="id_cs" class="form-control">
                            @foreach($coso as $csdt)
                            <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" onclick="closeModal('closeFileBieuMau')" class="btn btn-primary">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{route('import.error-ket-qua-tot-nghiep-gan-voi-doanh-nghiep')}}" id="form_import_file" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="moDalImport" tabindex="-1" role="dialog" aria-labelledby="moDalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moDalLabel">Import file</h5>
                        <button type="button" id="closeImportFile" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" id="file_import_id" name="file_import">
                        </div>
                        <div class="form-group">
                            <label for="">Chọn năm</label>
                            <select name="nam" id="nam_id" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn đợt</label>
                            <select name="dot" id="dot_id" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="submitTai">Tải</a>
                            <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{route('exportdata.ket-qua-tot-nghiep-gan-voi-doanh-nghiep')}}" id="" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="moDalExportData" tabindex="-1" role="dialog" aria-labelledby="moDalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="moDalLabel">Xuất dữ liệu</h5>
                        <button type="button" id='closeXuatDuLieu' class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="form-group">
                            <label for="">Chọn năm xuất</label>
                            <select name="nam_muon_xuat" id="nam_id_xuat" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                              </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Chọn ngày xuất</label>
                            {{-- <select name="dot_muon_xuat" id="dot_id_xuat" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select> --}}
                            <div class='input-group date datepicker' name="datepicker">
                                <p>From: <input type="text" class="form-control" name="dateFrom" id="datepickerFrom">
                                </p>
                                @error('dateFrom')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                <p>To: <input type="text" class="form-control" name="dateTo" id="datepickerTo"></p>
                                @error('dateTo')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                                {{-- <span class="input-group-addon">
                                         <span class="glyphicon glyphicon-calendar">
                                         </span>
                                  </span> --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Trường</label>
                            <select name="truong_id" id="truong_id_xuat" class="form-control">
                                @foreach($coso as $csdt)
                                <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                                @endforeach
                                {{-- <option value="all">Tất cả</option> --}}
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" onclick="closeModalXuat('closeXuatDuLieu')"
                            id="submitXuatData">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script src="{{ asset('js/so_lieu_tuyen_sinh/tong_hop_so_lieu.js') }}"></script>
{{-- thanhnv update change to service 6/25/2020 --}}
<script>
    var routeImport = "{{route('import-ket-qua-tot-nghiep-gan-voi-doanh-nghiep')}}";
</script>
<script src="{!! asset('excel-js/js-xuat-time.js') !!}"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
{{-- end --}}
<script>
    $(function() {
  const queryString = new URLSearchParams(window.location.search);
  const nam = queryString.get('nam') ? queryString.get('nam') : (new Date()).getFullYear();
  const dot = queryString.get('dot') ? queryString.get('dot') :
    ((new Date()).getMonth()+1 < 6 ? 1 : 2);
  $("#nam").val(nam);
  $("#dot").val(dot);
  $("#loai_hinh").val("");
 
});
</script>
<script type="text/javascript">
    var url_tuyen_sinh_theo_loai_hinh = "{{route('csTuyenSinhTheoLoaiHinh')}}"
    var url_xa_phuong_theo_quan_huyen = "{{route('getXaPhuongTheoQuanHuyen')}}"
    var url_nghe_theo_nghe_cap_bac= "{{route('getNgheTheoCapBac')}}"
        $(document).ready(function(){
        $('.select2').select2();
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
            $('#preload').css('display','none')
            $('#devvn_xaphuongthitran').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
        });
    });
    
    function getNgheTheoCapBac(id){
        setNameNganhNgheSearch(id)
        var cap_nghe = $(id).val().length==3 ? 3: 4
        $('#preload').css('display','block')
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
                $('#preload').css('display','none')
                $('#nghe_cap_3').html(htmldata);
            }else{
                $('#preload').css('display','none')
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