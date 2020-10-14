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
                                Ghi nhận phản hồi
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="col-4 offset-4">
                                <img src="{{asset('images/checkmark.png')}}" class="img-thumbnail ho-tro-image__thankyou">
                            </div>
                            <h2>Yêu cầu của bạn đã được hệ thống ghi nhận và thông báo tới các Chuyên Viên, chúng tôi sẽ phản hồi sớm nhất có thể!</h2>
                            <h3>Cảm ơn bạn!</h3>
                            <a href="{{route('login')}}" class="btn btn-primary">Quay lại</a>
                        </div>
                    </div>

                </div>
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