@extends('layouts.admin')
@section('title', "Chỉnh sửa danh sách giáo viên")
@section('style')
@endsection
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chỉnh sửa danh sách<small>giáo viên</small>
                    </h3>
                </div>
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
                            <label class="col-lg-2 col-form-label">Tên cơ sở</label>
                            <div class="col-lg-8">
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
                            <label class="col-lg-2 col-form-label">Ngành nghề</label>
                            <div class="col-lg-8">
                                <select id="nganh_nghe" name="nghe_id" class="form-control ">
                                    {{-- <option value="-1">-----Chọn ngành nghề-----</option> --}}

                                </select>
                                @if ($errors->has('nghe_id'))
                                <span class="text-danger">{{ $errors->first('nghe_id') }}</span>
                                @endif
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
                            <label class="col-lg-2 col-form-label">Loại hinh cơ sở</label>
                            <div class="col-lg-8">
                                <select name="bac_nghe" class="form-control ">
                                    <option selected="" value="6">Công lập</option>
                                    <option value="5">Tư thục</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Cơ bản
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Biên chế</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Hợp đồng ( từ 1 năm chở lên )</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="m-menu__link-icon flaticon-web"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Trình độ chuyên môn
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row col-12">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tiến sỹ</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Thạc sỹ</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Đại học</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Cao đẳng</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Trung cấp</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Trình độ khác</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress-trinhdo h-100">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="m-menu__link-icon flaticon-web"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Trình độ
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row col-12">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Bậc 1</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Bậc 2</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Bậc 3</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Bậc 4</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Bậc 5</label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress-  h-100">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="m-menu__link-icon flaticon-web"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Trình độ chuyên môn
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row col-12">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ KNN quốc gia bậc 1 (Tương đương)</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ KNN quốc gia bậc 2 (Tương đương)</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ KNN quốc gia bậc 3 (Tương đương)</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress- h-100">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="m-menu__link-icon flaticon-web"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Trình độ chuyên môn
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row col-12">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ sư phạm dạy trình độ Cao Đẳng</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ sư phạm dạy trình độ Trung Cấp</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-8 col-form-label">Chứng chỉ sư phạm dạy trình độ Sơ Cấp</label>
                                    <div class="col-lg-4">
                                        <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                            name="keyword">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Trong đó
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Nữ</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Dân tộc ít người</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Giáo sư</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Phó giáo sư</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Nhà giáo nhân dân , nghệ sĩ nhân dân , nghệ nhân nhân dân , thầy thuốc nhân dân </label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Nhà giáo ưu tú , nghệ sĩ ưu tú , nghệ nhân ưu tú , thầy thuốc ưu tú</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Nhà giáo giảng dạy môn học chung</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="m-portlet mt-5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Trình độ chuyên môn 
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="20">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row col-12">
                        <div class="col-md-12">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-6 col-form-label">Số nhà giáo tham gia đào tạo , bồi dưỡng trong năm</label>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control m-input" placeholder="Nhập vào số"
                                        name="keyword">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-end">
        <div class="col-lg-1 ">
            <button type="submit" class="btn btn-danger">Hủy</button>
        </div>
        <div class="col-lg-1 ">
            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
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
