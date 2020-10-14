@extends('layouts.admin')
@section('title', 'Danh sách ngành nghề')
@section('style')
<link href="{!! asset('tong_hop_nghe_nguoi_khuyet_tat/css/tong_hop_nghe_nguoi_khuyet_tat.css') !!}" rel="stylesheet"
    type="text/css" />
    <style>
        .add-nghe{
            cursor: pointer;
        }
		.error {
			color: red
		}
    </style>
@endsection
@section('content')
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
                        Ngành nghề <small>Danh sách</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Bậc nghề:</label>
                                <div class="col-lg-8">
                                    <select name="bac_nghe" class="form-control ">
										@foreach (config('common.bac_nghe') as $item)
                                            <option @if($params['bac_nghe']==$item['ma_bac']) selected @endif value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                                {{$item['ten_bac']}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Từ khóa:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input" @if(isset($params['keyword']))
                                        value="{{$params['keyword']}}" @endif placeholder="Nhập mã hoặc tên ngành nghề"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Mã cấp nghề</label>
                                <div class="col-lg-8">
                                    <select name="ma_cap_nghe" class="form-control ">
										@foreach (config('common.ma_cap_nghe') as $item)
                                            <option @if($params['ma_cap_nghe']==$item['id_cap_nghe']) selected @endif value="{{$item['id_cap_nghe']}}">
                                                {{$item['ten_cap_nghe']}}</option>
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
    <div class="m-portlet">
        <div class="m-portlet__body">
			@if (session('thongbao'))
				<div class="alert alert-success  alert-dismissible fade show" role="alert">
					<strong>Thành công</strong> {{session('thongbao')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
			@endif
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
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <th>Mã Nghề</th>
                    <th>Tên nghề</th>
                    <th>Số trường được cấp</th>
                    <th>Chức năng</th>
                    @can('them_moi_nganh_nghe')
                    <th>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Thêm mới
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <span data-toggle="modal" data-target="#nghe_cap_2" class="dropdown-item add-nghe" >Nghề cấp 2</span>
                                <span data-toggle="modal" data-target="#nghe_cap_3" class="dropdown-item add-nghe" >Nghề cấp 3</span>
                                <span data-toggle="modal" data-target="#nghe_cap_4" class="dropdown-item add-nghe" >Nghề cấp 4</span>
                            </div>
                        </div>
                    </th>
                    @endcan
                </thead>
                <tbody>
                    @foreach($data as $cursor)
                    <tr>
                        <td>{{$cursor->id}}</td>
                        <td>{{$cursor->ten_nganh_nghe}}</td>
                        <td>{{$cursor->csdt_count}}</td>
                        <td>

                            @can('xem_chi_tiet_nganh_nghe')
                            <a href="{{route('nghe.chi-tiet-nghe', ['ma_nghe' => $cursor->id])}}"
                                class="btn btn-info btn-sm">Chi tiết</a>
                            @endcan

							@can('cap_nhat_nganh_nghe')
							@if ($params['ma_cap_nghe']==4)
							<a href="{{ route('nghe.cap-nhat', ['id'=> $cursor->id]) }}"
                                class="btn btn-primary btn-sm">Cập nhật</a>
							@endif
                            
                            @endcan
                            
							@can('xoa_nganh_nghe')
							@if ($params['ma_cap_nghe']==4)
							<a onclick="return confirm('Bạn chắc chắn muốn xóa hay không')" href="{{ route('nghe.delete', ['id'=> $cursor->id]) }}" class="btn btn-danger btn-sm">Xóa</a>
							@endif
                           
                            @endcan

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
            {{-- start form add nghề cấp 2 --}}
            <div class="modal fade" id="nghe_cap_2">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới nghề cấp 2</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 1</label>
                                        <select onchange="getValueNghe(this)"  class="form-control m-input m-input--square nghe_cap_1"
                                            id="">
                                            <option>Chọn mã cấp 1</option>
                                            @foreach (config('common.bac_nghe') as $item)
                                            <option value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                                {{$item['ten_bac']}}</option>
                                            @endforeach
                                            <input type="hidden" class="nghe_duoc_chon">
                                        </select>
                                        <div class="error id_nghe_chon"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 2</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" maxlength="2" class="form-control m-input number_ma_nghe_nhap" placeholder="Nhập mã nghề cấp 2" aria-describedby="basic-addon1">
                                        </div>
										<div class="error number_ma_nghe_nhap"></div>
										<div class="error id_nghe"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square ten_nghe"
											placeholder="Nhập tên ngành nghề">
											<div class="error ten_nganh_nghe"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" onclick="addNghe(this)">Thêm mới</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end form add nghề cấp 2 --}}
            {{-- start form add nghề cấp 3 --}}
            <div class="modal fade" id="nghe_cap_3">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới nghề cấp 3</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 1</label>
                                        <select onchange="getNgheTheoCapBac(this)" class="form-control m-input m-input--square nghe_cap_1"
                                            id="">
                                            <option>Chọn mã cấp 1</option>
                                            @foreach  (config('common.bac_nghe') as $item)
                                            <option value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                                {{$item['ten_bac']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputPassword1">Mã cấp 2</label>
                                        <select  onchange="getValueNghe(this)"  class="form-control m-input m-input--square nghe_cap_2" id="">
                                            <option>Chọn mã cấp 2</option>
                                            @foreach ($nghe_cap_2 as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
											<input type="hidden" class="nghe_duoc_chon">
											<div class="error id_nghe_chon"></div>
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 3</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" maxlength="2" class="form-control m-input number_ma_nghe_nhap" placeholder="Nhập mã nghề cấp 3" aria-describedby="basic-addon1">
										</div>
										<div class="error number_ma_nghe_nhap"></div>
                                       <div class="error id_nghe"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square ten_nghe"
											placeholder="Nhập tên ngành nghề">
											<div class="error ten_nganh_nghe"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger"  onclick="addNghe(this)">Thêm mới</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end form add nghề cấp 3 --}}
            {{-- start form add nghề cấp 4 --}}
            <div class="modal fade" id="nghe_cap_4">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Thêm mới nghề cấp 4</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 1</label>
                                        <select onchange="getNgheTheoCapBac(this)" class="form-control m-input m-input--square nghe_cap_1"
                                            id="">
                                            <option>Chọn mã cấp 1</option>
                                            @foreach (config('common.bac_nghe') as $item)
                                            <option value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                                {{$item['ten_bac']}}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label  for="exampleInputPassword1">Mã cấp 2</label>
                                        <select onchange="getNgheTheoCapBac(this)" class="form-control m-input m-input--square nghe_cap_2" id="">
                                            <option>Chọn mã cấp 2</option>
                                            @foreach ($nghe_cap_2 as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputPassword1">Mã cấp 3</label>
                                        <select onchange="getValueNghe(this)" class="form-control m-input m-input--square nghe_cap_3" id="">
                                            <option>Chọn mã cấp 3</option>
                                            @foreach ($nghe_cap_3 as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
                                        </select>
										<input type="hidden" class="nghe_duoc_chon">
										<div class="error id_nghe_chon"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 4</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" maxlength="2" class="form-control m-input number_ma_nghe_nhap" placeholder="Nhập mã nghề cấp 4" aria-describedby="basic-addon1">
                                        </div>
										<div class="error number_ma_nghe_nhap"></div>
										<div class="error id_nghe"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square ten_nghe"
											placeholder="Nhập tên ngành nghề">
											<div class="error ten_nganh_nghe"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" onclick="addNghe(this)" >Thêm mới</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end form add nghề cấp 4 --}}
        <div class="m-portlet__foot d-flex justify-content-end">
            {{$data->links()}}
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function(){
        $('#page-size').change(function(){
            var bac_nghe = $('[name="bac_nghe"]').val();
            var keyword = $('[name="keyword"]').val();
            var page_size = $(this).val();
            var reloadUrl = `${currentUrl}?bac_nghe=${bac_nghe}&keyword=${keyword}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });
    });
</script>
<script>
    $(document).ready(function() {
            $('.nghe_cap_1').select2();
            $('.nghe_cap_2').select2();
            $('.nghe_cap_3').select2();      
        });
</script>

<script>
    const url_nghe_theo_nghe_cap_bac= "{{route('getNgheTheoCapBac')}}"
    const url_add_nghe= "{{route('nghe.them-moi.store')}}"


    function getNgheTheoCapBac(id){
        var cap_nghe = $(id).val().length==1 ? 2: 3
        axios.post(url_nghe_theo_nghe_cap_bac, {
            id:  $(id).val(),
            cap: cap_nghe
        })
        .then(function (response) {
            console.log(response.data)
            var htmldata = '<option value="" selected  >Chọn nghề</option>'
                response.data.forEach(element => {
                    htmldata+=`<option value="${element.id}">${element.id} - ${element.ten_nganh_nghe}</option>`
            });
            if ($(id).val().length==1) {
                $(id).parents('.modal-body').find('.nghe_cap_2').html(htmldata);
                $(id).parents('.modal-body').find('.number_nghe').html('')
                $(id).parents('.modal-body').find('.nghe_duoc_chon').val('')
            }else{
                $(id).parents('.modal-body').find('.nghe_cap_3').html(htmldata);
                $(id).parents('.modal-body').find('.number_nghe').html('')
                $(id).parents('.modal-body').find('.nghe_duoc_chon').val('')
            }

        })
        .catch(function (error) {
            console.log(error);
        });
    }

    function getValueNghe(params) {
        let ma_nghe = $(params).val()
        $(params).parents('.modal-body').find('.number_nghe').html(ma_nghe)
        $(params).parents('.modal-body').find('.nghe_duoc_chon').val(ma_nghe)
        
    }

    function addNghe(params) { 
		$('#preload').css('display','block')
        axios.post(url_add_nghe, {
            id: $(params).parents('.modal').find('.nghe_duoc_chon').val()+$(params).parents('.modal').find('.number_ma_nghe_nhap').val(),
            id_nghe_chon:  $(params).parents('.modal').find('.nghe_duoc_chon').val(),
            number_ma_nghe_nhap: $(params).parents('.modal').find('.number_ma_nghe_nhap').val(),
            ten_nganh_nghe: $(params).parents('.modal').find('.ten_nghe').val(),
        })
        .then(function (response) {
			$('#preload').css('display','none')
            if(response.data){
                $(".modal").modal('hide');
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thêm thành công !',
                showConfirmButton: false,
                timer: 2000
            })
            }
			$(params).parents('.modal').find('.id_nghe_chon').html('')
			$(params).parents('.modal').find('.number_ma_nghe_nhap').html('')
			$(params).parents('.modal').find('.ten_nganh_nghe').html('')
			$(params).parents('.modal').find('.id_nghe').html('')
        })
        .catch(function (error) {
			$('#preload').css('display','none')
			$(params).parents('.modal').find('.id_nghe_chon').html('')
			$(params).parents('.modal').find('.number_ma_nghe_nhap').html('')
			$(params).parents('.modal').find('.ten_nganh_nghe').html('')
			$(params).parents('.modal').find('.id_nghe').html('')
			$(params).parents('.modal').find('.id_nghe_chon').html(error.response.data.errors.id_nghe_chon)
			$(params).parents('.modal').find('.number_ma_nghe_nhap').html(error.response.data.errors.number_ma_nghe_nhap)
			$(params).parents('.modal').find('.ten_nganh_nghe').html(error.response.data.errors.ten_nganh_nghe)
			$(params).parents('.modal').find('.id_nghe').html(error.response.data.errors.id)
        });
    }
</script>
@endsection