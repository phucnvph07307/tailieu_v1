@extends('layouts.admin')
@section('title', "Thêm kết quả xây dựng chương trình , giáo trình")
@section('style')
<style type="text/css">
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <form action="{{ route('xuatbc.store-ds-xd-giao-trinh') }}" method="post" id="validate-form-add">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Thêm<small>tổng hợp kết quả xây dựng chương trình , giáo trình</small>
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
        <div class="row">
            <div class="col-lg-6 mb-5">
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="m-menu__link-icon flaticon-web"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Xây dựng
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số xây dựng chương trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="tong_so_XD_chuong_trinh_moi"
                                                value="{{ old('tong_so_XD_chuong_trinh_moi') }}">

                                            @if ($errors->has('tong_so_XD_chuong_trinh_moi'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_XD_chuong_trinh_moi') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_chuong_trinh_moi_CD"
                                                value="{{ old('XD_chuong_trinh_moi_CD') }}">

                                            @if ($errors->has('XD_chuong_trinh_moi_CD'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình CT</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_chuong_trinh_moi_TC"
                                                value="{{ old('XD_chuong_trinh_moi_TC') }}">

                                            @if ($errors->has('XD_chuong_trinh_moi_TC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_chuong_trinh_moi_SC"
                                                value="{{ old('XD_chuong_trinh_moi_SC') }}">

                                            @if ($errors->has('XD_chuong_trinh_moi_SC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số xây dựng giáo trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="tong_so_XD_giao_trinh_moi"
                                                value="{{ old('tong_so_XD_giao_trinh_moi') }}">

                                            @if ($errors->has('tong_so_XD_giao_trinh_moi'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_XD_giao_trinh_moi') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_giao_trinh_moi_CD"
                                                value="{{ old('XD_giao_trinh_moi_CD') }}">

                                            @if ($errors->has('XD_giao_trinh_moi_CD'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình TC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_giao_trinh_moi_TC"
                                                value="{{ old('XD_giao_trinh_moi_TC') }}">

                                            @if ($errors->has('XD_giao_trinh_moi_TC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="XD_giao_trinh_moi_SC"
                                                value="{{ old('XD_giao_trinh_moi_SC') }}">

                                            @if ($errors->has('XD_giao_trinh_moi_SC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Kinh phí thực hiện xây dựng</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="kinh_phi_thuc_hien_xd_moi"
                                                value="{{ old('kinh_phi_thuc_hien_xd_moi') }}">

                                            @if ($errors->has('kinh_phi_thuc_hien_xd_moi'))
                                            <span
                                                class="text-danger">{{ $errors->first('kinh_phi_thuc_hien_xd_moi') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-6 mb-5">
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="m-menu__link-icon flaticon-web"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Chỉnh sửa
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số sửa chương trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="tong_so_chuong_trinh_chinh_sua"
                                                value="{{ old('tong_so_chuong_trinh_chinh_sua') }}">

                                            @if ($errors->has('tong_so_chuong_trinh_chinh_sua'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_chuong_trinh_chinh_sua') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_chuong_trinh_CD"
                                                value="{{ old('sua_chuong_trinh_CD') }}">

                                            @if ($errors->has('sua_chuong_trinh_CD'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình CT</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_chuong_trinh_TC"
                                                value="{{ old('sua_chuong_trinh_TC') }}">

                                            @if ($errors->has('sua_chuong_trinh_TC'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_chuong_trinh_SC"
                                                value="{{ old('sua_chuong_trinh_SC') }}">

                                            @if ($errors->has('sua_chuong_trinh_SC'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số sửa giáo trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="tong_so_giao_trinh_chinh_sua"
                                                value="{{ old('tong_so_giao_trinh_chinh_sua') }}">

                                            @if ($errors->has('tong_so_giao_trinh_chinh_sua'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_giao_trinh_chinh_sua') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_giao_trinh_CD"
                                                value="{{ old('sua_giao_trinh_CD') }}">

                                            @if ($errors->has('sua_giao_trinh_CD'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình TC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_giao_trinh_TC"
                                                value="{{ old('sua_giao_trinh_TC') }}">

                                            @if ($errors->has('sua_giao_trinh_TC'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="sua_giao_trinh_SC"
                                                value="{{ old('sua_giao_trinh_SC') }}">

                                            @if ($errors->has('sua_giao_trinh_SC'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Kinh phí thực hiện sửa</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field"
                                                placeholder="Nhập vào số" name="kinh_phi_thuc_hien_chinh_sua"
                                                value="{{ old('kinh_phi_thuc_hien_chinh_sua') }}">

                                            @if ($errors->has('kinh_phi_thuc_hien_chinh_sua'))
                                            <span
                                                class="text-danger">{{ $errors->first('kinh_phi_thuc_hien_chinh_sua') }}</span>
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
                <a href="{{ route('xuatbc.ds-xd-giao-trinh') }}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{!! asset('xay_dung_chuong_trinh_giao_trinh/validate-create.js') !!}"></script>
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
                window.location.href = '{{ route('xuatbc.edit-ds-xd-giao-trinh',['id'=> session('edit')]) }}';
            }
        })
</script>
@endif
@endsection

