@extends('layouts.admin')
@section('title', "Chi tiết đào tạo nghề cho người khuyết tật")
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
                        Chi tiết<small>đào tạo nghề cho người khuyết tật</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-10">
                                    <select name="bac_nghe" class="form-control ">
                                        <option selected="" value="6">Chọn cơ sở</option>
                                        <option value="5">FU</option>
                                        <option selected="" value="6">Fpoly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-10">
                                    <select name="bac_nghe" class="form-control ">
                                        <option selected="" value="6">2018</option>
                                        <option value="5">2019</option>
                                        <option selected="" value="6">2020</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Thời gian đào tạo</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-10">
                                    <select name="bac_nghe" class="form-control ">
                                        <option selected="" value="6">3</option>
                                        <option value="5">2</option>
                                        <option selected="" value="6">1</option>
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
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <table
                class="table table-bordered m-table m-table--border-danger m-table--head-bg-primary table-boder-white">
                <div class="col-12 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-2">
                        <select class="form-control" id="page-size">
                            <option selected="" value="20">20</option>
                            <option value="50">50</option>
                            <option value="80">80</option>
                            <option value="100">100</option>

                        </select>
                    </div>
                </div>
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Tên cơ sở</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th colspan="2">Tuyển sinh</th>
                        <th colspan="2">Tốt nghiệp</th>
                        <th colspan="3">Kinh phí thực hiện</th>
                    </tr>
                    <tr class="text-center">
                        <th rowspan="2">Nữ</th>
                        <th rowspan="2">Hộ khẩu Hà Nội</th>
                        <th rowspan="2">Nữ</th>
                        <th rowspan="2">Hộ khẩu Hà Nội</th>
                        <th rowspan="2">Ngân sách TW</th>
                        <th rowspan="2">Ngân sách TP</th>
                        <th rowspan="2">Ngân sách Khác</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Biên đạo múa</td>
                        <td>1</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                        <span class="page-link" aria-hidden="true">‹</span>
                    </li>
                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=3">3</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=4">4</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=5">5</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=6">6</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=7">7</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=8">8</a></li>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=27">27</a></li>
                    <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000/danhSach?page=28">28</a></li>

                    <li class="page-item">
                        <a class="page-link" href="http://127.0.0.1:8000/danhSach?page=2" rel="next"
                            aria-label="Next »">›</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</div>
@endsection