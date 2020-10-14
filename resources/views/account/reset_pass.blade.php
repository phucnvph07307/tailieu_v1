<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<title>Thiết lập mật khẩu</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
	</script>

	<!--end::Web font -->

	<!--begin:: Global Mandatory Vendors -->
	<link href="{!! asset('vendors/vendors/fontawesome5/css/all.min.css') !!}" rel="stylesheet" type="text/css" />

	<!--end:: Global Optional Vendors -->

	<!--begin::Global Theme Styles -->
	<link href="{!! asset('assets/demo/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />

	<!--RTL version:<link href="{!! asset('assets/demo/base/style.bundle.rtl.css') !!}" rel="stylesheet" type="text/css" />-->

	<!--end::Global Theme Styles -->
	<link rel="shortcut icon" href="{!! asset('assets/demo/media/img/logo/favicon.ico') !!}" />
	<style>
		.error {
			color: red !important;
		}
	</style>
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
	class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin"
			id="m_login">
			<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
				<div class="m-stack m-stack--hor m-stack--desktop">
					<div class="m-stack__item m-stack__item--fluid">
						<div class="m-login__wrapper">
							<div class="m-login__logo">
								<a href="#">
									<img src="{!! asset('assets/app/media/img/logos/logo-2.png') !!}">
								</a>
							</div>
							<div class="m-login__signin">
								<div class="m-login__head">
									<h3 class="m-login__title">Thiết lập mật khẩu</h3>
								</div>
								<form onsubmit="return validateForm()" class="m-login__form m-form" action=""
									method="post">
									{{ csrf_field() }}
									<div class="form-group m-form__group">
										<input id="password" class="form-control m-input" type="password"
											placeholder="Mật khẩu mới" name="password" autocomplete="off">
										<label id="password-error" class="error" for="password"></label>
									</div>
									<div class="form-group m-form__group">
										<input id="password_confirm"
											class="form-control m-input m-login__form-input--last" type="password"
											placeholder="Nhập lại mật khẩu" name="password_confirm">
										<label id="password_confirm-error" class="error" for="password_confirm"></label>
									</div>
									@if (session('thongbao'))
									<div class="thongbao" style="color: red">
										{{session('thongbao')}}
									</div>
									@endif
									<div class="thongbao1" style="color: red">
										{{session('thongbao')}}
									</div>
									<div class="row m-login__form-sub">
									</div>
									<div class="m-login__form-action">
										<button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Thay
											đổi mật khẩu</button>
										<!-- <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Sign In</button> -->
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="m-stack__item m-stack__item--center">
						<!-- 		<div class="m-login__account">
								<span class="m-login__account-msg">
									Don't have an account yet ?
								</span>&nbsp;&nbsp;
								<a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">Sign Up</a>
							</div> -->
					</div>
				</div>
			</div>
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center"
				style="background-image: url(assets/app/media/img//bg/bg-4.jpg)">
				<div class="m-grid__item">
					<h3 class="m-login__welcome">Join Our Community</h3>
					<p class="m-login__msg">
						Lorem ipsum dolor sit amet, coectetuer adipiscing<br>elit sed diam nonummy et nibh euismod
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- end:: Page -->

	<!--begin:: Global Mandatory Vendors -->
	<script src="{!! asset('vendors/jquery/dist/jquery.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/popper.js/dist/umd/popper.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap/dist/js/bootstrap.min.js') !!}" type="text/javascript"></script>

	<!--end:: Global Mandatory Vendors -->

	<!--begin:: Global Optional Vendors -->
	<script src="{!! asset('vendors/jquery.repeater/src/lib.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery.repeater/src/jquery.input.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery.repeater/src/repeater.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery-form/dist/jquery.form.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/block-ui/jquery.blockUI.js') !!}" type="text/javascript"></script>

	<!--end::Global Theme Bundle -->

	<!--begin::Page Scripts -->
	<script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>
	<script type="text/javascript">
		function validateForm()
{
				var re = /^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,30}$/;
				var check = re.test($("#password").val())
				if($("#password").val()==""){
					$("#password-error").html("Mật khẩu không được để rỗng")
					return false;
				}
				else if(!check){
					$("#password-error").html("Mật khẩu phải từ 6 đến 30 ký tự chứa ít nhất chữ 1 chữ thường và 1 chữ số")
					return false;
				}
				else if($("#password").val()!=$("#password_confirm").val()){
					$("#password-error").html("")
					$("#password_confirm-error").html("Mật khẩu bạn nhập lại không khớp nhau")
					return false;
				}
				else{
					$("#password_confirm-error").html("")
					return true;
				}
				return true;
}
	</script>
	<!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>