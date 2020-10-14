@extends('layouts.admin');
@section('title', 'Tạo mới địa điểm đào tạo')
@section('style')
<link href="{!! asset('vendors/_customize/csdt.list.css') !!}" rel="stylesheet" type="text/css" />
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
                        Thêm địa điểm đào tạo
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                <form action="{{ route('chi-nhanh.tao-moi')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="main-form row d-flex justify-content-around">
                        @if (isset($params['co_so_id']))
                        <input type="hidden" value="csdt_id" value="{{ $params['co_so_id'] }}">
                        @endif
                        <div class="col-left col-lg-5">
                            <div class="form-group col-lg-12">
                                <label class="form-name mr-3" for="">Tên cơ sở đào tạo</label>
                                <select class="form-control" name="co_so_id" id="ten_co_so">
                                    <option disabled selected>Chọn cơ sở đào tạo</option>
                                    @foreach ($csdt as $cs)
                                    <option value=" {{ $cs->id }}" @if (old('co_so_id')==$cs->id )
                                        {{ 'selected' }}
                                        @endif
                                        @if (isset($params['co_so_id']) && $params['co_so_id'] == $cs->id)
                                        selected
                                        @endif
                                        >{{ $cs->ten }}</option>
                                    @endforeach
                                </select>
                                <p class="form-text text-danger">
                                    @error('co_so_id')
                                    {{ $message }}
                                    @enderror
                                </p>

                            </div>



                            <div class="form-group col-lg-12">
                                <label for="" class="col-4 form-name">Chi Nhánh</label>
                                <select class="form-control" name="chi_nhanh_chinh">
                                    <option value="0">Chi nhánh chính</option>
                                    <option value="1">Chi nhánh phụ</option>
                                </select>
                                <p id="helpId" class="form-text text-danger">
                                    @error('chi_nhanh_chinh')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Quận/Huyện <span class="text-danger">(*)</span></label>
                                <select class="form-control col-12" name="maqh" id="devvn_quanhuyen">
                                    <option disabled selected>Quận / Huyện</option>
                                    @foreach ($quanhuyen as $qh)
                                    <option value="{{ $qh->maqh }}" @if (old('maqh')==$qh->maqh )
                                        {{ 'selected' }}
                                        @endif>{{ $qh->name }}</option>
                                    @endforeach
                                </select>
                                <p id="helpId" class="form-text text-danger">
                                    @error('maqh')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Xã/ Phường <span class="text-danger">(*)</span></label>
                                <select class="form-control col-12" name="xaid" id="devvn_xaphuongthitran">
                                    <option disabled selected>Chọn</option>
                                    @foreach ($xaphuong as $xp)
                                    <option value="{{ $xp->xaid }}" @if (old('xaid')==$xp->xaid )
                                        {{ 'selected' }}
                                        @endif>{{ $xp->name }}</option>
                                    @endforeach
                                </select>
                                <p id="helpId" class="form-text text-danger">
                                    @error('xaid')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="col-right col-lg-5">
                            <div class="form-group col-lg-12">
                                <label for="" class="col-4 form-name">Địa Chỉ</label>
                                <input type="text" name="dia_chi" id="" value="{{ old('dia_chi') }}"
                                    class="form-control" placeholder="" aria-describedby="helpId">
                                <p id="helpId" class="form-text text-danger">
                                    @error('dia_chi')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="" class="col-6 form-name">Mã chứng nhận hoạt động</label>
                                <input type="text" name="ma_chung_nhan_dang_ki_hoat_dong" id=""
                                    value="{{ old('ma_chung_nhan_dang_ki_hoat_dong') }}" class="form-control"
                                    placeholder="" aria-describedby="helpId">
                                <p id="helpId" class="form-text text-danger">
                                    @error('ma_chung_nhan_dang_ki_hoat_dong')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="" class="col-4 form-name">Trạng thái cấp</label>
                                <select class="form-control" name="da_duoc_cap" id="">
                                    <option value="1" selected>Đã cấp</option>
                                    <option value="0">Chưa cấp</option>
                                </select>
                                <p id="helpId" class="form-text text-danger">
                                    @error('da_duoc_cap')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="" class="col-4 form-name">Hotline</label>
                                <input type="text" name="hotline" id="" value="{{ old('hotline') }}"
                                    class="form-control" placeholder="" aria-describedby="helpId">
                                <p id="helpId" class="form-text text-danger">
                                    @error('hotline')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-5 col-1">Thêm</button>
                            <button type="reset" class="btn btn-danger col-1">Hủy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function(){
        $('#devvn_quanhuyen').select2();
        $('#devvn_xaphuongthitran').select2();
        $('#ten_co_so').select2();
    });

    $("#devvn_quanhuyen" ).change(function() {
        axios.post('/xuat-bao-cao/ket-qua-tuyen-sinh/xa-phuong-theo-quan-huyen', {
                    id:  $("#devvn_quanhuyen").val(),
        })
        .then(function (response) {
            var htmldata = '<option selected  disabled>Xã / Phường</option>'
                response.data.forEach(element => {
                htmldata+=`<option value="${element.xaid}" >${element.name}</option>`   
            });
            $('#devvn_xaphuongthitran').html(htmldata);
        })
        .catch(function (error) {
            console.log(error);
            });
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
@endsection