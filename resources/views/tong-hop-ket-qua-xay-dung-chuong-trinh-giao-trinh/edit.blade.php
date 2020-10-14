@extends('layouts.admin')
@section('title', "Chinh sửa kết quả xây dựng chương trình , giáo trình")
@section('style')
<style type="text/css">
    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <form action="{{ route('xuatbc.update-ds-xd-giao-trinh',['id' => $data->id]) }}" method="post" id="validate-form-update">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Sửa<small>tổng hợp kết quả xây dựng chương trình , giáo trình</small>
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
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_so_XD_chuong_trinh_moi" @if (old('tong_so_XD_chuong_trinh_moi'))
                                                value="{{old('tong_so_XD_chuong_trinh_moi')}}" @else
                                                value="{{ $data->tong_so_XD_chuong_trinh_moi }}" @endif>

                                            @if ($errors->has('tong_so_XD_chuong_trinh_moi'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_XD_chuong_trinh_moi') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_chuong_trinh_moi_CD" @if (old('XD_chuong_trinh_moi_CD'))
                                                value="{{old('XD_chuong_trinh_moi_CD')}}" @else
                                                value="{{ $data->XD_chuong_trinh_moi_CD }}" @endif>

                                            @if ($errors->has('XD_chuong_trinh_moi_CD'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình CT</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_chuong_trinh_moi_TC" @if (old('XD_chuong_trinh_moi_TC'))
                                                value="{{old('XD_chuong_trinh_moi_TC')}}" @else
                                                value="{{ $data->XD_chuong_trinh_moi_TC }}" @endif>

                                            @if ($errors->has('XD_chuong_trinh_moi_TC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng chương trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_chuong_trinh_moi_SC" @if (old('XD_chuong_trinh_moi_SC'))
                                                value="{{old('XD_chuong_trinh_moi_SC')}}" @else
                                                value="{{ $data->XD_chuong_trinh_moi_SC }}" @endif>

                                            @if ($errors->has('XD_chuong_trinh_moi_SC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_chuong_trinh_moi_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số xây dựng giáo trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_so_XD_giao_trinh_moi" @if (old('tong_so_XD_giao_trinh_moi'))
                                                value="{{old('tong_so_XD_giao_trinh_moi')}}" @else
                                                value="{{ $data->tong_so_XD_giao_trinh_moi }}" @endif>

                                            @if ($errors->has('tong_so_XD_giao_trinh_moi'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_XD_giao_trinh_moi') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_giao_trinh_moi_CD" @if (old('XD_giao_trinh_moi_CD'))
                                                value="{{old('XD_giao_trinh_moi_CD')}}" @else
                                                value="{{ $data->XD_giao_trinh_moi_CD }}" @endif>

                                            @if ($errors->has('XD_giao_trinh_moi_CD'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình TC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_giao_trinh_moi_TC" @if (old('XD_giao_trinh_moi_TC'))
                                                value="{{old('XD_giao_trinh_moi_TC')}}" @else
                                                value="{{ $data->XD_giao_trinh_moi_TC }}" @endif>

                                            @if ($errors->has('XD_giao_trinh_moi_TC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng xây dựng giáo trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="XD_giao_trinh_moi_SC" @if (old('XD_giao_trinh_moi_SC'))
                                                value="{{old('XD_giao_trinh_moi_SC')}}" @else
                                                value="{{ $data->XD_giao_trinh_moi_SC }}" @endif>

                                            @if ($errors->has('XD_giao_trinh_moi_SC'))
                                            <span
                                                class="text-danger">{{ $errors->first('XD_giao_trinh_moi_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Kinh phí thực hiện xây dựng</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="kinh_phi_thuc_hien_xd_moi" @if (old('kinh_phi_thuc_hien_xd_moi'))
                                                value="{{old('kinh_phi_thuc_hien_xd_moi')}}" @else
                                                value="{{ $data->kinh_phi_thuc_hien_xd_moi }}" @endif>

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
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_so_chuong_trinh_chinh_sua" @if (old('tong_so_chuong_trinh_chinh_sua'))
                                                value="{{old('tong_so_chuong_trinh_chinh_sua')}}" @else
                                                value="{{ $data->tong_so_chuong_trinh_chinh_sua }}" @endif>

                                            @if ($errors->has('tong_so_chuong_trinh_chinh_sua'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_chuong_trinh_chinh_sua') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="sua_chuong_trinh_CD" @if (old('sua_chuong_trinh_CD'))
                                                value="{{old('sua_chuong_trinh_CD')}}" @else
                                                value="{{ $data->sua_chuong_trinh_CD }}" @endif>

                                            @if ($errors->has('sua_chuong_trinh_CD'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình CT</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="sua_chuong_trinh_TC" @if (old('sua_chuong_trinh_TC'))
                                                value="{{old('sua_chuong_trinh_TC')}}" @else
                                                value="{{ $data->sua_chuong_trinh_TC }}" @endif>

                                            @if ($errors->has('sua_chuong_trinh_TC'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa chương trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="sua_chuong_trinh_SC" @if (old('sua_chuong_trinh_SC'))
                                            value="{{old('sua_chuong_trinh_SC')}}" @else
                                            value="{{ $data->sua_chuong_trinh_SC }}" @endif>

                                            @if ($errors->has('sua_chuong_trinh_SC'))
                                            <span class="text-danger">{{ $errors->first('sua_chuong_trinh_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số sửa giáo trình</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_so_giao_trinh_chinh_sua" @if (old('tong_so_giao_trinh_chinh_sua'))
                                                value="{{old('tong_so_giao_trinh_chinh_sua')}}" @else
                                                value="{{ $data->tong_so_giao_trinh_chinh_sua }}" @endif>

                                            @if ($errors->has('tong_so_giao_trinh_chinh_sua'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_giao_trinh_chinh_sua') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình CĐ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="sua_giao_trinh_CD" @if (old('sua_giao_trinh_CD'))
                                                value="{{old('sua_giao_trinh_CD')}}" @else
                                                value="{{ $data->sua_giao_trinh_CD }}" @endif>

                                            @if ($errors->has('sua_giao_trinh_CD'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình TC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="sua_giao_trinh_TC" @if (old('sua_giao_trinh_TC'))
                                            value="{{old('sua_giao_trinh_TC')}}" @else
                                            value="{{ $data->sua_giao_trinh_TC }}" @endif>

                                            @if ($errors->has('sua_giao_trinh_TC'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số lượng sửa giáo trình SC</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="sua_giao_trinh_SC" @if (old('sua_giao_trinh_SC'))
                                            value="{{old('sua_giao_trinh_SC')}}" @else
                                            value="{{ $data->sua_giao_trinh_SC }}" @endif>

                                            @if ($errors->has('sua_giao_trinh_SC'))
                                            <span class="text-danger">{{ $errors->first('sua_giao_trinh_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Kinh phí thực hiện sửa</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="kinh_phi_thuc_hien_chinh_sua" @if (old('kinh_phi_thuc_hien_chinh_sua'))
                                            value="{{old('kinh_phi_thuc_hien_chinh_sua')}}" @else
                                            value="{{ $data->kinh_phi_thuc_hien_chinh_sua }}" @endif>

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
                <a href="{{ route('xuatbc.show-ds-xd-giao-trinh',['co_so_id' => $data->co_so_id]) }}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{!! asset('xay_dung_chuong_trinh_giao_trinh/validate-edit.js') !!}"></script>
@endsection

