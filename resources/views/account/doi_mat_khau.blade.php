@extends('layouts.admin')
@section('title', "Đổi mật khẩu")
@section('style')
<style type="text/css">
	.error {
		color: red;
	}
</style>
@endsection
@section('content')
<div class="m-content">
	<div class="row">
		<div class="col-md-8 mx-auto">
			<!--begin::Portlet-->
			<div class="m-portlet m-portlet--tab">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
							</span>
							<h3 class="m-portlet__head-text">
								Đổi mật khẩu
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form id="validate-dangky" onsubmit="return validateForm()" method="post"
					action="" class="m-form m-form--fit m-form--label-align-right"
					enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Email</label>
							<div class="col-10">
								<input class="form-control m-input" type="text" placeholder="Nhập email"
									id="example-text-input" disabled name="email" value="{{$email}}">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-search-input" class="col-2 col-form-label">Mật khẩu cũ</label>
							<div class="col-10">
								<input id="password_old" class="form-control m-input" type="password"
									placeholder="Nhập mật khẩu cũ" name="password_old">
								<label id="password_old-error" class="error" for="password"></label>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-search-input" class="col-2 col-form-label">Mật khẩu</label>
							<div class="col-10">
								<input id="password" class="form-control m-input" type="password"
									placeholder="Nhập mật khẩu" name="password">
								<label id="password-error" class="error" for="password"></label>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-email-input" class="col-2 col-form-label">Nhập lại mật khẩu</label>
							<div class="col-10">
								<input class="form-control m-input" type="password" placeholder="Nhập lại mật khẩu"
									id="password_confirm" name="password_confirm">
								<label id="password_confirm-error" class="error" for="password_confirm"></label>
							</div>
						</div>
						@if (session('thongbao'))
						<div class="thongbao" style="color: green; text-align: center;">
							{{session('thongbao')}}
						</div>
						@endif
						@if (session('thongbaoloi'))
						<div class="thongbao" style="color: red; text-align: center;">
							{{session('thongbaoloi')}}
						</div>
						@endif
						@if ($errors->any())
						<ul class="col-md-10 mx-auto">
							@foreach ($errors->all() as $error)
							<li class="thongbao " style="color: red;">
								{{ $error }}
							</li>
							@endforeach
						</ul>
						@endif
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions">
							<div class="row">
								<div class="col-2">
								</div>
								<div class="col-10">
									<button type="submit" class="btn btn-success">Đổi mật khẩu</button>
									<!-- <button type="reset" class="btn btn-secondary">Hủy</button> -->
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<!--end::Portlet-->
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	function validateForm()
{
			var re = /^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,30}$/;
			var check = re.test($("#password").val())
			if($("#password_old").val()==""){
				$("#password_old-error").html("Mật khẩu cũ không được để rỗng")
				return false;
			}
			else if($("#password").val()==""){
				$("#password_old-error").html("")
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

@endsection