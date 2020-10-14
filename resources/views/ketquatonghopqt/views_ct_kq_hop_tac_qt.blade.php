@extends('layouts.admin')
@section('title', "Chi tiết kết quả hợp tát quốc tế")
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
                       Chi tiết<small>kết quả hợp tác quốc tế</small>
                    </h3>
                </div>
            </div>
        </div>
    <form action="" method="get" class="m-form pt-5">
        <input type="hidden" name="page_size" value="20">
        <div class="m-portlet__body">
            <div class="m-form__section m-form__section--first">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Tên đơn vị</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">Chọn đơn vị</option>
                                    <option value="5">FU</option>
                                    <option selected="" value="6">Fpoly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Năm</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">Chọn năm</option>
                                    <option value="5">2018</option>
                                    <option selected="" value="6">2019</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">Đợt</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">1</option>
                                    <option value="5">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <table class="table table-bordered m-table m-table- m-table--head-bg-primary table-boder-white">
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
                        <th rowspan="2">Tên đơn vị</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th colspan="4">Kết quả tuyển sinh theo chương trình hợp tác quốc tế</th>
                        <th colspan="3">Số học sinh được cấp bằng tốt nghiệp theo hình thức hợp tác quốc tế</th>
                        <th rowspan="2">Số học sinh có việc làm sau khi tốt nghiệp chương trình hợp tác quốc tế</th>
                        <th rowspan="2">Số lượng chương trình,giáo trình xây dựng,phát triển theo hình thức hợp tác quốc tế</th>
                        <th colspan="3">Hợp tác quốc tế trong đầu tư cơ sở vật chất,trang thiết bị</th>\
                        <th rowspan="2">Thao tác</th>
                    </tr>
                    <tr class="text-center">
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Cao đẳng</th>
                        <th rowspan="2">Trung cấp</th>
                        <th rowspan="2">Sơ cấp</th>
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Số HS được các đơn vị/tổ chức nước ngoài hợp tác đào tạo cấp bằng</th>
                        <th rowspan="2">Số HS được nhà nước cấp bằng theo hình thức hợp tác quốc tế</th>
                        <th rowspan="2">Số phòng học đầu tư</th>
                        <th rowspan="2">Số nhà xưởng thực hành được đầu tư</th>
                        <th rowspan="2">Tổng kinh phí đầu tư trang thiết bị , máy móc</th>
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
                        <a class="page-link" href="http://127.0.0.1:8000/danhSach?page=2" rel="next" aria-label="Next »">›</a>
                    </li>
                </ul>
            </nav>
        
        </div>
    </div>
</div>
    @endsection
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/so_lieu_tuyen_sinh/tong_hop_so_lieu.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#co_so_id").select2();
        });
        $("#loai_hinh").change(function () {
            axios
                .post("/xuat-bao-cao/ket-qua-tuyen-sinh/co-so-tuyen-sinh-theo-loai-hinh", {
                    id: $("#loai_hinh").val(),
                })
                .then(function (response) {
                    var htmldata = '<option value="">Chọn cơ sở</option>';
                    response.data.forEach((element) => {
                        htmldata += `<option value="${element.id}" >${element.ten}</option>`;
                    });
                    $("#co_so_id").html(htmldata);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    @endsection
