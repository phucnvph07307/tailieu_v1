@extends('layouts.admin')
@section('title', "Cập nhật quản lý giáo dục nghề nghiệp")
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
    @csrf
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Cập nhật<small>quản lý giáo dục nghề nghiệp</small>
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label ">Tên cơ sở đào tạo </label>
                            <div class="col-lg-9">
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
                            <label class="col-lg-3 col-form-label">Năm </label>
                            <div class="col-lg-9">
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
                            <label class="col-lg-3 col-form-label ">Tên nghề </label>
                            <div class="col-lg-9">
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
                            <label class="col-lg-3 col-form-label">Đợt </label>
                            <div class="col-lg-9">
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
    <form action="{{route('xuatbc.quan-ly-giao-duc-nghe-nghiep.update',['id'=>$data->id])}}" id="validate-form"
        method="post">
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
                                    <input type="number" value="{{$data->ma_cap_2}}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="ma_cap_2">
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
                                    <input type="number" value="{{$data->quy_mo_tuyen_sinh_TC}}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="quy_mo_tuyen_sinh_TC">
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
                                    <input type="number" value="{{$data->quy_mo_tuyen_sinh_SC}}" class="form-control m-input"
                                        placeholder="Nhập vào số" name="quy_mo_tuyen_sinh_SC">
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
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection