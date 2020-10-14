@extends('layouts.admin')
@section('title', "Đợt")
@section('content')

<div class="container">
    <form action="{{route('nhapdot.createSubmit.new')}}" id="validate-form" method="post">
     @csrf
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Thêm mới đợt
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row col-12">
                    <div class="col-md-4 ml-2">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Tên đợt</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="text" name="ten_dot" 
                                        placeholder="Tên đợt" class="form-control">
                            
                                </div>
                                @error('ten_dot')
                                <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12">
                    <div class="col-md-4 mr-5">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Thời gian bắt đầu</label>
                            <div class="col-lg-8">
                                <div class="input-group date datepicker">
                                    <input type="text" name="time_start" 
                                        placeholder="Ngày-tháng-năm" class="form-control">
                                    <div class="input-group-addon form-control col-2 d-flex justify-content-center align-items-center">
                                        <span><i class="flaticon-calendar-2"></i></span>
                                    </div>
                                </div>
                                @error('time_start')
                                <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 ml-5">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-4 col-form-label">Thời gian kết thúc</label>
                            <div class="col-lg-8">
                                <div class="input-group date datepicker">
                                    <input type="text" name="time_end" 
                                        placeholder="Ngày-tháng-năm" class="form-control">
                                    <div class="input-group-addon form-control col-2 d-flex justify-content-center align-items-center">
                                        <span><i class="flaticon-calendar-2"></i></span>
                                    </div>
                                </div>
                                @error('time_end')
                                <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-md-8">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Mô tả</label>
                            <div class="col-lg-8">
                                <textarea class="form-control m-input"  placeholder="Nhập vào số"
                                    name="mo_ta">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-end">
        <div class="col-lg-1 ">
            <a href="{{route('view-index-dot')}}" class="btn btn-danger">Hủy</a>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </div>
</form>

@error('checkTime')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

</div>
@endsection

{{-- @section('style')

@endsection --}}
@section('script')
<script>   
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    }
});
</script>
@endsection