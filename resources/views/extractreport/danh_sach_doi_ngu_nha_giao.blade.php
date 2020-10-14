@extends('layouts.admin')
@section('title', "Danh sách đội ngũ giáo")
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
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Tên cơ sở</label>
                                <div class="col-lg-8">
                                    <select name="co_so_id" class="form-control select2">
                                        <option value="">-----Chọn cơ sở-----</option>
                                        @foreach ($params['get_co_so'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['co_so_id']) &&
                                            $params['co_so_id']==$item->id)
                                            selected
                                            @endif>
                                            {{ $item->ten }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Loại hình cơ sở</label>
                                <div class="col-lg-8">
                                    <select name="loaihinhcoso" class="form-control select2">
                                        <option value="">-----Chọn loại hình cơ sở-----</option>
                                        @foreach ($params['get_loai_hinh_co_so'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['loaihinhcoso']) &&
                                            $params['loaihinhcoso']==$item->id)
                                            selected
                                            @endif>
                                            {{ $item->loai_hinh_co_so }}
                                        </option>

                                        @endforeach
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
                                    <select name="coquanchuquan" class="form-control select2">
                                        <option value="">-----Chọn cơ quan chủ quản-----</option>
                                        @foreach ($params['get_co_quan_chu_quan'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['coquanchuquan']) &&
                                            $params['coquanchuquan']==$item->id)
                                            selected
                                            @endif>
                                            {{ $item->ten }}
                                        </option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Ngành nghề</label>
                                <div class="col-lg-8">
                                    <select name="nghe_id" id="" class="form-control select2">
                                        <option value="">-----Chọn ngành nghề-----</option>
                                        @forelse ($params['get_nganh_nghe'] as $item)
                                        <option value="{{ $item->id }}" @if(isset($params['nghe_id']) &&
                                            $params['nghe_id']==$item->id)
                                            selected
                                            @endif>

                                            {{ $item->id }} --- {{ $item->ten_nganh_nghe }}
                                        </option>
                                        @empty
                                        @endforelse
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
                                    <select name="dot" id="" class="form-control select2">
                                        <option value="">-----Chọn đợt-----</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.1'))
                                            selected @endif value="{{config('common.dot.1')}}">
                                            {{config('common.dot.1')}}</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.2'))
                                            selected @endif value="{{config('common.dot.2')}}">
                                            {{config('common.dot.2')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select name="nam" class="form-control select2">
                                        <option value="">-----Chọn năm-----</option>
                                        @foreach(config('common.nam.list') as $nam)
                                        <option @if(isset($params['nam']) && $params['nam']==$nam) selected @endif
                                            value="{{$nam}}">{{$nam}}</option>
                                        @endforeach
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
    <div class="row mb-5 bieumau">
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#modalExportBieuMau">
                <i class="fa fa-download" aria-hidden="true"></i>
                Tải xuống biểu mẫu
            </a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" id="upImport-file" data-target="#modalImport"><i
                    class="fa fa-upload" aria-hidden="true"></i>
                Tải lên file Excel</a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#modalExportData"><i class="fa fa-file-excel"
                    aria-hidden="true"></i>
                Xuất dữ liệu ra Excel</a>
        </div>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body">
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
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên cơ sở</th>
                        <th>Loại hình cơ sở</th>
                        <th>Cơ quan chủ quản</th>
                        <th>Tổng số </th>
                        <th>Năm</th>
                        <th>Đợt</th>
                        <th>Ngành Nghề</th>
                        <th>Chức năng</th>
                        @can('them_moi_danh_sach_doi_ngu_nha_giao')
                        <th>
                            <a target="_blank" href="{{ route('xuatbc.them-ds-nha-giao') }}"
                                class="btn btn-success btn-sm">Thêm mới</a>
                        </th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->ten }}</td>
                        <td>{{ $item->ten_loai_hinh_co_so }}</td>
                        <td>{{ $item->ten_co_quan_chu_quan }}</td>
                        <td>{{ $item->tong_so_can_bo }}</td>

                        <td>{{ $item->nam }}</td>
                        <td>{{ $item->dot }}</td>
                        <td>{{ $item->ten_nghe }}</td>
                        @can('chi_tiet_danh_sach_doi_ngu_nha_giao')
                        <td>
                            <a target="_blank"
                                href="{{ route('xuatbc.chi-tiet-theo-co-so',['co_so_id'=>$item->co_so_id]) }}"
                                class="btn btn-info btn-sm">Chi tiết</a>
                        </td>
                        @endcan

                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div>
                @if ($thongbao)
                <div class="thongbao border" style="color: red; text-align: center;">
                    <h4 class="m-portlet__head-text ">
                        {{$thongbao}}
                    </h4>
                </div>
                @endif
            </div>
            <div class="m-portlet__foot d-flex justify-content-end">
                {!! $data->links() !!}
            </div>
        </div>
    </div>

    <form action="{{ route('doi-ngu-nha-giao.export') }}" id="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="modalExportData" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Xuất dữ liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" id="closeExportModal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Chọn năm xuất</label>
                            <select name="nam" id="nam" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn đợt xuất</label>
                            <select name="dot" id="dot_id_xuat" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Trường</label>
                            <select multiple name="co_so_id[]" id="co_so_id" class="form-control select2">
                                @foreach($coSo as $csdt)
                                <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" onclick="closeModal('closeExportModal')"
                            id="submit">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('doi-ngu-nha-giao.export-bieu-mau') }}" method="post">
        @csrf
        <div class="modal fade" id="modalExportBieuMau" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hãy chọn trường</h5>
                        <button type="button" id="closeExportBieuMauModal" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="co_so_id" class="form-control">
                            @foreach($coSo as $csdt)
                            <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" onclick="closeModal('closeExportBieuMauModal')"
                            class="btn btn-primary">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('doi-ngu-nha-giao.import') }}" id="import" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                        <button type="button" class="close" data-dismiss="modal" id="closeImportModal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="errors" class="alert alert-danger d-none"></div>
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
                        <button type="submit" class="btn btn-primary" id="submitTai">Tải</a>
                            <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

</div>
</div>

@endsection
@section('script')
<script src="sweetalert2.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Thêm mới thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
<script>
    function closeModal(id) {
        $('#' + id).trigger('click');
    }
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function () {
        $('#page-size').change(function () {
            var coquanchuquan = $('[name="coquanchuquan"]').val();
            var loaihinhcoso = $('[name="loaihinhcoso"]').val();
            var co_so_id = $('[name="co_so_id"]').val();
            var dot = $('[name="dot"]').val();
            var nam = $('[name="nam"]').val();
            var nghe_id = $('[name="nghe_id"]').val();
            var page_size = $(this).val();
            var reloadUrl =
                `${currentUrl}?coquanchuquan=${coquanchuquan}&loaihinhcoso=${loaihinhcoso}&dot=${dot}&nam=${nam}&co_so_id=${co_so_id}&nghe_id=${nghe_id}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });

        // $('[name="co_so_id"]').select2();
        // $('[name="coquanchuquan"]').select2();
        // $('[name="nghe_id"]').select2();
        // $('[name="loaihinhcoso"]').select2();
        $('.select2').select2();
        $('span.select2').css('width', '100%');

    });

    $("#import").on('submit', function (event) {
        event.preventDefault();
        const formData = new FormData();
        const file = document.querySelector('#file_import_id');
        formData.append("file_import", file.files[0]);
        formData.append('nam', $("#nam_id").val());
        formData.append('dot', $("#dot_id").val());

        $('#modalImport').addClass('d-none');
        $('.loading').css('display','block');
        axios.post($(this).attr('action'), formData)
            .then(function (response) {
                $('.loading').css('display','none');
                $('#modalImport').removeClass('d-none');
                Swal.fire({
                    icon: 'success',
                    title: response.data.message,
                    timer: 3500
                }).then(function () {
                    $('#closeImportModal').trigger('click');
                });
            })
            .catch(function (error) {
                $('.loading').css('display','none');
                $('#modalImport').removeClass('d-none');
                if (error.response && error.response.status == 422) {
                    const errors = error.response.data.errors;
                    $("#errors").removeClass('d-none');
                    let htmlError = '';
                    _.forEach(errors, (value, key) => {
                        htmlError += `<li>${errors[key]}</li>`;
                    });

                    $("#errors").html(htmlError);
                }
            });
    })

</script>
@endsection