@extends('layouts.admin')
@section('title', "Tạo kết quả tốt nghiệp")

@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                               Tạo kết quả tốt nghiệp
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-left">
                    <div class="m-portlet__body">
                 
                  
                        <div class="form-group m-form__group row">
                            <label for="example-search-input" class="col-4 col-form-label">Mã ngành nghề</label>
                            <div class="col-6">
                            <select class="form-control m-input">
                                <option>MH1</option>
                                <option>DK2</option>
                                <option>LF3</option>
                                <option>GH4</option>
                                <option>ON5</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Tên cơ sở</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Loại hình</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Số SV nhập học đầu khóa trình độ cao đẳng</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Số SV đủ điều kiện thi, xét tốt nghiệp trình độ cao đẳng</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Số SV tốt nghiệp trình độ cao đẳng</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Số SV tốt nghiệp dân tộc thiểu số trình độ cao đẳng</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label  class="col-4 col-form-label">Số SV tốt nghiệp Hộ khẩu Hà Nội trình độ cao đẳng</label>
                            <div class="col-6">
                                <input class="form-control m-input" type="text" >
                            </div>
                        </div>
                
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                         
                                <div class="col-12 d-flex justify-content-center">
                                   
                                    <button type="reset" class="btn btn-danger">Hủy</button>&nbsp&nbsp&nbsp
                                    <button type="reset" class="btn btn-success">Thêm</button>
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