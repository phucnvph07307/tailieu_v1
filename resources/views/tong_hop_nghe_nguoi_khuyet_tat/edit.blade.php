@extends('layouts.admin')
@section('title', "Sửa tổng hợp đào tạo nghề cho người khuyết tật")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<style>
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
    <form action="{{route('nhapbc.dao-tao-khuyet-tat.update',['id'=>$data->id])}}" id="validate-form" method="post"
        class="m-form pt-5">
        @csrf
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Cập nhật<small>tổng hợp đào tạo nghề cho người khuyết tật</small>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-5 col-form-label ">Tên cơ sở đào tạo </label>
                                <div class="col-lg-7">
                                    <select class="form-control " disabled>
                                        <option value="">
                                            {{$data->ten}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm </label>
                                <div class="col-lg-10">
                                    <select class="form-control " id="nam" disabled>
                                        <option value="">
                                            {{$data->nam}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-5 col-form-label ">Tên nghề </label>
                                <div class="col-lg-7">
                                    <select class="form-control " disabled>
                                        <option value="">
                                            {{$data->nghe_id}}- {{$data->ten_nganh_nghe}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt </label>
                                <div class="col-lg-10">
                                    <select class="form-control " disabled>
                                        <option value="">
                                            {{$data->dot}}
                                        </option>
                                    </select>
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
                                    <input type="number" value="{{$data->tong_ngan_sach}}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="tong_ngan_sach">
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
                                    <input type="number" value="{{$data->ngan_sach_TW}}" class="form-control m-input"
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
                                    <input type="number" value="{{$data->ngan_sach_TP}}" class="form-control m-input"
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
                                    <input type="number" value="{{$data->ngan_sach_khac}}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="ngan_sach_khac">
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
                                            <input type="number" value="{{$data->tong_tuyen_sinh}}"
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
                                            <input type="number" value="{{$data->tuyen_sinh_nu}}"
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
                                            <input type="number" value="{{$data->tuyen_sinh_ho_khau_HN}}"
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
                                            <input type="number" value="{{$data->tong_tot_nghiep}}"
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
                                            <input type="number" value="{{$data->tot_nghiep_nu}}"
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
                                            <input type="number" value="{{$data->tot_nghiep_ho_khau_HN}}"
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
                <a href="{{route('nhapbc.dao-tao-khuyet-tat.show',['id'=>$data->co_so_id])}}"
                    class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection