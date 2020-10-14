@extends('layouts.admin')
@section('title', "Chỉnh sửa tổng hợp số lượng đăng ký chỉ tiêu tuyển sinh")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <form action="" method="post" class="m-form pt-5" id="validate-form-update">
        @csrf
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chỉnh sửa<small>tổng hợp số lượng đăng ký chỉ tiêu tuyển sinh</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-10">
                                    <select name="" class="form-control " disabled>
                                        @foreach ($params['co_so_dao_tao'] as $item)
                                        <option {{ $data->co_so_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên nghề</label>
                                <div class="col-lg-10">
                                    <select name="" class="form-control " disabled>
                                        <option>{{ $params['ten_nghe']}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-10">
                                    <select name="" class="form-control " disabled>
                                        <option>{{ $data->nam }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-10">
                                    <select name="" class="form-control " disabled>
                                        <option>{{ $data->dot }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng đăng ký chỉ tiêu tuyển sinh
                                        </label>
                                        <div class="col-lg-7">
                                            <input type="number" min="0" class="form-control m-input" placeholder="Nhập vào số"
                                                name="tong" @if (old('tong')) value="{{old('tong')}}" @else
                                                value="{{ $data->tong }}" @endif>

                                            @if ($errors->has('tong'))
                                            <span class="text-danger">{{ $errors->first('tong') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng đăng ký tuyển sinh cao
                                            đẳng</label>
                                        <div class="col-lg-7">
                                            <input type="number" min="0" class="form-control m-input" placeholder="Nhập vào số"
                                                name="so_dang_ki_CD" @if (old('so_dang_ki_CD'))
                                                value="{{old('so_dang_ki_CD')}}" @else
                                                value="{{ $data->so_dang_ki_CD }}" @endif>

                                            @if ($errors->has('so_dang_ki_CD'))
                                            <span class="text-danger">{{ $errors->first('so_dang_ki_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng đăng ký tuyển sinh trung
                                            cấp</label>
                                        <div class="col-lg-7">
                                            <input type="number" min="0" class="form-control m-input" placeholder="Nhập vào số"
                                                name="so_dang_ki_TC" @if (old('so_dang_ki_TC'))
                                                value="{{old('so_dang_ki_TC')}}" @else
                                                value="{{ $data->so_dang_ki_TC }}" @endif>

                                            @if ($errors->has('so_dang_ki_TC'))
                                            <span class="text-danger">{{ $errors->first('so_dang_ki_TC') }}</span>
                                            @endif
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
                <a href="{{ route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh',['co_so_id' => $data->co_so_id]) }}" class="btn btn-danger text-white">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{!! asset('dang-ky-chi-tieu-tuyen-sinh/validate-update-dk_chi_tieu_ts.js') !!}"></script>
@if (session('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Cập nhật thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@endsection

