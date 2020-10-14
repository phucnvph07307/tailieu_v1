
@extends('layouts.admin')
@section('title', 'Chi tiết phân quyền tài khoản')
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết phân quyền tài khoản <small>Danh sách</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="GET" class="m-form">
            {{-- <input type="hidden" name="page_size" value="{{$params['page_size']}}"> --}}
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên Người Dùng: </label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Email: </label>
                                <div class="col-lg-8">
                                   <input class="form-control" type="email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>
                        <a href="" class="btn btn-success btn-sm">Thêm mới</a>
                    </th>
                </thead>

                    <tr>
                        <td>1</td>
                        <td>Thienth</td>
                        <td>thienth@fe.edu.vn</td>
                        <td>IT</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm">Sửa</a>

                        </td>
                    </tr>
                  
                </tbody>
            </table>
        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
          
        </div>
    </div>
</div>
@endsection