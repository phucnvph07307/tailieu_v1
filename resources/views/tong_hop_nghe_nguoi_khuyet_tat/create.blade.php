@extends('layouts.admin')
@section('title', "Thêm mới tổng hợp đào tạo nghề cho người khuyết tật")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<link href="{!! asset('tong_hop_nghe_nguoi_khuyet_tat/css/tong_hop_nghe_nguoi_khuyet_tat.css') !!}" rel="stylesheet"
    type="text/css" />
<style>
    .bat_buoc,
    .error {
        color: red;
    }

    .alert-danger {
        margin-top: 10px;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <div id="preload" class="preload-container text-center" style="display: none">
        <img id="gif-load"
            src="https://lh3.googleusercontent.com/proxy/K1DiqfIsGjn-4HkgWYy36iRKdiU_vxNNnQbBCFV9QPg4UnfktLCQYOuFZrrK3QW8VeACeyTTZfyesnDI17IvrZd-mOMBD29jhLhzmg"
            alt="">
    </div>
    <form action="{{route('nhapbc.dao-tao-khuyet-tat.store')}}" method="post" id="validate-form" class="m-form pt-5">
        @csrf
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm mới<small>tổng hợp đào tạo nghề cho người khuyết tật</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-5 col-form-label">Tên cơ sở<span class="batbuoc">*</span></label>
                                <div class="col-lg-7">
                                    <select class="form-control" onchange="getdatacheck(this)" name="co_so_id"
                                        id="co_so_dao_tao">
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
                                    <select class="form-control " onchange="getdatacheck(this)" name="nam" id="nam">
                                        <option value="">Chọn</option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option @if (isset($params['nam']))
                                            {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif value="{{$item}}">
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
                                    <select class="form-control " disabled onchange="getdatacheck(this)" name="nghe_id"
                                        id="ma_nganh_nghe">
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
                                    <select class="form-control " onchange="getdatacheck(this)" name="dot" id="dot">
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
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Kinh phí
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Tổng kinh phí</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('tong_ngan_sach') }}"
                                        class="form-control m-input" placeholder="Nhập vào số" name="tong_ngan_sach">
                                    @error('tong_ngan_sach')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Ngân sách TW</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('ngan_sach_TW') }}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="ngan_sach_TW">
                                    @error('ngan_sach_TW')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Ngân sách TP</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('ngan_sach_TP') }}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="ngan_sach_TP">
                                    @error('ngan_sach_TP')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Ngân sách khác</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('ngan_sach_khac') }}"
                                        class="form-control m-input" placeholder="Nhập vào số" name="ngan_sach_khac">
                                    @error('ngan_sach_khac')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mb-5">
            <div class="col-lg-6">
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="m-menu__link-icon flaticon-web"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Tuyển sinh
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng tuyển sinh</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tuyen_sinh') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tong_tuyen_sinh">
                                            @error('tong_tuyen_sinh')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_nu') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tuyen_sinh_nu">
                                            @error('tuyen_sinh_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Hộ khẩu Hà Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_ho_khau_HN') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tuyen_sinh_ho_khau_HN">
                                            @error('tuyen_sinh_ho_khau_HN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="m-menu__link-icon flaticon-web"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng tốt nghiệp</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tong_tot_nghiep">
                                            @error('tong_tot_nghiep')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_nu') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tot_nghiep_nu">
                                            @error('tot_nghiep_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Hộ khẩu Hà Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_ho_khau_HN') }}"
                                                class="form-control m-input" placeholder="Nhập vào số"
                                                name="tot_nghiep_ho_khau_HN">
                                            @error('tot_nghiep_ho_khau_HN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-end">
            <div class="col-lg-1 ">
                <a href="{{route('nhapbc.dao-tao-khuyet-tat')}}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </form>
    @if (session('thongbao'))
    <div class="thongbao" style="color: red; text-align: center;">
        {{session('thongbao')}}
    </div>
    @endif
</div>
@endsection
@section('script')
<script>
    $(window).bind("pageshow", function() {
    arrcheck=[]
    $("#co_so_dao_tao").select2().val('').trigger('change');
    $('#nam').val('')
    $('#dot').val('')
    });
    var routeCheck = "{{ route('nhapbc.dao-tao-khuyet-tat.check_so_lieu') }}";
    var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
    $(document).ready(function() {
    $('#co_so_dao_tao').select2();
    $('#ma_nganh_nghe').select2();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('tong_hop_nghe_nguoi_khuyet_tat/javascript/tong_hop_nghe_nguoi_khuyet_tat.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection