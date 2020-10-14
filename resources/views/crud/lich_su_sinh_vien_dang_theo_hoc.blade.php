@extends('layouts.admin')
@section('title', "Chi tiết số liệu học sinh sinh viên")
@section('style')
{{-- <link href="{!! asset('tuyensinh/css/chitiettuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
    .m-table.m-table--border-danger,
    .m-table.m-table--border-danger th,
    .m-table.m-table--border-danger td {
        border-color: #bcb1b1;
    }

    table thead th[colspan="4"] {
        border-bottom-width: 1px;
        border-bottom: 1px solid #bcb1b1 !important;
    }
</style>
@endsection
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
                        Chi tiết số liệu học sinh sinh viên
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <h3>Cơ sở đào tạo: {{$data_coso->ten}}</h3>
            <p>

            </p>
            <p>Địa chỉ: {{$data_coso->dia_chi}}</p>
            <p>Phường/Xã: {{$data_coso->ten_xa_phuong}}</p>
            <p>Quận/Huyện: {{$data_coso->ten_quan_huyen}}</p>
        </div>
    </div>
    <div class="m-portlet">

        <form action="" method="GET" class="m-form">
            {{-- <input type="hidden" name="page_size" value="{{$params['page_size']}}"> --}}
            <div class="m-portlet__body">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Năm: </label>
                                    <div class="col-lg-8">
                                        <select name="nam" class="form-control" id="nam">
                                            <option value="">Chọn </option>
                                            @foreach (config('common.nam.list') as $item)
                                            <option @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif
                                                value="{{$item}}"> {{$item}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Đợt: </label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="dot" id="dot">
                                            <option value="">Chọn</option>
                                            <option @if (isset($params['dot']))
                                                {{( $params['dot'] ==  1 ) ? 'selected' : ''}} @endif value="1">Đợt 1
                                            </option>
                                            <option value="2" @if (isset($params['dot']))
                                                {{( $params['dot'] ==  2 ) ? 'selected' : ''}} @endif>Đợt 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Ngành Nghề: </label>
                                    <div class="col-lg-8">
                                        <select name="nghe_id" class="form-control" id="nghe_id">
                                            <option value="">Chọn </option>
                                            @foreach ($nganhNghe as $item)
                                            <option @if(isset($params['nghe_id']) && $params['nghe_id']==$item->id)
                                                selected
                                                @endif value="{{ $item->id }}">{{$item->id}} - {{$item->ten_nganh_nghe}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
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
        <div class="m-portlet__body table-responsive">
            <table
                class="table table-bordered m-table m-table--border-danger m-table--head-bg-primary table-boder-white">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>

                        <th rowspan="2">Mã ngành nghề</th>
                        <th rowspan="2">Tên ngành nghề</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Tổng Số HSSV <br> Các Trình Độ</th>
                        <th colspan="3">Tổng Số</th>
                        <th colspan="4">Cao Đẳng</th>
                        <th colspan="4">Trung Cấp</th>
                        <th colspan="4">Sơ Cấp</th>
                        <th colspan="4">Khác</th>
                        @can('sua_so_luong_sinh_vien_dang_theo_hoc')
                        <th rowspan="2">Chức năng</th>
                        @endcan
                    </tr>
                    <tr class="pt-3 row2">
                        <th>Nữ</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Dân tộc thiểu số</th>
                        <th>Tổng số sinh viên theo học Cao Đẳng</th>
                        <th>Nữ</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Dân tộc thiểu số</th>
                        <th>Tổng số sinh viên theo học Trung Cấp</th>
                        <th>Nữ</th>
                        <th>Hộ khẩu Hà Nội</>
                        <th>Dân tộc thiểu số</th>
                        <th>Tổng số sinh viên theo học Sơ Cấp</th>
                        <th>Nữ</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Dân tộc thiểu số</th>
                        <th>Tổng số sinh viên theo học khác</th>
                        <th>Nữ</th>
                        <th>Hộ khẩu Hà Nội</th>
                        <th>Dân tộc thiểu số</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$item->nghe_id}}</td>
                        <td>{{$item->ten_nganh_nghe}}</td>
                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>
                        <td><b>{{$item->tong_so_HSSV_co_mat_cac_trinh_do}}</b></td>
                        <td>{{$item->tong_so_nu}}</td>
                        <td>{{$item->tong_so_ho_khau_HN}}</td>
                        <td>{{$item->tong_so_dan_toc_thieu_so}}</td>

                        <td><b>{{$item->so_luong_sv_Cao_dang}}</b></td>

                        <td>{{$item->so_luong_sv_nu_Cao_dang}}</td>
                        <td>{{$item->so_luong_sv_ho_khau_HN_Cao_dang}}</td>
                        <td>{{$item->so_luong_sv_dan_toc_Cao_dang}}</td>

                        <td><b>{{$item->so_luong_sv_Trung_cap}}</b></td>

                        <td>{{$item->so_luong_sv_nu_Trung_cap}}</td>
                        <td>{{$item->so_luong_sv_ho_khau_HN_Trung_cap}}</td>
                        <td>{{$item->so_luong_sv_dan_toc_Trung_cap}}</td>

                        <td><b>{{$item->so_luong_sv_So_cap}}</b></td>

                        <td>{{$item->so_luong_sv_nu_So_cap}}</td>
                        <td>{{$item->so_luong_sv_ho_khau_HN_So_cap}}</td>
                        <td>{{$item->so_luong_sv_dan_toc_So_cap}}</td>

                        <td><b>{{$item->so_luong_sv_he_khac}}</b></td>

                        <td>{{$item->so_luong_sv_nu_khac}}</td>
                        <td>{{$item->so_luong_sv_ho_khau_HN_khac}}</td>
                        <td>{{$item->so_luong_sv_dan_toc_khac}}</td>
                        @can('sua_so_luong_sinh_vien_dang_theo_hoc')
                        <td>
                            <a href="{{ route('xuatbc.sua-so-sv', ['id'=>$item->sv_id])}}"
                                class="btn btn-primary btn-sm">Cập nhật</a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row phantrang">
        {{$data->links()}}
    </div>
    <div>
        <a href="{{ route('xuatbc.ds-sv-dang-hoc')}}" class="btn btn-danger btn-sm justify-content-end">Quay Lại</a>
    </div>
</div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
@if (session('mess'))
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
<script>
    $(document).ready(function(){
    $('#nghe_id').select2();
    $('#co_so_id').select2();
    $('#nghe_cap_4').select2();
    });

    function setNameNganhNgheSearch(id) {
        var nganh_nghe = $('.nganh_nghe')
        for (let index = 0; index < nganh_nghe.length; index++) {
            $(nganh_nghe[index]).attr('name','')       
        }
        $(id).attr('name','nganh_nghe')
    }
</script>
@endsection