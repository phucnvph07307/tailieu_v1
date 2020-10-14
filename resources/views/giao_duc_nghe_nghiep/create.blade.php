@extends('layouts.admin')
@section('title', "Thêm mới quản lý giáo dục nghề nghiệp")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .batbuoc,.error {
        color: red;
    }

    .alert-danger {
        margin-top: 10px;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
<form action="{{route('xuatbc.quan-ly-giao-duc-nghe-nghiep.store')}}" id="validate-form" method="post">
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm mới<small>quản lý giáo dục nghề nghiệp</small>
                        </h3>
                    </div>
                </div>
            </div>
           
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-5 col-form-label">Tên cơ sở<span
                                            class="batbuoc">*</span></label>
                                    <div class="col-lg-7">
                                        <select class="form-control" onchange="getdatacheck(this)" 
                                            name="co_so_id" id="co_so_dao_tao">
                                            <option value="">Chọn</option>
                                            @foreach ($ten_co_so as $item)
                                            <option value="{{$item->id}}">{{$item->ten}}</option>
                                            @endforeach
                                        </select>
                                        @error('co_so_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Năm<span class="batbuoc">*</span></label>
                                    <div class="col-lg-10">
                                        <select class="form-control " onchange="getdatacheck(this)"  name="nam"
                                            id="nam">
                                            <option value="">Chọn</option>
                                            @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                            <option @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif
                                                value="{{$item}}">
                                                {{$item}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('nam')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-5 col-form-label">Nghề<span class="batbuoc">*</span></label>
                                    <div class="col-lg-7">
                                        <select class="form-control "  disabled onchange="getdatacheck(this)"
                                            name="nghe_id" id="ma_nganh_nghe">
                                            <option value="" selected>Mã ngành nghề</option>
                                        </select>
                                        @error('nghe_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Đợt<span class="batbuoc">*</span></label>
                                    <div class="col-lg-10">
                                        <select class="form-control "  onchange="getdatacheck(this)" name="dot"
                                            id="dot">
                                            <option value="" selected>Chọn</option>
                                            <option value="1">Đợt 1</option>
                                            <option value="2">Đợt 2</option>
                                        </select>
                                        @error('dot')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    @csrf
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Tên ngành, nghề/ quy mô được cấp trong GCN
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row col-12">
                    <div class="col-md-4">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Mã cấp II</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control m-input" value="{{ old('ma_cap_2') }}" placeholder="Nhập vào số" name="ma_cap_2">
                                @error('ma_cap_2')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Quy mô tuyển sinh Trung Cấp</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control m-input" value="{{ old('quy_mo_tuyen_sinh_TC') }} " placeholder="Nhập vào số"
                                    name="quy_mo_tuyen_sinh_TC">
                                @error('quy_mo_tuyen_sinh_TC')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Quy mô tuyển sinh Sơ Cấp</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control m-input" value="{{ old('quy_mo_tuyen_sinh_SC') }} " placeholder="Nhập vào số"
                                    name="quy_mo_tuyen_sinh_SC">
                                @error('quy_mo_tuyen_sinh_SC')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-end">
        <div class="col-lg-1 ">
            <a href="{{route('xuatbc.quan-ly-giao-duc-nghe-nghiep')}}" class="btn btn-danger">Hủy</a>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </div>
</form>
</div>
@endsection
@section('script')
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js">
</script>
<script>
    $(window).bind("pageshow", function() {
    arrcheck=[]
    $("#co_so_dao_tao").select2().val('').trigger('change');
    $('#nam').val('')
    $('#dot').val('')
    });
    var routeCheck = "{{ route('xuatbc.quan-ly-giao-duc-nghe-nghiep.check_so_lieu') }}";
    var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
    $(document).ready(function() {
        $('#co_so_dao_tao').select2();
        $('#ma_nganh_nghe').select2();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('giao_duc_nghe_nghiep/javascript/giao_duc_nghe_nghiep.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection