<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Tư vấn - Yêu cầu</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!--end::Web font -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!--begin::Global Theme Styles -->
    <link href="{!! asset('assets/vendors/base/vendors.bundle.css') !!}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{!! asset('assets/demo/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{!! asset('css/main.css') !!}">
    <!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="{!! asset('images/favicon.png') !!}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-1" style="background-image: url({!! asset('assets/app/media/img//error/bg1.jpg') !!});">
        <div class="container">
            <div class="m-portlet tu-van-ho-tro-portlet m--margin-top-100">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <img src="{!! asset('images/favicon.png') !!}" class="yeu-cau-ho-tro-quoc-huy">
                                Yêu cầu hỗ trợ
                            </h3>
                        </div>
                    </div>
                </div>
                <form action="{{route('tu-van.submit-ho-tro')}}" method="post" id="tu-van-ho-tro-form" class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        @csrf
                        <div class="form-group m-form__group row">

                            <div class="col-md-6">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <label for="">Họ và tên<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input" value="{{old('ten_nguoi_gui')}}" name="ten_nguoi_gui" placeholder="Nhập họ và tên">
                                    @error('ten_nguoi_gui')
                                    <label id="ten_nguoi_gui-error" class="error" for="ten_nguoi_gui">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="offset-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <label for="">Địa chỉ email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input" value="{{old('email_nguoi_gui')}}" name="email_nguoi_gui" placeholder="Nhập địa chỉ email">
                                    @error('email_nguoi_gui')
                                    <label id="email_nguoi_gui-error" class="error" for="email_nguoi_gui">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <label for="">Số điện thoại liên lạc<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input" value="{{old('so_dien_thoai_nguoi_gui')}}" name="so_dien_thoai_nguoi_gui" placeholder="Nhập số điện thoại">
                                    @error('so_dien_thoai_nguoi_gui')
                                    <label id="so_dien_thoai_nguoi_gui-error" class="error" for="so_dien_thoai_nguoi_gui">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <label for="">Tiêu đề<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input" value="{{old('tieu_de')}}" name="tieu_de" placeholder="Nhập tiêu đề yêu cầu">
                                    @error('tieu_de')
                                    <label id="tieu_de-error" class="error" for="tieu_de">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <label for="">Nội dung<span class="text-danger">*</span></label>
                                    <textarea name="noi_dung" rows="10" class="form-control m-input">{{old('noi_dung')}}</textarea>
                                    @error('noi_dung')
                                    <label id="noi_dung-error" class="error" for="noi_dung">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-form__group m--margin-top-10 d-flex justify-content-end">
                                    <a href="{{route('login')}}" class="btn btn-danger">Hủy bỏ</a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-success">Gửi yêu cầu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!--begin::Global Theme Bundle -->
<script src="{!! asset('vendors/jquery/dist/jquery.js') !!}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{!! asset('assets/demo/base/scripts.bundle.js') !!}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tu-van-ho-tro-form').validate({
            rules:{
                ten_nguoi_gui: {
                    required: true,
                    maxlength: 255
                },
                email_nguoi_gui: {
                    required: true,
                    maxlength: 255,
                    email: true
                },
                so_dien_thoai_nguoi_gui: {
                    required: true,
                    number: true,
                    rangelength: [8, 10]
                },
                tieu_de: {
                    required: true,
                    maxlength: 255
                },
                noi_dung: {
                    required: true
                }
            },
            messages:{
                ten_nguoi_gui: {
                    required: "Hãy nhập họ và tên",
                    maxlength: "Độ dài vượt mức cho phép"
                },
                email_nguoi_gui: {
                    required: "Hãy nhập email",
                    maxlength: "Độ dài vượt mức cho phép",
                    email: "Không đúng định dạng email"
                },
                so_dien_thoai_nguoi_gui: {
                    required: "Hãy nhập số điện thoại",
                    number: "Không đúng định dạng số điện thoại",
                    rangelength: "Độ dài nằm trong khoảng 8-10 chữ số"
                },
                tieu_de: {
                    required: "Hãy nhập tiêu đề",
                    maxlength: "Độ dài vượt mức cho phép"
                },
                noi_dung: {
                    required: "Hãy nhập nội dung"
                }
            }
        })
    })
</script>
<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>