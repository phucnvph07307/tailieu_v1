@extends('layouts.admin')
@section('content')
<div class="m-content">
    @include('layouts.partials.filter', [
    'config' => $filterConfig,
    ])

    <div class="row mb-5 bieumau">
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-download" aria-hidden="true"></i>
                Tải xuống biểu mẫu
            </a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" id="upImport-file" data-target="#moDalImport"><i
                    class="fa fa-upload" aria-hidden="true"></i>
                Tải lên file Excel</a>
        </div>
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#exampleModalExportData"><i class="fa fa-file-excel"
                    aria-hidden="true"></i>
                Xuất dữ liệu ra Excel</a>
        </div>
        <div class="col-lg-6 " style="text-align: right">
            @can('them_moi_quan_ly_giao_vien')
            <a href="{{ route('ql-giao-vien.create') }}"><button type="button" class="btn btn-secondary">Thêm
                    mới</button></a>
            @endcan
        </div>
    </div>

    @include('layouts.partials.table', [
    'titles' => $titles,
    'data' => $data
    ])
</div>

<form action="{{route('export-bieu-mau-doi-ngu-nha-giao')}}" method="post">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hãy chọn trường</h5>
                    <button type="button" id="closeFileBieuMau" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="id_cs" class="form-control">
                        @foreach($coso as $csdt)
                        <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" onclick="closeModal('closeFileBieuMau')" class="btn btn-primary">Tải</a>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{route('import-error-quan-ly-giao-vien')}}" id="form_import_file" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="modal fade " id="moDalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                    <button type="button" id="closeImportFile" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" id="file_import_id" name="file_import">
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                    </p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary"  id="submitTai">Tải</a>
                        <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{route('export-data-doi-ngu-nha-giao')}}" id="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade " id="exampleModalExportData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xuất dữ liệu</h5>
                    <button type="button" id='closeXuatDuLieu' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Chọn Trường</label>
                        <select name="truong_id" id="truong_id_xuat" class="form-control">
                            @foreach($coso as $csdt)
                            <option value="{{$csdt->id}}">{{$csdt->ten}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                    </p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" onclick="closeModalModel()"
                        id="submitXuatData">Tải</a>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection

@section('title', "Danh sách giáo viên")

@section('style')
<link href="{!! asset('css/main.css') !!}" rel="stylesheet" type="text/css" />
<style>
    table.table-responsive {
        display: table;
    }
</style>
@endsection

@section('script')
<script src="{{ asset('js/common/index_table.js') }}"></script>
<script src="{{ asset('js/common/filter.js') }}"></script>

{{-- thanhvn update js 6/26/2020 --}}
<script>
  function closeModalModel(){
       $('#closeXuatDuLieu').trigger('click');
  }
    var routeImport = "{{route('import-quan-ly-giao-vien')}}";
</script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
{{-- end --}}
@endsection
