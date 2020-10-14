@extends('layouts.admin')
@section('title', "Đăng kí tài khoản")
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
								Đăng ký tài khoản mới
							</h3>
						</div>
					</div>
				</div>

				<!--begin::Form-->
				<form id="validate-dangky" method="post" action="{{ route('account.tao-tk') }}"
					class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Email</label>
							<div class="col-10">
								<input class="form-control m-input" type="text" placeholder="Nhập email"
									id="example-text-input" name="email" value="{{ old('email') }}">
								@error('email')
								<li class="thongbao " style="color: red;">
									{{ $message }}
								</li>
								@enderror
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Số điện thoại</label>
							<div class="col-10">
								<input class="form-control m-input" type="text" placeholder="Nhập số điện thoại"
									name="phone" value="{{ old('phone') }}">
								@error('phone')
								<li class="thongbao " style="color: red;">
									{{ $message }}
								</li>
								@enderror
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="example-text-input" class="col-2 col-form-label">Họ và tên</label>
							<div class="col-10">
								<input class="form-control m-input" type="text" placeholder="Vui lòng nhập họ tên"
									name="name" value="{{ old('name') }}">
								@error('name')
								<li class="thongbao " style="color: red;">
									{{ $message }}
								</li>
								@enderror
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label for="" class="col-2 col-form-label">Phân quyền</label>
							<div class="col-10">
								<select class="form-control m-input" name="role" id="">
										<option value="" >-----Chọn quyền-----</option>
                                    	@foreach ($user as $item)
											<option {{ old('role') == $item->id ? 'selected' : '' }}
											class="form-control" value="{{$item->id}}">{{$item->name}}</option>
                                       	@endforeach
								</select>
								@error('role')
								<li class="thongbao " style="color: red;">
									{{ $message }}
								</li>
								@enderror
							</div>
						</div>


						<div class="form-group m-form__group row">
							<div class="col-4">
							</div>
							<div class="col-6">
								<table>
									<tr>
										<td><input type="radio" checked name="can_bo"
											id="target_show_1"> <label for="">Cán bộ</label><br></td>
										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td><input type="radio"
											id="target_show_2"> <label for="">Cở sở</label><br></td>
									</tr>
								</table>
							</div>
							
						</div>
						<div class="form-group m-form__group row">
							<div class="col-2"></div>
							<div class="col-10 ">
								<div class="show_co_so"  style="display: none">
									<select name="co_so_dao_tao_id" class="form-control" id="co_so_dao_tao_id">
										<option value="">-----Chọn cơ sở-----</option>
										@foreach ($co_so as $item)
										<option 
										{{ old('co_so_dao_tao_id') == $item->id ? 'selected' : '' }}
										value="{{ $item->id }}">
											{{ $item->ten }}
										</option>
										@endforeach
									</select>
									@error('co_so_dao_tao_id')
									<li class="thongbao " style="color: red;">
										{{ $message }}
									</li>
									@enderror

								</div>
							</div>
						</div>

						@if (session('thongbao'))
						<div class="thongbao" style="color: green; text-align: center;">
							{{session('thongbao')}}
						</div>
						@endif
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions">
							<div class="row">
								<div class="col-12 text-center">
									<button type="submit" class="btn btn-success">Đăng ký tài khoản</button>
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
	$(document).ready(function() {
        $("#validate-dangky").validate({
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
				            }
				        }
				    }
                },
                name: {
                    required: true,
                    minlength: 6,
                    maxlength: 30
				},
				role: {
					required: true
				},
				co_so_dao_tao_id: {
					required: true
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
				role: {
                    required: "Vui lòng chọn quyền"
				},
				co_so_dao_tao_id: {
                    required: "Vui lòng chọn cơ sở đào tạo"
                }
				
                
            }
		});
		
		$('#target_show_1').on('click', function(){
			if($(this).is(':checked')){
				$('.show_co_so').css("display", "none");
				$('.co_so_dao_tao_id').attr("name", "change_co_so_id");
				document.getElementById("target_show_2").checked = false;
			}
		});
		$('#target_show_2').on('click', function(){
			if($(this).is(':checked')){
				$('.show_co_so').css("display", "block");
				$('.co_so_dao_tao_id').attr("name", "co_so_dao_tao_id");
				document.getElementById("target_show_1").checked = false;
			}
		});
		$('.select2').select2();
    });
</script>
@error('co_so_dao_tao_id')
<script>
	document.getElementById("target_show_1").checked = false;
	document.getElementById("target_show_2").checked = true;
	$('.show_co_so').css("display", "block");
</script>
@enderror
@endsection