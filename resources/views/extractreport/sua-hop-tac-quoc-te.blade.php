@extends('layouts.admin')
@section('title', "Chỉnh sửa kết quả hợp tác quốc tế")
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
    <form action="" method="POST" class="m-form pt-5" id="validate-form-update">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chỉnh sửa<small>kết quả tác quốc tế</small>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên đơn vị</label>
                                <div class="col-lg-8">
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
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select name="" class="form-control " disabled>
                                        <option>{{ $data->nam }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
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
                                    Kết quả<small>tuyển sinh theo chương trình quốc tế</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Cao đẳng</label>
                                        <div class="col-lg-5"> 
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_tuyen_sinh_CD" @if (old('tong_tuyen_sinh_CD'))
                                                value="{{old('tong_tuyen_sinh_CD')}}" @else
                                                value="{{ $data->tong_tuyen_sinh_CD }}" @endif>

                                            @if ($errors->has('tong_tuyen_sinh_CD'))
                                            <span class="text-danger">{{ $errors->first('tong_tuyen_sinh_CD') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Trung cấp</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_tuyen_sinh_TC" @if (old('tong_tuyen_sinh_TC'))
                                                value="{{old('tong_tuyen_sinh_TC')}}" @else
                                                value="{{ $data->tong_tuyen_sinh_TC }}" @endif>

                                            @if ($errors->has('tong_tuyen_sinh_TC'))
                                            <span class="text-danger">{{ $errors->first('tong_tuyen_sinh_TC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Sơ cấp</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_tuyen_sinh_SC" @if (old('tong_tuyen_sinh_SC'))
                                                value="{{old('tong_tuyen_sinh_SC')}}" @else
                                                value="{{ $data->tong_tuyen_sinh_SC }}" @endif>

                                            @if ($errors->has('tong_tuyen_sinh_SC'))
                                            <span class="text-danger">{{ $errors->first('tong_tuyen_sinh_SC') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số kết quả tuyển sinh theo chương
                                            trình
                                            đào tạo quốc tế</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                                name="tong_tuyen_sinh" @if (old('tong_tuyen_sinh'))
                                                value="{{old('tong_tuyen_sinh')}}" @else
                                                value="{{ $data->tong_tuyen_sinh }}" @endif>

                                            @if ($errors->has('tong_tuyen_sinh'))
                                            <span class="text-danger">{{ $errors->first('tong_tuyen_sinh') }}</span>
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
                                    Số học sinh<small>được cấp bằng theo hình thức hợp tác quốc tế</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số HS được các đơn vị / tổ chức nước
                                            ngoài
                                            hợp tác đào tạo cấp bằng</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_hs_duoc_cac_don_vi_cap_bang" @if (old('so_hs_duoc_cac_don_vi_cap_bang'))
                                            value="{{old('so_hs_duoc_cac_don_vi_cap_bang')}}" @else
                                            value="{{ $data->so_hs_duoc_cac_don_vi_cap_bang }}" @endif>

                                            @if ($errors->has('so_hs_duoc_cac_don_vi_cap_bang'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_hs_duoc_cac_don_vi_cap_bang') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số HS được nhà trường cấp bằng theo hình
                                            thức
                                            hợp tác quốc tế</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_hs_duoc_nha_truong_cap_bang" @if (old('so_hs_duoc_nha_truong_cap_bang'))
                                            value="{{old('so_hs_duoc_nha_truong_cap_bang')}}" @else
                                            value="{{ $data->so_hs_duoc_nha_truong_cap_bang }}" @endif>

                                            @if ($errors->has('so_hs_duoc_nha_truong_cap_bang'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_hs_duoc_nha_truong_cap_bang') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số học sinh được cấp bằng tốt
                                            nghiệp</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="tong_so_hs_duoc_cap_bang" @if (old('tong_so_hs_duoc_cap_bang'))
                                            value="{{old('tong_so_hs_duoc_cap_bang')}}" @else
                                            value="{{ $data->tong_so_hs_duoc_cap_bang }}" @endif>

                                            @if ($errors->has('tong_so_hs_duoc_cap_bang'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_so_hs_duoc_cap_bang') }}</span>
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
                                    Hợp tác quốc tế<small>trong đào tạo , bồi dưỡng giáo viên,cán bộ quản lý</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số GV được đào tạo , bồi dưỡng , tập
                                            huấn</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_gv_duoc_dao_tao_boi_duong" @if (old('so_gv_duoc_dao_tao_boi_duong'))
                                            value="{{old('so_gv_duoc_dao_tao_boi_duong')}}" @else
                                            value="{{ $data->so_gv_duoc_dao_tao_boi_duong }}" @endif>

                                            @if ($errors->has('so_gv_duoc_dao_tao_boi_duong'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_gv_duoc_dao_tao_boi_duong') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số cán bọ được đào tạo , bồi dưỡng , tập
                                            huấn</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_can_bo_quan_ly_duoc_dao_tao_boi_duong" @if (old('so_can_bo_quan_ly_duoc_dao_tao_boi_duong'))
                                            value="{{old('so_can_bo_quan_ly_duoc_dao_tao_boi_duong')}}" @else
                                            value="{{ $data->so_can_bo_quan_ly_duoc_dao_tao_boi_duong }}" @endif>

                                            @if ($errors->has('so_can_bo_quan_ly_duoc_dao_tao_boi_duong'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_can_bo_quan_ly_duoc_dao_tao_boi_duong') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng số hợp tác quốc tế trong đào tạo ,
                                            bồi
                                            dưỡng GV , CB</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="tong_hop_tac_quoc_te_trong_dao_tao_boi_duong" @if (old('tong_hop_tac_quoc_te_trong_dao_tao_boi_duong'))
                                            value="{{old('tong_hop_tac_quoc_te_trong_dao_tao_boi_duong')}}" @else
                                            value="{{ $data->tong_hop_tac_quoc_te_trong_dao_tao_boi_duong }}" @endif>

                                            @if ($errors->has('tong_hop_tac_quoc_te_trong_dao_tao_boi_duong'))
                                            <span
                                                class="text-danger">{{ $errors->first('tong_hop_tac_quoc_te_trong_dao_tao_boi_duong') }}</span>
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
                                    Hợp tác quốc tế<small>trong đầu tư cơ sở vật chất,trang thiết bị</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số phòng học được đầu tư</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_phong_hoc_duoc_dau_tu" @if (old('so_phong_hoc_duoc_dau_tu'))
                                            value="{{old('so_phong_hoc_duoc_dau_tu')}}" @else
                                            value="{{ $data->so_phong_hoc_duoc_dau_tu }}" @endif>

                                            @if ($errors->has('so_phong_hoc_duoc_dau_tu'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_phong_hoc_duoc_dau_tu') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Số nhà xưởng thực hành đầu từ</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="so_nha_xuong_duoc_dau_tu" @if (old('so_nha_xuong_duoc_dau_tu'))
                                            value="{{old('so_nha_xuong_duoc_dau_tu')}}" @else
                                            value="{{ $data->so_nha_xuong_duoc_dau_tu }}" @endif>

                                            @if ($errors->has('so_nha_xuong_duoc_dau_tu'))
                                            <span
                                                class="text-danger">{{ $errors->first('so_nha_xuong_duoc_dau_tu') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-7 col-form-label">Tổng kinh phí đầu tư trang thiết bị , máy
                                            móc</label>
                                        <div class="col-lg-5">
                                            <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                            name="tong_kinh_phi" @if (old('tong_kinh_phi'))
                                            value="{{old('tong_kinh_phi')}}" @else
                                            value="{{ $data->tong_kinh_phi }}" @endif>

                                            @if ($errors->has('tong_kinh_phi'))
                                            <span class="text-danger">{{ $errors->first('tong_kinh_phi') }}</span>
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
        <div class="m-portlet mt-5">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-12 mb-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Số học sinh có việc làm sau khi tốt nghiệp chương
                                    trình hợp tác quốc tế</label>
                                <div class="col-lg-6">
                                    <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                    name="so_hs_co_viec_lam_sau_khi_tot_nghiep" @if (old('so_hs_co_viec_lam_sau_khi_tot_nghiep'))
                                    value="{{old('so_hs_co_viec_lam_sau_khi_tot_nghiep')}}" @else
                                    value="{{ $data->so_hs_co_viec_lam_sau_khi_tot_nghiep }}" @endif>

                                    @if ($errors->has('so_hs_co_viec_lam_sau_khi_tot_nghiep'))
                                    <span
                                        class="text-danger">{{ $errors->first('so_hs_co_viec_lam_sau_khi_tot_nghiep') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Số lượng chương trình, giáo trình được xây dựng,
                                    phát
                                    triển theo hình thức hợp tác quốc tế</label>
                                <div class="col-lg-6">
                                    <input type="number" min="0" class="form-control m-input name-field" placeholder="Nhập vào số"
                                    name="so_luong_chuong_trinh_xay_dung_phat_trien" @if (old('so_luong_chuong_trinh_xay_dung_phat_trien'))
                                    value="{{old('so_luong_chuong_trinh_xay_dung_phat_trien')}}" @else
                                    value="{{ $data->so_luong_chuong_trinh_xay_dung_phat_trien }}" @endif>

                                    @if ($errors->has('so_luong_chuong_trinh_xay_dung_phat_trien'))
                                    <span
                                        class="text-danger">{{ $errors->first('so_luong_chuong_trinh_xay_dung_phat_trien') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="col-lg-1 ">
                <a href="{{ route('xuatbc.chi-tiet-ds-hop-tac-qte',['co_so_id' => $data->co_so_id]) }}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{!! asset('hop-tac-quoc-te/validate-update-htqt.js') !!}"></script>
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
