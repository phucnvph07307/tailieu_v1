@extends('layouts.admin')
@section('title', "Nhắn tin báo lỗi hệ thống")
@section('style')
@endsection
@section('content')
<div class="m-content">
<div class="m-portlet m-portlet--tab">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                <h3 class="m-portlet__head-text">
                    Nhắn tin báo lỗi hệ thống
                </h3>
            </div>
        </div>
    </div>

    <!--begin::Form-->
    <form action="{{route('tu-van.ho-tro')}}" method="post" id="tu-van-ho-tro-form" class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            @if(Session::has('result_status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                {{Session::get('result_status')}}
            </div>
        @endif
            @csrf
            <div class="form-group m-form__group row">
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

    <!--end::Form-->
</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tu-van-ho-tro-form').validate({
            rules:{
                tieu_de: {
                    required: true,
                    maxlength: 255
                },
                noi_dung: {
                    required: true
                }
            },
            messages:{
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
@endsection