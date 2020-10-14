@extends('layouts.admin')
@section('title', 'Chi tiết kết quả tốt nghiệp đào tạo nghề gắn với doanh nghiệp')
@section('style')
<style>
    th {
        border-top: 1px solid #ffffff !important;
    }
</style>
@endsection
@section('content')

<div class="m-content container-fluid">
    <!-- Start info -->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết kết quả tốt nghiệp đào tạo nghề gắn với doanh nghiệp
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <h3>Cơ sở đào tạo: {{$co_so->ten}}</h3>
            <p>
                Loại hình cơ sở: {{$co_so->loai_hinh_co_so}}
            </p>
            <p>Địa chỉ: {{$co_so->dia_chi}}</p>
            <p>Phường/Xã: {{$co_so->ten_xa_phuong}}</p>
            <p>Quận/Huyện: {{$co_so->ten_quan_huyen}}</p>
        </div>
    </div>
    <!-- End info -->

    <!-- Start filter -->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">Bộ lọc</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <form action="" method="get" class="m-form">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Năm</label>
                                    <div class="col-lg-8">
                                        <select class="form-control select2" name="nam" id="nam">
                                            <option value="" selected>Chọn</option>
                                            @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                            <option @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif
                                                value="{{$item}}"> {{$item}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group m-form__group row">
                                    <label for="" class="col-lg-2 col-form-label">Đợt</label>
                                    <div class="col-lg-8">
                                        <select class="form-control select2" name="dot" id="dot">
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
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End filter -->

    <!-- Start content -->
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if (isset($params['page_size']))
                            {{( $params['page_size'] ==  $size ) ? 'selected' : ''}} @endif value="{{$size}}">{{$size}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="table table-bordered m-table m-table--head-bg-primary table-responsive">
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>


                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Tên nghề đào tạo</th>
                        <th colspan="9">Kết quả HSSV tốt nghiệp gắn với doanh nghiệp</th>
                        <th colspan="3">Kết quả giải quyết việc làm</th>
                        <th rowspan="2">Trạng thái</th>
                        @can('cap_nhat_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep')
                        <th rowspan="2">Thao tác</th>
                        @endcan
                    </tr>
                    <tr class="pt-3 row2">
                        <th>Tổng số HSSV tốt nghiệp</th>
                        <th>Nhập học đầu khóa Cao Đẳng</th>
                        <th>Số tốt nghiệp Cao đẳng</th>
                        <th>Nhập học đầu khóa Trung cấp</th>
                        <th>Số tốt nghiệp Trung cấp</th>
                        <th>Nhập học đầu khóa Sơ cấp</th>
                        <th>Số tốt nghiệp Sơ cấp </th>
                        <th>Nhập học đầu khóa dưới 3 tháng</th>
                        <th>Số tốt nghiệp dưới 3 tháng </th>

                        <th>Tên doanh nghiệp </th>
                        <th>Số HSSV được tuyển dụng sau tốt nghiệp</th>
                        <th>Mức lương doanh nghiệp trả cho HSSV</th>


                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1)
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i++}}</td>


                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>
                        <td>{{$item->nghe_id}} - {{$item->ten_nganh_nghe}}</td>
                        <td>{{$item->tong_HSSV_tot_nghiep}}</td>
                        <td>{{$item->nhap_hoc_dau_tot_nghiep_CD}}</td>
                        <td>{{$item->tot_nghiep_CD}}</td>
                        <td>{{$item->nhap_hoc_dau_tot_nghiep_TC}}</td>
                        <td>{{$item->tot_nghiep_TC}}</td>
                        <td>{{$item->nhap_hoc_dau_tot_nghiep_SC}}</td>
                        <td>{{$item->tot_nghiep_SC}}</td>
                        <td>{{$item->duoi_3_thang_tot_nghiep_nhap_hoc_dau}}</td>
                        <td>{{$item->duoi_3_thang_tot_nghiep}}</td>
                        <td>{{$item->ten_doanh_nghiep}}</td>
                        <td>{{$item->so_HSSV_duoc_tuyen_dung}}</td>
                        <td>{{$item->muc_luong_doanh_nghiep_tra}}</td>
                        <td>{{$item->ten_trang_thai}}</td>
                        @can('cap_nhat_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep')
                        <td>
                            @if ($item->trang_thai<3) <a
                                href="{{route('xuatbc.sua-ket-qua-tot-nghiep-voi-doanh-nghiep', ['id' => $item->id])}}">
                                Cập nhật</a>
                                @endif
                        </td>
                        @endcan
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="d-flex justify-content-end  mt-3">{{$data->links()}}</div>
        </div>
    </div>
    <!-- End content -->

    <form action="{{route('layformbieumausinhvien')}}" method="post">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hãy chọn trường</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="id_cs" class="form-control">

                            <option value=""></option>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" onclick="clickDownloadTemplate()" class="btn btn-primary">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" id="my_form_kqts_import" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="exampleModalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" id="file_import_id" name="file_import">
                        </div>
                        <div class="form-group">
                            <label for="">Chọn năm</label>
                            <select name="nam" id="nam_id" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Chọn đợt</label>
                            <select name="dot" id="dot_id" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="submitTai">Tải</a>
                            <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" id="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="exampleModalExportData" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xuất dữ liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Chọn năm xuất</label>
                            <select name="nam_muon_xuat" id="nam_id_xuat" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn đợt xuất</label>
                            <select name="dot_muon_xuat" id="dot_id_xuat" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Trường</label>
                            <select name="truong_id" id="truong_id_xuat" class="form-control">
                                <option value=""></option>

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        {{-- <button type="button" class="btn btn-primary" id="clickXuatData">Tải</a> --}}
                        <button type="submit" class="btn btn-primary" id="submitXuatData">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
@if (session('thongbao_edit'))
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
    $('.select2').select2();
    });
</script>
<script src="{!! asset('page_size/page_size.js') !!}"></script>
@endsection