@extends('layouts.admin')
@section('title', "Chi tiết nghề của cơ sở đào tạo")
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
                        Danh sách nghề của địa điểm đào tạo
                    </h3>
                </div>
            </div>
        </div>

        @if (isset($chiNhanh))
        <div class="m-portlet__body">
            <div class="m-portlet__head-title mb-3">
                <h5 class="m-portlet__head-text">
                    Thông tin cơ sở
                </h5>
                <ul>
                    <li class="m-portlet__head-text"><b>{{ $chiNhanh[0]->ten_co_so }}</b></li>
                    <li class="m-portlet__head-text">Cơ sở: <b>{{ $chiNhanh[0]->dia_chi }}</b></li>
                </ul>
            </div>
        </div>
        @endif
    </div>
    <div class="m-portlet">

        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên tên nghề</label>
                                <div class="col-lg-8">
                                    <input type="text" value="{{$params['ten_nghe']}}" name="ten_nghe"
                                        class="form-control m-input" placeholder="từ khóa tên cơ sở">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Bậc nghề:</label>
                                <div class="col-lg-8">
                                    <select name="bac_nghe" class="form-control">
                                        <option selected value="">Chọn loại hình cơ sở</option>
                                        @if ($params['bac_nghe'] == 6)
                                        <option value="{{config('common.bac_nghe.cao_dang.ma_bac')}}" selected>
                                            {{config('common.bac_nghe.cao_dang.ten_bac')}}</option>
                                        <option value="{{config('common.bac_nghe.trung_cap.ma_bac')}}">
                                            {{config('common.bac_nghe.trung_cap.ten_bac')}}</option>
                                        @elseif($params['bac_nghe'] == 5)
                                        <option value="{{config('common.bac_nghe.cao_dang.ma_bac')}}">
                                            {{config('common.bac_nghe.cao_dang.ten_bac')}}</option>
                                        <option value="{{config('common.bac_nghe.trung_cap.ma_bac')}}" selected>
                                            {{config('common.bac_nghe.trung_cap.ten_bac')}}</option>
                                        @else
                                        <option value="{{config('common.bac_nghe.cao_dang.ma_bac')}}">
                                            {{config('common.bac_nghe.cao_dang.ten_bac')}}</option>
                                        <option value="{{config('common.bac_nghe.trung_cap.ma_bac')}}">
                                            {{config('common.bac_nghe.trung_cap.ten_bac')}}</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Mã nghề:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="ma_nghe" value="{{$params['ma_nghe']}}"
                                        class="form-control m-input" placeholder="mã đơn vị">
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

        <div class="m-portlet__body">
            <div class="d-flex justify-content-end align-items-end">
                <div class="col-lg-7 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-4">
                        <select class="form-control" id="page-size">
                            @foreach(config('common.paginate_size.list') as $size)
                            <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button class="btn btn-success mb-3" type="button" data-toggle="modal" data-target="#m_modal_6">Bổ
                        sung nghề</button>

                    @if ($params['co_so_id'] > 0)
                    <input type="hidden" id="co-so-id-ajax" value="{{ $params['co_so_id'] }}">
                    <input type="hidden" id="chi-nhanh-id-ajax" value="{{ $params['chi_nhanh_id'] }}">
                    @endif

                    {{-- modal bổ sung nghề --}}
                    <div class="modal fade" id="m_modal_6" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bổ sung nghề cho địa điểm đào tạo
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="">
                                        <div class="form-group col-lg-12">
                                            <label class="form-name" for="">Chọn giấy phép:</label>
                                            <select class="form-control" name="giay_phep_id" id="chon-giay-phep-ajax">
                                                <option selected disabled>---------Chọn giấy phép---------</option>
                                                @forelse ($dsGiayPhep as $GP)
                                                <option value="{{ $GP->giay_phep_id }}">{{ $GP->ten_giay_phep }}
                                                </option>
                                                @empty

                                                @endforelse
                                            </select>
                                            <p class="text-danger" id="Err_loai_quyet_dinh"></p>
                                        </div>
                                    </form>
                                    <div id="select-nghe">
                                        <form method="post" action="">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <div class="form-group col-lg-12">
                                                <label class="form-name" for="">Chọn nghề cao đẳng</label>
                                                <select class="form-control" multiple name="nghe_cao_dang[]"
                                                    id="chon-nghe-cao-dang">
                                                </select>
                                                <p class="text-danger" id="Err_loai_quyet_dinh"></p>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label class="form-name" for="">Chọn nghề trung cấp</label>
                                                <select class="form-control" multiple name="nghe_trung_cap[]"
                                                    id="chon-nghe-trung-cap">
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <p id="Err-chon-nghe" class="text-danger"></p>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="loading-select-nghe" id="loading-select-nghe">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="button" id="btn-summit-nghe-ajax"
                                        class="btn btn-primary">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal bổ sung nghề --}}
                </div>
            </div>

            <table class="table m-table m-table--head-bg-brand">
                <thead class="thead-align-midle">
                    <th>STT</th>
                    <th>Tên nghề</th>
                    <th>Mã Nghề</th>
                    <th>Bậc nghề</th>
                    <th>Quy mô tuyển sinh <br>
                        người/năm</th>
                    <th>Quyết định số</th>
                    <th>Ngày ban hành</th>
                    <th>Ngày hết hạn</th>
                    <th>Trạng thái</th>
                    <th>Ảnh giấy phép</th>
                </thead>
                @php
                $i = 1;
                @endphp
                <tbody>
                    @forelse ($dsNgheChiNhanh as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->ten_nganh_nghe }}</td>
                        <td>{{$item->nghe_id}}</td>
                        <td>
                            @if($item->bac_nghe == 6)
                            Cao Đẳng
                            @elseif($item->bac_nghe == 5)
                            Trung Cấp
                            @endif
                        </td>
                        <td>
                            @if (isset($item->quy_mo_tuyen_sinh))
                            {{$item->quy_mo_tuyen_sinh}}
                            @else
                            <span class="text-danger">Chưa cập nhật</span>
                            @endif
                        </td>
                        <td>{{ $item->ten_giay_phep }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ngay_ban_hanh)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ngay_het_han)->format('d-m-Y') }}</td>
                        <td>
                            @if ($item->trang_thai == 1)
                            Hoạt động
                            @else
                            Đã thu hồi
                            @endif
                        </td>
                        <td><a href="{!! asset('storage/' . $item->anh_giay_phep) !!}" target="_blank"><i
                                    class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-danger">Không tìm thấy kết quả phù hợp</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        @if(!empty($dsNgheChiNhanh))
        <div class="m-portlet__foot d-flex justify-content-end">
            {{$dsNgheChiNhanh->links()}}
        </div>
        @endif
    </div>
    <input type="hidden" id="chi_nhanh_id" value="{{$params['chi_nhanh_id']}}">
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function(){
        $('#chon-nghe-cao-dang').select2();
        $('#chon-nghe-trung-cap').select2();
        $('#chon-giay-phep-ajax').select2();
        $('#select-nghe').addClass('d-none');
        $('#loading-select-nghe').addClass('d-none');

        $('#page-size').change(function(){
            var chi_nhanh_id = $('#chi_nhanh_id').val();
            var ten_nghe = $('input[name=ten_nghe]').val();
            var ma_nghe = $('input[name=ma_nghe]').val();
            var bac_nghe = $('select[name=bac_nghe]').val();
            var page_size = $(this).val();
            var reloadUrl = `${currentUrl}/${chi_nhanh_id}?ten_nghe=${ten_nghe}&ma_nghe=${ma_nghe}&bac_nghe=${bac_nghe}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });
    });

    $(document).ajaxStart(function(){
        $('#select-nghe').addClass('d-none');
        $('#loading-select-nghe').removeClass('d-none');
        $('#loading-select-nghe').css('display', 'block')
        });

        $(document).ajaxComplete(function(){
            $('#loading-select-nghe').addClass('d-none');
            $('#select-nghe').removeClass('d-none');
        });

    $('#chon-giay-phep-ajax').change(function(){
       
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('chi-nhanh.get-nganh-nghe')}}",
            data: {
                chi_nhanh_id: $('#chi-nhanh-id-ajax').val(),
                co_so_id: $('#co-so-id-ajax').val(),
                giay_phep_id: $('#chon-giay-phep-ajax').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                $('#select-nghe').removeClass('d-none');
                var htmldata = null;
                response.ngheCD.forEach(element => {
                    htmldata += `<option value="${element.giay_chung_nhan_id}">${element.nghe_id} -
                        ${element.ten_nghe}</option>`
                });
                $('#chon-nghe-cao-dang').html(htmldata);

                var htmldata2 = null;
                response.ngheTC.forEach(element => {
                    htmldata2 += `<option value="${element.giay_chung_nhan_id}">${element.nghe_id} -
                        ${element.ten_nghe}</option>`
                });
                $('#chon-nghe-trung-cap').html(htmldata2);
            }
        });
    });

    $('#btn-summit-nghe-ajax').click(function(event){
        event.preventDefault();

        if($('#chon-nghe-cao-dang').val() == '' && $('#chon-nghe-trung-cap').val() == ''){
            $('#Err-chon-nghe').text('Vui lòng chọn ít nhất 1 nghề');
            return false;
        }

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: "{{route('chi-nhanh-luu-bo-sung-nghe')}}",
            data: {
                chi_nhanh_id: $('#chi-nhanh-id-ajax').val(),
                giay_phep_id: $('#chon-giay-phep-ajax').val(),
                nghe_cao_dang: $('#chon-nghe-cao-dang').val(),
                nghe_trung_cap: $('#chon-nghe-trung-cap').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(response){
                Swal.fire({
                title: response.message,
                icon: 'success'
                });
                $('#m_modal_6').modal('hide');
                window.location.reload();
            },
            error: function(data){
                var errors = data.responseJSON;
                if(errors.errors.nghe_cao_dang.length || errors.errors.nghe_trung_cap.length){
                    $('#Err-chon-nghe').text('Vui lòng chọn ít nhất 1 nghề');
                };
            }
        })
    });

    $('#chon-nghe-cao-dang').change(function(){
        $('#Err-chon-nghe').text('');
    });

    $('#chon-nghe-trung-cap').change(function(){
        $('#Err-chon-nghe').text('');
    })
</script>


@endsection