@extends('layouts.admin')
@section('title', 'Cập nhật thông tin ngành nghề')
@section('style')
    <style>
        .alert-danger{
            margin-top: 10px
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
                        Ngành nghề <small>Cập nhật ngành nghề</small>
                    </h3>
                </div>
            </div>
        </div>
    <form action="{{route('nghe.update',['id'=>$data->id])}}" method="POST">
        @csrf
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="col-12 form-group m-form__group">
                        <div class="col-12 d-flex">
                            <div class="form-group mr-4 col-6">
                                <label for="">Tên ngành nghề</label>
                                <input value="{{$data->ten_nganh_nghe}}" type="text" name="ten_nganh_nghe" class="form-control m-input m-input--square ten_nghe"
                                    placeholder="Nhập tên ngành nghề">
                                    @error('ten_nganh_nghe')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="">Mã nghề cấp 1</label>
                                <select onchange="getNgheTheoCapBac(this)" name="bac_nghe" class="form-control nghe_cap_1">
                                    @foreach (config('common.bac_nghe') as $item)
                                        <option
                                        {{( substr($data->id,0,1) == $item['ma_bac'] ) ? 'selected' : ''}}
                                        value="{{$item['ma_bac']}}">{{$item['ma_bac']}} -
                                            {{$item['ten_bac']}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>   
                        
                        <div class="col-12 d-flex">
                            <div class="form-group mr-4 col-6">
                                <label  for="">Mã nghề cấp 2</label>
                                <select onchange="getNgheTheoCapBac(this)" class="form-control m-input m-input--square nghe_cap_2" id="">
                                    <option>Chọn mã cấp 2</option>
                                    @foreach ($nghe_cap_2 as $item)
                                    <option
                                    {{( substr($data->id,0,3) == $item->id ) ? 'selected' : ''}}
                                    value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Mã nghề cấp 3</label>
                                <select name="nghe_cap_3" onchange="getValueNghe(this)" class="form-control m-input m-input--square nghe_cap_3" id="">
                                    <option value="">Chọn mã cấp 3</option>
                                    @foreach ($nghe_cap_3 as $item)
                                    <option 
                                    {{( substr($data->id,0,5) == $item->id ) ? 'selected' : ''}}
                                    value="{{$item->id}}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                    </option>
                                    @endforeach
                                    @error('nghe_cap_3')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" value="{{substr($data->id,0,5)}}" class="nghe_duoc_chon">
                                </select>
                            </div>
                        </div> 
                        <div class="col-12 d-flex">
                            <div class="form-group m-form__group col-6">
                                <label for="exampleInputEmail1">Mã cấp 4</label>
                                <div class="input-group m-input-group">
                                    <div class="input-group-prepend"><span class="input-group-text number_nghe">{{substr($data->id,0,5)}}</span></div>
                                    <input name="number_nghe_4" type="number" value="{{substr($data->id,5,7)}}" maxlength="2" class="form-control m-input number_ma_nghe_nhap" placeholder="Nhập mã nghề cấp 4" aria-describedby="basic-addon1">
                                </div>
                                <div class="error number_ma_nghe_nhap"></div>
                               <div class="error id_nghe"></div>
                               <input type="hidden" name="id_nghe_4" id="id_nghe_4">
                               @error('number_nghe_4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @error('id_nghe_4')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
          

    </div>
    <div class="col-md-12 d-flex justify-content-end pb-5">
        <a style="color: white" href="http://127.0.0.1:8000/xuat-bao-cao/chinh-sach-sinh-vien/tong-hop-chinh-sach-sinh-vien"><button type="button" class="btn btn-danger mr-5">Hủy</button></a>
        <button type="submit" onclick="getIdNghe()" class="btn btn-primary">Cập nhật</button>   
    </div>
</form>
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
    const url_nghe_theo_nghe_cap_bac= "{{route('getNgheTheoCapBac')}}"


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
                $('.nghe_cap_2').html(htmldata);
                $(".nghe_cap_3").select2().val('').trigger('change');
            }else{
                $('.nghe_cap_3').html(htmldata);
            }

        })
        .catch(function (error) {
            console.log(error);
        });
    }
    function getValueNghe(params) {
        let ma_nghe = $(params).val()
        $('.number_nghe').html(ma_nghe)
        $('.nghe_duoc_chon').val(ma_nghe)
        
    }
    function getIdNghe() {
        const id_nghe = $('.nghe_duoc_chon').val()+$('.number_ma_nghe_nhap').val()
        $('#id_nghe_4').val(id_nghe)
    }
</script>
@endsection