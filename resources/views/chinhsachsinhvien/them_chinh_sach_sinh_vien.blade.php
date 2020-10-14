@extends('layouts.admin')
@section('title', "Thêm chính sách sinh viên")
@section('style')

<style>
    .error {
        color: red;
    }

    .batbuoc {
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
    <form action="{{route('xuatbc.post-them-chinh-sach-sinh-vien')}}" method="POST" novalidate class="m-form"
        id="validate-form-add">
        @csrf
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chính sách sinh viên <small>Thêm Số Liệu</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở đào tạo <span class="batbuoc">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" name="co_so_id" onchange="getdatacheck(this)"
                                        id="co_so_id">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($coso as $item)
                                        <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @endforeach
                                    </select>
                                    @error('co_so_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label id="co_so_id-error" class="error" for="co_so_id"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm <span class="batbuoc">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select id="nam" class="form-control select2" onchange="getdatacheck(this)"
                                        name="nam">
                                        <option value="" selected>Chọn </option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option @if (isset($params['nam']))
                                            {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif value="{{$item}}">
                                            {{$item}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('nam')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label id="nam-error" class="error" for="nam"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Chính sách<span class="batbuoc">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" onchange="getdatacheck(this)"
                                        name="chinh_sach_id" id="chinh_sach_id">
                                        <option value="" selected>Chọn </option>
                                        @foreach ($chinhsach as $item)

                                        <option value="{{$item->id}}">{{$item->ten}}</option>
                                        @endforeach
                                    </select>

                                    @error('chinh_sach_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label id="chinh_sach_id-error" class="error" for="chinh_sach_id"></label>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt <span class="batbuoc">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <select class="form-control select2" onchange="getdatacheck(this)" name="dot"
                                        id="dot">
                                        <option value="" selected>Chọn</option>
                                        <option value="1">Đợt 1</option>
                                        <option value="2">Đợt 2</option>
                                    </select>

                                    @error('dot')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <label id="dot-error" class="error" for="dot"></label>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                @if (session('thongbao'))

                <div class="alert alert-success" role="alert">
                    <strong>{{session('thongbao')}}</strong>
                </div>
                @endif
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
                            <td><input class="form-control name-field" min="0" name="so_hssv_CD" type="number">
                                @error('so_hssv_CD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="so_hssv_TC" type="number">
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
                            <td><input class="form-control name-field" min="0" name="kinh_phi_CD" type="number">
                                @error('kinh_phi_CD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                            <td><input class="form-control name-field" min="0" name="kinh_phi_TC" type="number">
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
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h5 class="m-portlet__head-text">
                            Tổng số
                        </h5>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">

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
                            <td><input name="tong_so_hssv" type="number" min="0" class="form-control name-field">
                                @error('tong_so_hssv')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Tổng kinh phí</td>
                            <td><input name="kinh_phi" type="number" min="0" class="form-control name-field">
                                @error('kinh_phi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>Ghi chú</td>
                            <td>
                                <textarea class="form-control" name="ghi_chu" rows="3"
                                    style="border: 1px solid #000000"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-12 d-flex justify-content-end">
                    <a style="color: white" href="{{route('xuatbc.tong-hop-chinh-sach-sinh-vien')}}"><button
                            type="button" class="btn btn-danger mr-3">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script type="text/javascript">
    var routeCheck = "{{ route('xuatbc.check-ton-tai-chinh-sach-sinh-vien') }}";
    $(document).ready(function() {
    $('.select2').select2(); 
    
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-create-cssv.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
@endsection