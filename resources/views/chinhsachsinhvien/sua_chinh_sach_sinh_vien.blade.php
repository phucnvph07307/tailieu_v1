@extends('layouts.admin')
@section('title', "Cập nhật chính sách sinh viên")
@section('style')

<style>
    .batbuoc {
        color: red;
    }

    .error {
        color: red;
    }

    table input {
        border: 1px solid #000 !important;
    }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
    <form id="validate-form-update" action="{{route('xuatbc.post-sua-chinh-sach-sinh-vien', ['id' => $data->id])}}"
        method="POST" class="m-form">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chính sách sinh viên <small>Cập nhật Số Liệu</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div class="m-form__section m-form__section--first">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở đào tạo</label>
                                <div class="col-lg-8">
                                    <select name="co_so_id" class="form-control" id="co_so_id" disabled>
                                        <option value="" selected>{{$data->ten}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select name="nam" class="form-control " name="nam" disabled>
                                        <option value="" selected>{{$data->nam}} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Chính sách
                                </label>
                                <div class="col-lg-8">
                                    <select name="chinh_sach_id" class="form-control" name="chinh_sach_id" disabled>
                                        <option value="" selected>{{$data->ten_chinh_sach}} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt
                                </label>
                                <div class="col-lg-8">
                                    <select name="dot" class="form-control" name="dot" disabled>
                                        <option value="" selected>{{$data->dot}} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                <table class="table m-table m-table--head-bg-brand" id="remove-boder">
                    <thead>
                        <tr>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Cao đẳng</th>
                            <th scope="col">Trung cấp</th>

                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>Số Lượng Sinh Viên</td>
                            <td><input class="form-control name-field" min="0" name="so_hssv_CD" type="number"
                                    value="{{$data->so_hssv_CD}}">

                                @error('so_hssv_CD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </td>
                            <td><input class="form-control name-field" min="0" name="so_hssv_TC" type="number"
                                    value="{{$data->so_hssv_TC}}">

                                @error('so_hssv_TC')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><label id="so_hssv_CD-error" class="error" for="so_hssv_CD"></label></td>
                            <td><label id="so_hssv_TC-error" class="error" for="so_hssv_TC" style=""></label></td>
                        </tr>

                        <tr>
                            <td>Kinh phí</td>
                            <td><input class="form-control name-field" min="0" name="kinh_phi_CD" type="number"
                                    value="{{$data->kinh_phi_CD}}">

                                @error('kinh_phi_CD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </td>
                            <td><input class="form-control name-field" min="0" name="kinh_phi_TC" type="number"
                                    value="{{$data->kinh_phi_TC}}">

                                @error('kinh_phi_TC')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td><label id="kinh_phi_CD-error" class="error" for="kinh_phi_CD"></label></td>
                            <td><label id="kinh_phi_TC-error" class="error" for="kinh_phi_TC"></label></td>
                        </tr>


                    </tbody>
                </table>
            </div>


        </div>
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Tổng số
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <table class="table m-table m-table--head-bg-brand" id="remove-boder">
                        <thead>
                            <tr>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Trong đó</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tổng số lượng sinh viên</td>
                                <td><input name="tong_so_hssv" type="number" min="0" class="form-control name-field"
                                        value="{{$data->tong_so_hssv}}">

                                    @error('tong_so_hssv')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </td>
                            </tr>
                            <tr>
                                <td>Tổng kinh phí</td>
                                <td><input name="kinh_phi" type="number" min="0" class="form-control name-field"
                                        value="{{$data->kinh_phi}}">

                                    @error('kinh_phi')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </td>
                            </tr>
                            <tr>
                                <td>Ghi chú</td>
                                <td>
                                    <textarea class="form-control" name="ghi_chu" rows="3"
                                        style="border: 1px solid #000000">{{$data->ghi_chu}}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end pb-5">

                <a style="color: white" href="{{route('xuatbc.tong-hop-chinh-sach-sinh-vien')}}"><button type="button"
                        class="btn btn-danger mr-5">Hủy</button></a>
                @if ($data->trang_thai >= 3)
                @else
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                @endif

            </div>
        </div>
    </form>

</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
    $('#co_so_id').select2(); 
    $('#chinhsach').select2();
    $('#nam').select2();
    $('#dot').select2();
});
$("#page-size").change(function() {
    $("#page_size_hide").val($('#page-size').val())
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('page_size', $("#page_size_hide").val());
    url.search = search_params.toString();
    var new_url = url.toString();
    window.location.href = new_url
});
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-update-cssv.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
@if (session('thongbao'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Cập nhật thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@endsection