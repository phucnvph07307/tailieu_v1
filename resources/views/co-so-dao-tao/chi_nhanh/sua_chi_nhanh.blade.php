@extends('layouts.admin');
@section('title', 'Cập nhật địa điểm đào tạo')
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
                        Cập nhật địa điểm đào tạo
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__body">
                @if (\Session::has('mess'))
                <div class="alert alert-success" role="alert">
                    <strong>{!! \Session::get('mess') !!}</strong>
                </div>
                @endif
                @forelse ($data as $item)
                <form action="{{ route('chi-nhanh.cap-nhat', ['id'=> $item->id])}}" method="POST">
                    @csrf
                    <div class="main-form row d-flex justify-content-around">
                        <div class="col-left col-lg-5">
                            <div class="form-group col-lg-12">

                                <label class="form-name mr-3" for="">Tên cơ sở đào tạo <span
                                        class="text-danger">(*)</span></label>
                                <select class="form-control" name="co_so_id" id="co-so-dao-tao">
                                    <option selected value="{{ $item->csdt_id }}">{{ $item->csdt_ten }}</option>
                                    @foreach ($csdt as $cs)
                                    <option value="{{ $cs->id }}">{{ $cs->ten }}</option>
                                    @endforeach
                                </select>
                                <p class="form-text text-danger">
                                    @error('co_so_id')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Chi Nhánh <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="chi_nhanh_chinh">
                                    <option selected value="{{ $item->chi_nhanh_chinh }}">@if ($item->chi_nhanh_chinh ==
                                        1)
                                        Chi nhánh chính
                                        @else
                                        Chi nhánh phụ
                                        @endif</option>
                                    <option value="1">Chi Nhánh Chính</option>
                                    <option value="0">Chi Nhánh Phụ</option>
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
                                    <option value="{{ $item->maqh }}" selected>{{ $item->tenquanhuyen }}
                                    </option>
                                    @foreach ($quanhuyen as $qh)
                                    <option value="{{ $qh->maqh }}">{{ $qh->name }}</option>
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
                                    <option selected value="{{ $item->xaid }}">{{ $item->tenxaphuong }}
                                    </option>
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
                                <label for="" class="col-4 form-name">Địa Chỉ <span
                                        class="text-danger">(*)</span></label>
                                <input type="text" name="dia_chi" id="" class="form-control"
                                    value="{{ $item->dia_chi }}">
                                <p id="helpId" class="form-text text-danger">
                                    @error('dia_chi')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Mã chứng nhận hoạt động <span
                                        class="text-danger">(*)</span></label>
                                <input type="text" name="ma_chung_nhan_dang_ki_hoat_dong" id="" class="form-control"
                                    value="{{ $item->ma_chung_nhan_dang_ki_hoat_dong }}">
                                <p id="helpId" class="form-text text-danger">
                                    @error('ma_chung_nhan_dang_ki_hoat_dong')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Trạng thái cấp <span
                                        class="text-danger">(*)</span></label>
                                <select class="form-control" name="da_duoc_cap" id="">
                                    <option selected value="{{ $item->da_duoc_cap }}">@if ( $item->da_duoc_cap == 1)
                                        Đã cấp
                                        @else
                                        Chưa cấp
                                        @endif</option>
                                    <option value="1">Đã cấp</option>
                                    <option value="0">Chưa cấp</option>

                                </select>
                                <p id="helpId" class="form-text text-danger">
                                    @error('da_duoc_cap')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="" class="form-name">Hotline <span class="text-danger">(*)</span></label>
                                <input type="text" name="hotline" id="" class="form-control"
                                    value="{{ $item->hotline }}">
                                <p id="helpId" class="form-text text-danger">
                                    @error('hotline')
                                    {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center pt-3">
                            <button type="submit" class="btn btn-primary mr-5 col-1">Cập nhật</button>
                            <a href="{{ route('csdt.chi-nhanh')}}" type="button" class="btn btn-danger col-1">Hủy</a>
                        </div>
                    </div>
                </form>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
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
    $(document).ready(function(){

    $('#co-so-dao-tao').select2();
    $('#devvn_quanhuyen').select2();
    $('#devvn_xaphuongthitran').select2();
    });
    
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection