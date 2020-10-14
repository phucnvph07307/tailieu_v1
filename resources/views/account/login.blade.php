
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
	<title>Đăng nhập</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!--end::Web font -->

	<!--begin:: Global Mandatory Vendors -->
	<link href="{!! asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css') !!}" rel="stylesheet"
		type="text/css" />

	<!--end:: Global Mandatory Vendors -->

	<!--begin:: Global Optional Vendors -->
	<link href="{!! asset('vendors/tether/dist/css/tether.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css') !!}"
		rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/bootstrap-daterangepicker/daterangepicker.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/bootstrap-select/dist/css/bootstrap-select.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/select2/dist/css/select2.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/nouislider/distribute/nouislider.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/owl.carousel/dist/assets/owl.carousel.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/owl.carousel/dist/assets/owl.theme.default.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/ion-rangeslider/css/ion.rangeSlider.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/dropzone/dist/dropzone.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/bootstrap-markdown/css/bootstrap-markdown.min.css') !!}" rel="stylesheet"
		type="text/css" />
	<link href="{!! asset('vendors/animate.css/animate.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/toastr/build/toastr.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/jstree/dist/themes/default/style.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/morris.js/morris.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/chartist/dist/chartist.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/sweetalert2/dist/sweetalert2.min.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/socicon/css/socicon.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/vendors/line-awesome/css/line-awesome.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/vendors/flaticon/css/flaticon.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/vendors/metronic/css/styles.css') !!}" rel="stylesheet" type="text/css" />
	<link href="{!! asset('vendors/vendors/fontawesome5/css/all.min.css') !!}" rel="stylesheet" type="text/css" />

	<!--end:: Global Optional Vendors -->

	<!--begin::Global Theme Styles -->
	<link href="{!! asset('assets/demo/base/style.bundle.css') !!}" rel="stylesheet" type="text/css" />

	<!--RTL version:<link href="{!! asset('assets/demo/base/style.bundle.rtl.css') !!}" rel="stylesheet" type="text/css" />-->

	<!--end::Global Theme Styles -->
	<link rel="shortcut icon" href="{!! asset('images/favicon.png') !!}" />
	<link rel="stylesheet" href="{!!asset('css/login.css')!!}" type="text/css"/>
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
									<img src="{!! asset('images/logo.png') !!}">
								</a>
							</div>
							<div class="m-login__signin">
								<div class="m-login__head">
									<h3 class="m-login__title">Đăng nhập</h3>
								</div>
								<form class="m-login__form m-form" action="{{ route('post_login') }}" method="post">
									{{ csrf_field() }}
									<div class="form-group m-form__group">
										<input class="form-control m-input" type="text"
											placeholder="Số điện thoại hoặc email" name="phone" autocomplete="off">
									</div>
									<div class="form-group m-form__group">
										<input class="form-control m-input m-login__form-input--last" type="password"
											placeholder="Mật khẩu" name="password">
									</div>
									@if (session('thongbao'))
									<div class="thongbao" style="color: red">
										{{session('thongbao')}}
									</div>
									@endif
									@if (session('success'))
									<div class="thongbao" style="color: green">
										{{session('success')}}
									</div>
									@endif
									<div class="row m-login__form-sub">
										<div class="col m--align-left">
											<label class="m-checkbox m-checkbox--focus">
												<input type="checkbox" name="remember"> Ghi nhớ đăng nhập
												<span></span>
											</label>
										</div>
										<div class="col m--align-right">
											<a href="javascript:;" id="m_login_forget_password" class="m-link">Quên mật
												khẩu ?</a>
										</div>
									</div>
									<div class="m-login__form-action">
										<button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Đăng
											nhập</button>
										<!-- <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Sign In</button> -->
									</div>
								</form>
							</div>
							<div class="m-login__signup">
								<div class="m-login__head">
									<h3 class="m-login__title">Sign Up</h3>
									<div class="m-login__desc">Enter your details to create your account:</div>
								</div>
								<form class="m-login__form m-form" action="">
									<div class="form-group m-form__group">
										<input class="form-control m-input" type="text" placeholder="Fullname"
											name="fullname">
									</div>
									<div class="form-group m-form__group">
										<input class="form-control m-input" type="text" placeholder="Email" name="email"
											autocomplete="off">
									</div>
									<div class="form-group m-form__group">
										<input class="form-control m-input" type="password" placeholder="Password"
											name="password">
									</div>
									<div class="form-group m-form__group">
										<input class="form-control m-input m-login__form-input--last" type="password"
											placeholder="Confirm Password" name="rpassword">
									</div>
									<div class="row form-group m-form__group m-login__form-sub">
										<div class="col m--align-left">
											<label class="m-checkbox m-checkbox--focus">
												<input type="checkbox" name="agree"> I Agree the <a href="#"
													class="m-link m-link--focus">terms and conditions</a>.
												<span></span>
											</label>
											<span class="m-form__help"></span>
										</div>
									</div>
									<div class="m-login__form-action">
										<button id="m_login_signup_submit"
											class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Sign
											Up</button>
										<button id="m_login_signup_cancel"
											class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">Cancel</button>
									</div>
								</form>
							</div>
							<div class="m-login__forget-password">
								<div class="m-login__head">
									<h3 class="m-login__title">Đã quên mật khẩu ?</h3>
									<div class="m-login__desc">Nhập email của bạn để thiết lập lại mật khẩu của bạn:
									</div>
								</div>
								<div id="thongbaothanhcong" style="margin-top: 20px; color: green"></div>
								<form class="m-login__form m-form" method="post" action="">
									{{ csrf_field() }}
									<div class="form-group m-form__group">
										<input class="form-control m-input" type="text" placeholder="Email" name="email"
											id="m_email" autocomplete="off">
									</div>
									<div id="thongbaoloi" style="margin-top: 20px; color: red"></div>
									<div class="m-login__form-action">
										<div id="" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air"
											onclick="forgot_pass()">Yêu cầu</div>
										<button id="m_login_forget_password_cancel"
											class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">Hủy
											bỏ</button>
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
				<div class="m-stack__item m-stack__item--center">
					<div class="m-login__account">
								<span class="m-login__account-msg">
									Thiết kế bởi
								</span>
						<a href="http://caodang.fpt.edu.vn/" id="m_login_signup" class="m-link m-link--focus m-login__account-link">Cao đẳng FPT Polytechnic</a>
					</div>
				</div>
			</div>
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center d-none d-xl-block"
				style="background-image: url({!! asset('images/login-img.png') !!});background-size: 100% 100%;">
				{{-- background-image: url({!! asset('storage/images/login-img.png') !!});background-size: cover; --}}
				{{-- <div class="m-grid__item">
					<h3 class="m-login__welcome">Join Our Community</h3>
					<p class="m-login__msg">
						Lorem ipsum dolor sit amet, coectetuer adipiscing<br>elit sed diam nonummy et nibh euismod
					</p>
				</div> --}}
			</div>
		</div>
	</div>
	<div class="yeu-cau-ho-tro">
		<a class="" href="{{route('tu-van.gui-ho-tro')}}">Hỗ trợ, tư vấn!</a>
		{{--<a href="">Hỗ trợ, tư vấn!</a>--}}
	</div>

	<!-- end:: Page -->

	<!--begin:: Global Mandatory Vendors -->
	<script src="{!! asset('vendors/jquery/dist/jquery.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/popper.js/dist/umd/popper.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap/dist/js/bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js-cookie/src/js.cookie.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/moment/min/moment.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/tooltip.js/dist/umd/tooltip.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/wnumb/wNumb.js') !!}" type="text/javascript"></script>

	<!--end:: Global Mandatory Vendors -->

	<!--begin:: Global Optional Vendors -->
	<script src="{!! asset('vendors/jquery.repeater/src/lib.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery.repeater/src/jquery.input.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery.repeater/src/repeater.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery-form/dist/jquery.form.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/block-ui/jquery.blockUI.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/bootstrap-datepicker.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}" type="text/javascript">
	</script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/bootstrap-timepicker.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-daterangepicker/daterangepicker.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-maxlength/src/bootstrap-maxlength.js') !!}" type="text/javascript">
	</script>
	<script src="{!! asset('vendors/bootstrap-switch/dist/js/bootstrap-switch.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/bootstrap-switch.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-select/dist/js/bootstrap-select.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/select2/dist/js/select2.full.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/typeahead.js/dist/typeahead.bundle.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/handlebars/dist/handlebars.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/inputmask/dist/jquery.inputmask.bundle.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/inputmask/dist/inputmask/inputmask.date.extensions.js') !!}" type="text/javascript">
	</script>
	<script src="{!! asset('vendors/inputmask/dist/inputmask/inputmask.numeric.extensions.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/inputmask/dist/inputmask/inputmask.phone.extensions.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/nouislider/distribute/nouislider.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/owl.carousel/dist/owl.carousel.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/autosize/dist/autosize.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/clipboard/dist/clipboard.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/ion-rangeslider/js/ion.rangeSlider.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/dropzone/dist/dropzone.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/summernote/dist/summernote.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/markdown/lib/markdown.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-markdown/js/bootstrap-markdown.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/bootstrap-markdown.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery-validation/dist/jquery.validate.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jquery-validation/dist/additional-methods.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/forms/jquery-validation.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/bootstrap-notify/bootstrap-notify.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/base/bootstrap-notify.init.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/toastr/build/toastr.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/jstree/dist/jstree.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/raphael/raphael.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/morris.js/morris.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/chartist/dist/chartist.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/chart.js/dist/Chart.bundle.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/charts/chart.init.js') !!}" type="text/javascript">
	</script>
	<script src="{!! asset('vendors/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') !!}"
		type="text/javascript"></script>
	<script src="{!! asset('vendors/vendors/jquery-idletimer/idle-timer.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/waypoints/lib/jquery.waypoints.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/counterup/jquery.counterup.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/es6-promise-polyfill/promise.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/sweetalert2/dist/sweetalert2.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('vendors/js/framework/components/plugins/base/sweetalert2.init.js') !!}"
		type="text/javascript"></script>

	<!--end:: Global Optional Vendors -->

	<!--begin::Global Theme Bundle -->
	<script src="{!! asset('assets/demo/base/scripts.bundle.js') !!}" type="text/javascript"></script>

	<!--end::Global Theme Bundle -->

	<!--begin::Page Scripts -->
	<script src="{!! asset('assets/snippets/custom/pages/user/login.js') !!}" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<!--end::Page Scripts -->
	<script type="text/javascript">
		function forgot_pass(){
				// alert($("#m_email").val());
				axios.post('/quen-mat-khau-gui-mail', {
				    email: $("#m_email").val(),
				  })
		  .then(function (response) {
		  	$("#thongbaoloi").html("")
		   $("#thongbaothanhcong").html("")
		   $("#thongbaoloi").html(response.data.thongbaoloi)
		   $("#thongbaothanhcong").html(response.data.thongbaothanhcong)
		  })
		  .catch(function (error) {
		    console.log(error);
		  });
			}
			
	</script>
</body>

<!-- end::Body -->

</html>