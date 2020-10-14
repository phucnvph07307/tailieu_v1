@extends('layouts.admin')
@section('title', "Thêm mới tổng hợp đào tạo nghề cho thanh niên")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
<style>
    .batbuoc,.error {
        color: red;
    }
    .alert-danger{
        margin-top: 10px;
    }
</style>
@endsection
@section('content')
<div class="m-content container-fluid">
    <form action="{{route('nhapbc.dao-tao-thanh-nien.store')}}" id="validate-form" method="post"
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
                            Thêm mới<small>tổng hợp đào tạo nghề cho thanh niên</small>
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
                                    <select class="form-control" onchange="getdatacheck(this)"   name="co_so_id"
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
                                    <select class="form-control " onchange="getdatacheck(this)"  name="nam"
                                        id="nam">
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
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-5 col-form-label">Thời gian đào tạo (Tháng) <span
                                        class="batbuoc">*</span></label>
                                <div class="col-lg-7">
                                    <input type="number" value="{{ old('thoi_gian_dao_tao') }}"   class="form-control m-input"
                                        placeholder="Nhập vào số" name="thoi_gian_dao_tao">
                                        @error('thoi_gian_dao_tao')
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
                            Ngân sách
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Tổng ngân sách</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('tong_kinh_phi') }}"  class="form-control m-input" placeholder="Nhập vào số"
                                        name="tong_kinh_phi">
                                    @error('tong_kinh_phi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-4 col-form-label">Ngân sách TW</label>
                                <div class="col-lg-8">
                                    <input type="number" value="{{ old('ngan_sach_TW') }}"  class="form-control m-input" placeholder="Nhập vào số"
                                        name="ngan_sach_TW">
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
                                    <input type="number" value="{{ old('ngan_sach_TP') }}"  class="form-control m-input" placeholder="Nhập vào số"
                                        name="ngan_sach_TP">
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
                                    <input type="number" value="{{ old('ngan_sach_khac') }}"  class="form-control m-input" placeholder="Nhập vào số"
                                        name="ngan_sach_khac">
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
                                    Tổng số tuyển sinh
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số học viên các đối tượng</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tuyen_sinh') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tuyen_sinh">
                                            @error('tong_tuyen_sinh')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('nu_tuyen_sinh') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="nu_tuyen_sinh">
                                            @error('nu_tuyen_sinh')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số hộ khẩu Hà Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('ho_khau_HN_tuyen_sinh') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="ho_khau_HN_tuyen_sinh">
                                            @error('ho_khau_HN_tuyen_sinh')
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
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress-trinhdo h-100">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="m-menu__link-icon flaticon-web"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Tổng số tốt nghiệp
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số học viên các đối tượng</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep">
                                            @error('tong_tot_nghiep')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep_nu">
                                            @error('tong_tot_nghiep_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số hộ khẩu Hà Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep_ho_khau_HN">
                                            @error('tong_tot_nghiep_ho_khau_HN')
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
                                        <label class="col-lg-5 col-form-label">Tổng số bộ đội xuất ngũ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tuyen_sinh_bo_doi_xuat_ngu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tuyen_sinh_bo_doi_xuat_ngu">
                                            @error('tong_tuyen_sinh_bo_doi_xuat_ngu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng bộ đội xuất ngũ nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_bo_doi_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_bo_doi_nu">
                                            @error('tuyen_sinh_bo_doi_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng bộ đội xuất ngũ hộ khẩu Hà
                                            Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_bo_doi_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_bo_doi_ho_khau_HN">
                                            @error('tuyen_sinh_bo_doi_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số CA hoàn thành nghĩa vụ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tuyen_sinh_Ca') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tuyen_sinh_Ca">
                                            @error('tong_tuyen_sinh_Ca')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng CA hoàn thành nghĩa vụ
                                            nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_ca_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_ca_nu">
                                            @error('tuyen_sinh_ca_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng CA hoàn thành nghĩa vụ hộ khẩu
                                            Hà
                                            Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_ca_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_ca_ho_khau_HN">
                                            @error('tuyen_sinh_ca_ho_khau_HN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số thanh niên tình nguyện </label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tuyen_sinh_thanh_nien') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tuyen_sinh_thanh_nien">
                                            @error('tong_tuyen_sinh_thanh_nien')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng thanh niên tình nguyện
                                            nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_thanh_nien_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_thanh_nien_nu">
                                            @error('tuyen_sinh_thanh_nien_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng thanh niên tình nguyện hộ khẩu
                                            Hà
                                            nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tuyen_sinh_thanh_nien_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tuyen_sinh_thanh_nien_ho_khau_HN">
                                            @error('tuyen_sinh_thanh_nien_ho_khau_HN')
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
                <div class="m-portlet m-portlet--mobile m-portlet--body-progress-trinhdo h-100">
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
                                        <label class="col-lg-5 col-form-label">Tổng số bộ đội xuất ngũ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep_bo_doi') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep_bo_doi">
                                            @error('tong_tot_nghiep_bo_doi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng bộ đội xuất ngũ nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_nghiep_bo_doi_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_nghiep_bo_doi_nu">
                                            @error('tong_nghiep_bo_doi_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng bộ đội xuất ngũ hộ khẩu Hà
                                            Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_nghiep_bo_doi_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_nghiep_bo_doi_ho_khau_HN">
                                            @error('tong_nghiep_bo_doi_ho_khau_HN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số CA hoàn thành nghĩa vụ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep_ca') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep_ca">
                                            @error('tong_tot_nghiep_ca')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng CA hoàn thành nghĩa vụ
                                            nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_ca_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tot_nghiep_ca_nu">
                                            @error('tot_nghiep_ca_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng CA hoàn thành nghĩa vụ hộ khẩu
                                            Hà
                                            Nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_ca_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tot_nghiep_ca_ho_khau_HN">
                                            @error('tot_nghiep_ca_ho_khau_HN')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Tổng số thanh niên tình nguyện </label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tong_tot_nghiep_thanh_nien') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tong_tot_nghiep_thanh_nien">
                                            @error('tong_tot_nghiep_thanh_nien')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng thanh niên tình nguyện
                                            nữ</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_thanh_nien_nu') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tot_nghiep_thanh_nien_nu">
                                            @error('tot_nghiep_thanh_nien_nu')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-lg-5 col-form-label">Số lượng thanh niên tình nguyện hộ khẩu
                                            Hà
                                            nội</label>
                                        <div class="col-lg-7">
                                            <input type="number" value="{{ old('tot_nghiep_thanh_nien_ho_khau_HN') }}"  class="form-control m-input"
                                                placeholder="Nhập vào số" name="tot_nghiep_thanh_nien_ho_khau_HN">
                                            @error('tot_nghiep_thanh_nien_ho_khau_HN')
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
        @if (session('thongbao'))
        <div class="thongbao" style="color: red; text-align: center;">
            {{session('thongbao')}}
        </div>
        @endif

        <div class="d-flex justify-content-end">
            <div class="col-lg-1 ">
                <a href="{{route('nhapbc.dao-tao-thanh-nien.index')}}" class="btn btn-danger">Hủy</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    var routeCheck = "{{ route('nhapbc.dao-tao-thanh-nien.check_so_lieu') }}";
    var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
    $(document).ready(function() {
    $('#co_so_dao_tao').select2();
    $('#ma_nganh_nghe').select2();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('dao_tao_nghe_thanh_nien/dao_tao_nghe_thanh_nien.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection