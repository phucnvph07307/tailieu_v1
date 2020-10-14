@extends('layouts.admin')
@section('title', "Sửa tài khoản")
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
                                Chỉnh sửa tài khoản
                            </h3>


                        </div>


                    </div>
                    <div class="m-portlet__head-caption " style="width:400px">

                        @if (session('thongbao'))
                        <div class="thongbao" style="color: green; text-align: center;">

                            <h4 class="m-portlet__head-text text-success">
                                {{session('thongbao')}}
                            </h4>
                        </div>
                        @endif

                    </div>
                </div>


                <!--begin::Form-->
                <form id="validate-form-update" class="m-form m-form--fit m-form--label-align-left"
                    action="{{ route('account.update') }}" method="POST">
                    <div class="m-portlet__body">

                        {{ csrf_field() }}

                        <input class="form-control m-input" type="hidden" name="id" value="{{ $user->id }}">




                        <div class="form-group m-form__group row">
                            <label class="col-4 col-form-label">Họ và tên</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" name="name" value="{{ $user->name }}"
                                    placeholder="Nhập Họ và Tên">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-4 col-form-label">Số điện thoại</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" name="phone"
                                    value="{{ $user->phone_number }}" placeholder="Nhập Số điện thoại">
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- 16/06/2020 - Th  --}}
                        <div class="form-group m-form__group row">
                            <label class="col-4 col-form-label">Phân Quyền: </label>
                            <div class="col-6">
                                <select class="form-control m-input" name="role">
                                    @foreach ($data as $role)
                                    <option 
                                        {{ ($role->id == $user->role_id) ?   'selected' : '' }}
                                        value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            @if ($user->co_so_dao_tao_id)
                            <label class="col-4 col-form-label">Cơ sở: </label>
                            <div class="col-6">
                                <select class="form-control m-input" name="co_so_dao_tao_id">
                                    @foreach ($co_so as $item)
                                    <option 
                                        {{ ($item->id == $user->co_so_dao_tao_id) ?   'selected' : '' }}
                                        value="{{ $item->id }}">
                                        {{ $item->ten }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">

                                <div class="col-12 d-flex justify-content-center">

                                    <a href="{{ route('account.list') }}" class="btn btn-danger">Hủy</a>&nbsp&nbsp&nbsp
                                    <button type="submit" class="btn btn-success">Update</button>
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
        $("#validate-form-update").validate({
            rules: {
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
                    maxlength: 30,
                    remote: {
			    		headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
				        url: "{{ route('account.check-name') }}",
				        type: "post",
				        data: {
				        	_token: '{{csrf_token()}}',
				            name: function() {
				                return $( "input[name='name']" ).val();
				            }
				        }
				    }
                }
            },
            messages: {
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
                    maxlength: "Họ tên không được vượt quá 40 ký tự",
                    remote: "Họ và tên không hợp lệ"
                }
                
            }
        });
    });
</script>

@endsection