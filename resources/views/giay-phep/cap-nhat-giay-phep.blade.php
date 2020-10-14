@extends('layouts.admin');
@section('title', 'Cập nhật thông tin giấy phép')
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
                        Cập nhật thông tin giấy phép
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet">
            <div class="m-portlet__body">
                <form action="{{route('giay-phep.cap-nhat')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(isset($params))
                    <input type="hidden" name="co_so_id" value="{{$params['co_so_id']}}">
                    <input type="hidden" name="giay_phep_id" value="{{$params['giay_phep_id']}}">
                    @endif
                    <div class="row">
                        <div class="col-6 d-flex align-items-stretch">
                            <div class="col-12">
                                @if (isset($Csdt))
                                <div class="form-group1 m-form__group mb-4">
                                    <label for="">Tên trường: <b>{{$Csdt->ten}}</b></label>
                                    <input type="hidden" name="co_so_id" value="{{$Csdt->id}}">
                                </div>
                                @endif

                                @foreach ($thongTinGP as $gp)
                                <div class="form-group m-form__group mb-4">
                                    <label>Tên giấy phép <span class="text-danger">(*)</span></label>
                                    <input type="text" name="ten_giay_phep"
                                        value="{{old('ten_giay_phep', $gp->ten_giay_phep)}}"
                                        class="form-control m-input" placeholder="Nhập tên giấy phép">
                                </div>
                                <p class="text-danger text-small">
                                    @error('ten_giay_phep')
                                    {{$message}}
                                    @enderror
                                </p>
                                <div class="form-group m-form__group">
                                    <label for="exampleInputEmail1">Ảnh giấy phép <span
                                            class="text-danger">(*)</span></label>
                                    <div class="custom-file">
                                        <input type="file" name="anh-giay-phep" class="custom-file-input"
                                            onchange="SystemUtil.previewImage(this, '#anh-giay-phep', '{!! asset('storage/' . $gp->anh_giay_phep) !!}')"
                                            id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    <p class="text-danger text-small">
                                        @error('anh-giay-phep')
                                        {{$message}}
                                        @enderror
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="anh-giay-phep">
                                <img class="lazyload" loading="lazy"
                                    data-src="{!! asset('storage/' . $gp->anh_giay_phep) !!}" id="anh-giay-phep">
                            </div>
                        </div>
                    </div>

                    <div class="row col-12 mt-3">
                        <div class="col-4">
                            <div class="form-group m-form__group mb-4">
                                <label>Ngày ban hành <span class="text-danger">(*)</span></label>
                                <div class="input-group date datepicker">
                                    <input type="text" name="ngay_ban_hanh"
                                        value="{{ \Carbon\Carbon::parse(old('ngay_ban_hanh', $gp->ngay_ban_hanh))->format('d-m-Y') }}"
                                        placeholder="Ngày-tháng-năm" class="form-control">
                                    <div
                                        class="input-group-addon form-control col-2 d-flex justify-content-center align-items-center">
                                        <span><i class="flaticon-calendar-2"></i></span>
                                    </div>
                                </div>
                                <p class="text-danger text-small">
                                    @error('ngay_ban_hanh')
                                    {{$message}}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group m-form__group mb-4">
                                <label>Ngày hiệu lực <span class="text-danger">(*)</span></label>
                                <div class="input-group date datepicker">
                                    <input type="text" name="ngay_hieu_luc"
                                        value="{{ \Carbon\Carbon::parse(old('ngay_hieu_luc', $gp->ngay_hieu_luc))->format('d-m-Y') }}"
                                        placeholder="Ngày-tháng-năm" class="form-control">
                                    <div
                                        class="input-group-addon form-control col-2 d-flex justify-content-center align-items-center">
                                        <span><i class="flaticon-calendar-2"></i></span>
                                    </div>
                                </div>
                                <p class="text-danger text-small">
                                    @error('ngay_hieu_luc')
                                    {{$message}}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group m-form__group mb-4">
                                <label>Ngày hết hạn <span class="text-danger">(*)</span></label>
                                <div class="input-group date datepicker">
                                    <input type="text" name="ngay_het_han"
                                        value="{{ \Carbon\Carbon::parse(old('ngay_het_han', $gp->ngay_het_han))->format('d-m-Y') }}"
                                        placeholder="Ngày-tháng-năm" class="form-control">
                                    <div
                                        class="input-group-addon form-control col-2 d-flex justify-content-center align-items-center">
                                        <span><i class="flaticon-calendar-2"></i></span>
                                    </div>
                                </div>
                                <p class="text-danger text-small">
                                    @error('ngay_het_han')
                                    {{$message}}
                                    @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="col-12 form-group m-form__group">
                            <label for="exampleTextarea">Mô tả quyết định</label>
                            <textarea class="form-control m-input" id="summernote" name="mo_ta"
                                placeholder="Mô tả ngắn gọn nội dung giấy phép hoặc ghi chú"
                                rows="4">{{old('mo_ta', $gp->mo_ta)}}</textarea>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="col-1 btn btn-primary mr-4">Cập nhật</button>
                        <button type="button" class="col-1 btn btn-danger">Huỷ</button>
                    </div>
                </form>
                <p><span class="text-danger">(*)</span> Mục không được để trống</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="jquery.lazy.min.js"></script>
<script>
    $(document).ready(function () {
        $('#co-so-id-js').select2();

        $('.form-control').attr('autocomplete', 'off');

        $('#summernote').summernote({
            height: 150,
            toolbar: 
            [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen']],
            ]
        });

        $('#chon-nghe-cao-dang').select2({
            placeholder: "Tìm kiếm ngành nghề",
        });

        $('#chon-nghe-trung-cap').select2({
            placeholder: "Tìm kiếm ngành nghề",
        });
    });

    $(document).ready(function () {
        var logoImgUrl = $('#anh-giay-phep').attr('src');
        SystemUtil.defaultImgUrl(logoImgUrl, '#anh-giay-phep', "{!! asset('storage/' . $gp->anh_giay_phep) !!}");
    });

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });


    $(function() {
        $('img.lazyload').lazy({
            placeholder: "data:image/gif;base64,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"
        });
    });
</script>
@endsection