@extends('layouts.admin');
@section('title', 'Chi tiết giấy phép')
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
                        Chi tiết giấy phép
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            @if (session('success-update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong>{{session('success-update')}}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-2">
                    @foreach ($thongTinGP as $gp)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Tên cơ sở: <b>{{ $gp->ten_co_so }}</b></li>
                        <li class="list-group-item">Tên giấy phép: <b>{{ $gp->ten_giay_phep }}</b>
                        </li>
                        <li class="list-group-item">Ngày ban hành:
                            <b>{{ \Carbon\Carbon::parse($gp->ngay_ban_hanh)->format('d-m-Y') }}</b>
                        </li>
                        <li class="list-group-item">Ngày hiệu lực:
                            <b>{{ \Carbon\Carbon::parse($gp->ngay_hieu_luc)->format('d-m-Y') }}</b>
                        </li>
                        <li class="list-group-item">Ngày hết hạn:
                            <b>{{\Carbon\Carbon::parse( $gp->ngay_het_han)->format('d-m-Y') }}</b></li>
                        <li class="list-group-item">Ảnh giấy phép: <a href="{!! asset('storage/'.$gp->anh_giay_phep)!!}"
                                target="_blank"><i class="fas fa-eye"></i> xem ảnh</a>
                        </li>
                    </ul>
                    @endforeach

                </div>

                <div class="col-lg-6">
                    <h6>Mô tả: </h6>
                    <div>
                        <textarea id="summernote2" cols="30" rows="10">{{ $gp->mo_ta }}</textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4 class="text-bold p-3">Danh sách nghề được cấp trong giấy phép</h4>
                    </div>
                    <div class="">
                        @if ($params['giay_phep_id'] > 0)
                        <form action="{{route('giay-phep.cap-nhat')}}" method="GET">
                            <input type="hidden" id="co_so_id" name="co_so_id" value="{{$params['co_so_id']}}">
                            <input type="hidden" id="giay_phep_id" name="giay_phep_id"
                                value="{{$params['giay_phep_id']}}">
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin giấy phép</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <hr>

            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong>{{session('success')}}</strong>
            </div>
            @endif
            <table class="table m-table m-table--head-bg-brand col-lg-12">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nghề</th>
                        <th>Bậc nghề</th>
                        <th>Mã nghề</th>
                        <th>Quy mô tuyển sinh/năm</th>
                        <th><button class="btn btn-success btn-sm" type="button" class="btn btn-danger"
                                data-toggle="modal" data-target="#m_modal_5">Bổ sung nghề</button></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @forelse ($ngheDuocCap as $data)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $data->ten_nghe }}</td>
                        <td>@if ($data->bac_nghe == 6)
                            Cao Đẳng
                            @else
                            Trung Cấp
                            @endif
                        </td>
                        <td>{{ $data->nghe_id }}</td>
                        <td>@if (isset($data->quy_mo_tuyen_sinh))
                            {{ $data->quy_mo_tuyen_sinh }}
                            @else
                            <p class="text-danger">Chưa cập nhật</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('giay-phep.cap-nhat-nghe-trong-giay-phep', ['id' => $data->giay_chung_nhan_id])}}"
                                class="btn btn-primary btn-sm">Cập
                                nhật</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="Confirm({{$data->nghe_id}})"
                                data-toggle="modal" data-target="#m_modal_3">Xóa</button>
                            <form action="{{ route('giay-phep.xoa-nghe-trong-gp') }}" method="post"
                                id="xoa_ngheGP_{{ $data->nghe_id }}">
                                @csrf
                                <input type="hidden" name="co_so_id" value="{{$params['co_so_id']}}">
                                <input type="hidden" name="giay_phep_id" value="{{$params['giay_phep_id']}}">
                                <input type="hidden" name="nghe_id" value="{{$data->nghe_id}}">
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-danger text-center">Giấy phép chưa có ngành nghề nào</td>
                    </tr>
                    @endforelse
                </tbody>
                {{-- modal bổ sung nghề --}}
                <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bổ sung nghề vào giấy phép
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="them-nghe-vao-giay-phep">
                                    {{ csrf_field() }}
                                    @if(isset($params))
                                    <input type="hidden" name="co_so_id" id="co-so-id-ajax"
                                        value="{{$params['co_so_id']}}">
                                    <input type="hidden" name="giay_phep_id" id="giay-phep-id-ajax"
                                        value="{{$params['giay_phep_id']}}">
                                    @endif
                                    <div class="form-group mb-5">
                                        <label class="col-form-label">Chọn nghề Cao Đẳng</label>
                                        <div class="">
                                            <select id="chon-nghe-cao-dang" multiple name="nghe_cao_dang[]"
                                                class="form-control">
                                                @foreach ($allNgheCD as $ngheCD)
                                                <option value="{{ $ngheCD->id }}"
                                                    {{ (collect(old('nghe_cao_dang'))->contains($ngheCD->id)) ? 'selected':'' }}>
                                                    {{ $ngheCD->id }} - {{ $ngheCD->ten_nganh_nghe }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <p id="Err-nghe_cao_dang" class="text-danger"></p>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5">
                                        <label class="col-form-label">Chọn nghề Trung Cấp</label>
                                        <div class="">
                                            <select id="chon-nghe-trung-cap" multiple name="nghe_trung_cap[]"
                                                class="form-control">
                                                @foreach ($allNgheTC as $ngheTC)
                                                <option value="{{ $ngheTC->id }}"
                                                    {{ (collect(old('nghe_trung_cap'))->contains($ngheTC->id)) ? 'selected':'' }}>
                                                    {{ $ngheTC->id }} - {{ $ngheTC->ten_nganh_nghe }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <p id="Err-nghe_trung_cap" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                </form>
                                <button type="button" id="bo-sung-nghe-ajax" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal add cơ quan chủ quản --}}

                {{-- modal xóa --}}
                <div class="modal fade" id="m_modal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <H4 class="text-danger">Bạn muốn xóa nghề này khỏi giấy phép?</H4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Hủy</button>
                                <a id="btn-xoa" href="" class="btn btn-danger btn-sm">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal xóa --}}
            </table>
            <div class="m-portlet__foot d-flex justify-content-end">
                {{$ngheDuocCap->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function(){
        $('#page-size').change(function(){
            var giay_phep_id = $('#giay_phep_id').val();
            var co_so_id = $('#co_so_id').val();
            var page_size = $(this).val();
            var reloadUrl = `${currentUrl}?giay_phep_id=${giay_phep_id}&co_so_id=${co_so_id}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });
    });

    var selectedId = -1;
    function Confirm(id){
        selectedId = id;
    }
    $("#btn-xoa").click(function (event) {
        event.preventDefault();
        $("#xoa_ngheGP_" + selectedId).submit();
    });

    $(document).ready(function () {
        $('#summernote2').summernote({
            height: 150,
            toolbar: [
                ['view', ['fullscreen']]
            ]
        });

        $('.form-control').attr('autocomplete', 'off');

        $('#chon-nghe-trung-cap').select2({
            placeholder: "Tìm kiếm ngành nghề",
        });

        $('#chon-nghe-cao-dang').select2({
            placeholder: "Tìm kiếm ngành nghề",
        })

        $('#bo-sung-nghe-ajax').click(function(event){
            event.preventDefault();

            $(document).ajaxStart(function(){
            $(".loading").css("display", "block");
            });

            $(document).ajaxComplete(function(){
                $(".loading").css("display", "none");
            });

            $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('giay-phep.bo-sung-nghe')}}",
            data: {
                co_so_id: $('#co-so-id-ajax').val(),
                giay_phep_id: $('#giay-phep-id-ajax').val(),
                nghe_cao_dang: $('#chon-nghe-cao-dang').val(),
                nghe_trung_cap: $('#chon-nghe-trung-cap').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                $('#m_modal_5').hide();
                Swal.fire({
                title: response.message,
                icon: 'success',
                confirmButtonText: 'Ok',
                content: location.reload()
                })
            },
            error: function(data) {
                var errors = data.responseJSON;
                if ($.isEmptyObject(errors) == false) {
                    $.each(errors.errors, function(key, value) {
                        var ErrorID = '#Err-' + key;
                        $(ErrorID).removeClass('d-none');
                        $(ErrorID).text(value);
                    })
                }
            }
        });
        })

    });
</script>
@endsection