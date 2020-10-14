@extends('layouts.admin')
@section('title', 'Thêm mới ngành nghề')
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
                        Ngành nghề <small>Thêm mới</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="row form-group m-form__group">
                        <div class="col-4 text-center">
                            <div data-toggle="modal" data-target="#nghe_cap_2"
                                class="btn btn-outline-primary m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="la la-archive"></i>
                                    <span>Nghề cấp 2</span>
                                </span>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div data-toggle="modal" data-target="#nghe_cap_3"
                                class="btn btn-outline-success m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="la la-archive"></i>
                                    <span>Nghề cấp 3</span>
                                </span>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div data-toggle="modal" data-target="#nghe_cap_4"
                                class="btn btn-outline-danger m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                <span>
                                    <i class="la la-archive"></i>
                                    <span>Nghề cấp 4</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <select data-max ='max-cap-nghe'  class="form-control m-input m-input--square nghe_cap_1"
                                            id="">
                                            <option>Chọn mã cấp 1</option>
                                            @foreach (config('common.bac_nghe') as $item)
                                            <option value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                                {{$item['ten_bac']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 2</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" class="form-control m-input" placeholder="Nhập mã nghề cấp 2" aria-describedby="basic-addon1">
                                        </div>
                                       
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square"
                                            placeholder="Nhập tên ngành nghề">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Thêm mới</button>
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
                                        <select  data-max ='max-cap-nghe'  class="form-control m-input m-input--square nghe_cap_2" id="">
                                            <option>Chọn mã cấp 2</option>
                                            @foreach ($nghe_cap_2 as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 3</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" class="form-control m-input" placeholder="Nhập mã nghề cấp 3" aria-describedby="basic-addon1">
                                        </div>
                                       
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square"
                                            placeholder="Nhập tên ngành nghề">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Thêm mới</button>
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
                                        <select class="form-control m-input m-input--square nghe_cap_3" id="">
                                            <option>Chọn mã cấp 3</option>
                                            @foreach ($nghe_cap_3 as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="exampleInputEmail1">Mã cấp 4</label>
                                        <div class="input-group m-input-group">
                                            <div class="input-group-prepend"><span class="input-group-text number_nghe"></span></div>
                                            <input type="number" class="form-control m-input" placeholder="Nhập mã nghề cấp 4" aria-describedby="basic-addon1">
                                        </div>
                                       
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="">Tên ngành nghề</label>
                                        <input type="text" class="form-control m-input m-input--square"
                                            placeholder="Nhập tên ngành nghề">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary  " data-dismiss="modal">Hủy</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Thêm mới</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- end form add nghề cấp 4 --}}
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
            $('.nghe_cap_1').select2();
            $('.nghe_cap_2').select2();
            $('.nghe_cap_3').select2();      
        });
</script>

<script>
      var url_nghe_theo_nghe_cap_bac= "{{route('getNgheTheoCapBac')}}"
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
            }else{
                $(id).parents('.modal-body').find('.nghe_cap_3').html(htmldata);
            }

        })
        .catch(function (error) {
            console.log(error);
        });
    }
</script>
@endsection