@extends('layouts.admin')
@section('title', "Thêm kết quả hợp tát quốc tế")
@section('style')
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                       Thêm<small>kết quả hợp tác quốc tế</small>
                    </h3>
                </div>
            </div>
        </div>
    <form action="" method="get" class="m-form pt-5">
        <input type="hidden" name="page_size" value="20">
        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Tên đơn vị</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control " id="ten_don_vi">
                                    <option selected="" value="6">Chọn đơn vị</option>
                                    <option value="5">FU</option>
                                    <option selected="" value="6">Fpoly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Năm</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">Chọn năm</option>
                                    <option value="5">2018</option>
                                    <option selected="" value="6">2019</option>
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
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">1</option>
                                    <option value="5">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Trung cấp</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Sơ cấp</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Tổng số kết quả tuyển sinh theo chương trình đào tạo quốc tế</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
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
                                    <label class="col-lg-7 col-form-label">Số HS được các đơn vị / tổ chức nước ngoài hợp tác đào tạo cấp bằng</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Số HS được nhà trường cấp bằng theo hình thức hợp tác quốc tế</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Tổng số học sinh được cấp bằng tốt nghiệp</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
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
                                    <label class="col-lg-7 col-form-label">Số GV được đào tạo , bồi dưỡng , tập huấn</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Số cán bọ được đào tạo , bồi dưỡng , tập huấn</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Tổng số hợp tác quốc tế trong đào tạo , bồi dưỡng GV , CB</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
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
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Số nhà xưởng thực hành đầu từ</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-7 col-form-label">Tổng kinh phí đầu tư trang thiết bị , máy móc</label>
                                    <div class="col-lg-5">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
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
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-12 mb-3">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Số học sinh có việc làm sau khi tốt nghiệp chương trình hơp tác quốc tế</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Số học sinh được nhà trường cấp bằng theo hình thức hợp tác quốc tế</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-end">
        <div class="col-lg-1 ">
            <button type="submit" class="btn btn-danger">Hủy</button>
        </div>
        <div >
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </div>
</div>
    @endsection
    @section('script')
<script>
    $(document).ready(function() {
    $('#ten_don_vi').select2();
});
</script>

    @endsection
