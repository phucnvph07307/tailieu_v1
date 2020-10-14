@extends('layouts.admin')
@section('title', "Cập nhật tài khoản")
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
								Cập nhật tài khoản
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form id="validate-capnhat" method="post" action=""
					class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Email</label>
							<div class="col-10">
								<input class="form-control m-input" disabled value="{{$user->email}}" type="text"
									placeholder="Nhập email" id="example-text-input" name="email">
							</div>
						</div>
						<input type="text" hidden name="id" value="{{ $user->id }}">
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Số điện thoại</label>
							<div class="col-10">
								<input class="form-control m-input" type="text" value="{{$user->phone_number}}"
									placeholder="Nhập số điện thoại" name="phone">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Họ và tên</label>
							<div class="col-10">
								<input class="form-control m-input" value="{{$user->name}}" type="text"
									placeholder="Vui lòng nhập họ tên" name="name">
							</div>
						</div>

						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Ảnh đại diên</label>
							<div class="col-10">
								<input onchange="showimages(this)" class="form-control m-input" type="file"
									name="avatar">
							</div>
						</div>
						<div class="img" style="text-align: center;">
							<img width="200px" id="showavatar" class="td_show-avatar" src="{!! asset('storage/'.$user->avatar) !!}">
						</div>
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Mật khẩu xác nhận</label>
							<div class="col-10">
								<input class="form-control m-input" type="password"
									placeholder="Vui lòng nhập mật khẩu để xác nhận" name="password">
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
						<ul class="col-md-5 mx-auto">
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
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-success">Cập nhật tài khoản</button>
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
    $(document).ready(function(){
        $('.td_show-avatar').each(function(){
            var avatarImgUrl = $(this).attr('src');
            SystemUtil.defaultImgUrl(avatarImgUrl, this, "{{  asset('images/avatardefault.png') }}");
        });
    })
	function showimages(element) {
            var file = element.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $('#showavatar').attr('src', reader.result);
                    // console.log('RESULT', reader.result)
                }
                reader.readAsDataURL(file);
            }
        
	$(document).ready(function() {
        $("#validate-capnhat").validate({
            rules: {
                email: {
                	required: true,
      				email: true,
			    	remote: {
			    		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
				        url: "{{ route('check-email') }}",
				        type: "post",
				        data: {
				        	_token: '{{csrf_token()}}',
				            name: function() {
				                return $( "input[name='email']" ).val();
				            },
							id: function() {
                                return $("input[name='id']").val();
                            }
				        }
				    }
                },
                phone:{
                	required: true,
      				number: true,
      				minlength:10,
      				maxlength:10,
  					remote: {
			    		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
				        url: "{{ route('check-phone') }}",
				        type: "post",
				        data: {
				        	_token: '{{csrf_token()}}',
				            name: function() {
				                return $( "input[name='phone']" ).val();
				            },
							id: function() {
                                return $("input[name='id']").val();
                            }
				        }
				    }
                },
                name: {
                    required: true,
                    minlength: 6,
                    maxlength: 30
                },
				avatar: {
                    extension: "jpg|png|jpeg|gif"
                },
				password: {
                    required: true,
                }
            },
            messages: {
                email: {
                	required: "Vui lòng nhập địa chỉ email",
                	email: "Vui lòng nhập đúng định dạng email",
                	remote: "Địa chỉ email đã tồn tại"
                },
                phone: {
                	required: "Vui lòng nhập số điện thoại",
                	number: "Vui lòng nhập số",
                	minlength: "Số điện thoại phải nhập 10 ký tự",
                    maxlength: "Số điện thoại phải nhập 10 ký tự",
                    remote: "Số điện thoại đã tồn tại"
                },
                name: {
                    required: "Vui lòng nhập họ tên",
                    minlength: "Họ tên ít nhất 6 ký tự",
                    maxlength: "Họ tên không được vượt quá 40 ký tự"
                },
                avatar: {
                    extension: "Hãy chọn file định dạng ảnh (jpg|png|jpeg|gif)"
                },
				password: {
                    required: "Vui lòng xác nhận mật khẩu",
                }
                
            }
        });
    });
</script>

@endsection