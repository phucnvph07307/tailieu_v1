@extends('layouts.admin')
@section('title', "Danh sách đội ngủ giáo")
@section('style')
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
                        Bộ lọc
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
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input" placeholder="Nhập tên cơ sở"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Loại hình cơ sở</label>
                                <div class="col-lg-8">
                                    <select name="bac_nghe" class="form-control ">
                                        <option selected="" value="6">Công lập</option>
                                        <option value="5">Tư thục</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Cơ quan chủ quản</label>
                                <div class="col-lg-8">
                                    <select name="bac_nghe" class="form-control ">
                                        <option selected="" value="6">Cao đẳng</option>
                                        <option value="5">Trung cấp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên ngành</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input"
                                        placeholder="Nhập mã hoặc tên ngành nghề" name="keyword">
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
    <div class="row mb-4 bieumau">
        <div class="col-lg-2">
            <a href=""><i class="la la-download">Tải xuống biểu mẫu</i></a>
        </div>
        <div class="col-lg-2">
            <a href=""><i class="la la-upload">Tải lên file excel</i></a>
        </div>
        <div class="col-lg-8 " style="text-align: right">
        </div>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body">
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên cơ sở</th>
                        <th>Loại hình cơ sở</th>
                        <th>Tổng số </th>

                        <th>
                            <a href="" class="btn btn-success btn-sm">Thêm mới</a>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>6210214</td>
                        <td>Biên đạo múa</td>
                        <td>1</td>
                        <td>2</td>
                        <td>

                            <a href="" class="btn btn-info btn-sm">Sửa</a>

                            <a href="" class="btn btn-primary btn-sm">Chi tiết</a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
                <a class="page-link" href="http://127.0.0.1:8000/danhSach?page=2" rel="next" aria-label="Next »">›</a>
            </li>
        </ul>
    </nav>

</div>
</div>
</div>


@endsection