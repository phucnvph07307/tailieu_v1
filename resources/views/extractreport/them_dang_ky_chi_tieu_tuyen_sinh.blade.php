@extends('layouts.admin')
@section('title', "Thêm tổng hợp số lượng đăng ký chỉ tiêu tuyển sinh")
@section('style')
<style type="text/css">
    .error {
        color: red;
    }

</style>
@endsection
@section('content')
<form action="" method="post" class="m-form pt-5" id="validate-form-add">
    {{ csrf_field() }}
    <div class="m-content container-fluid">
        <div class="m-portlet mt-5">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm<small>tổng hợp số lượng đăng ký chỉ tiêu tuyển sinh</small>
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
                                    <select name="co_so_id" class="form-control select2" id="co_so_id">
                                        <option value="-1">-----Chọn cơ sở-----</option>
                                        @foreach($params['get_co_so'] as $item)
                                        <option 
                                            value="{{$item->id}}">
                                            {{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                    <label id="co_so_id-error" class="error" for="co_so_id"></label>

                                    @if ($errors->has('co_so_id'))
                                    <span class="text-danger">{{ $errors->first('co_so_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên nghề</label>
                                <div class="col-lg-10">
                                    <select name="nghe_id" class="form-control select2" id="nghe_id">
                                        <option value="-1">-----Chọn ngành nghề-----</option>
                                       
                                    </select>
                                    <label id="nghe_id-error" class="error" for="nghe_id"></label>
                                    @if ($errors->has('nghe_id'))
                                    <span class="text-danger">{{ $errors->first('nghe_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-10">
                                    <select name="nam" class="form-control select2">
                                        <option value="-1">-----Chọn năm-----</option>

                                        @foreach(config('common.nam.list') as $nam)
                                        <option {{ old('nam') == $nam ? 'selected' : '' }} value="{{$nam}}">{{$nam}}
                                        </option>
                                        @endforeach

                                    </select>
                                    <label id="nam-error" class="error" for="nam"></label>
                                    @if ($errors->has('nam'))
                                    <span class="text-danger">{{ $errors->first('nam') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-10">
                                    <select name="dot" class="form-control select2">
                                        <option value="-1">-----Chọn đợt-----</option>
                                        <option {{ old('dot') == config('common.dot.1') ? 'selected' : '' }}
                                            value="{{config('common.dot.1')}}">
                                            {{config('common.dot.1')}}</option>

                                        <option {{ old('dot') == config('common.dot.2') ? 'selected' : '' }}
                                            value="{{config('common.dot.2')}}">
                                            {{config('common.dot.2')}}</option>
                                    </select>
                                    <label id="dot-error" class="error" for="dot"></label>
                                    @if ($errors->has('dot'))
                                    <span class="text-danger">{{ $errors->first('dot') }}</span>
                                    @endif
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
                                                name="tong" value="{{ old('tong') }}">

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
                                                name="so_dang_ki_CD" value="{{ old('so_dang_ki_CD') }}">

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
                                                name="so_dang_ki_TC" value="{{ old('so_dang_ki_TC') }}">

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
                <a href="{{ route('xuatbc.ds-chi-tieu-ts') }}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </div>
</form>
</div>
@endsection
@section('script')
<script src="{!! asset('dang-ky-chi-tieu-tuyen-sinh/validate-create-dk_chi_tieu_ts.js') !!}"></script>
@if (session('edit'))
<script>
    Swal.fire({
        title: 'Dữ liệu đã tồn tại',
        text: "Bạn có thể chuyển tới Chỉnh sửa!",
        icon: 'warning',
        showCancelButton: true,
        showconfirmButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Edit'
        }).then((result) => {
            if (result.value) {
                window.location.href = '{{ route('xuatbc.sua-dang-ky-chi-tieu-tuyen-sinh',['id'=> session('edit')]) }}';
            }
        })
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Thêm thành công !',
        showConfirmButton: false,
        timer: 3500
    })

</script>
@endif
@endsection
