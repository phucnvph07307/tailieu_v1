<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>404 - Không tìm thấy trang</title>
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
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-5" style="background-image: url({{asset('assets/app/media/img/error/bg5.jpg')}});">
        <div class="m-error_container">
					<span class="m-error_title">
						<h1>Rất tiếc!</h1>
					</span>
            <p class="m-error_subtitle">
                Trang bạn tìm kiếm không tồn tại.
            </p>
            <p class="m-error_description">
                Hãy kiểm tra lại đường dẫn của bạn.<br>
                Nếu vấn đề thực sự nghiêm trọng hãy tìm <br>
                sự trợ giúp thông qua hotline của cơ quan
                <br>Sở Lao Động - Thương Binh & Xã Hội Hà Nội.
            </p>
            <div class="container">
                <div class="row ">
                    <div class="col-8 offset-2 text-center">
                    @if(Auth::check())
                        <a href="{{route('dashboard')}}" class="btn btn-primary">Quay về trang chủ</a>
                    @else
                        <a href="{{route('login')}}" class="btn btn-primary">Đăng nhập lại</a>
                    @endif
                        &nbsp;
                        <a href="{{route('tu-van.gui-ho-tro')}}" class="btn btn-warning">Gửi yêu cầu hỗ trợ</a>
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
<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>