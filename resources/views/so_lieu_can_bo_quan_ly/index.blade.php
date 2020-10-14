@extends('layouts.admin')

@section('content')
<div class="m-content">
    @include('layouts.partials.filter', [
        'config' => $filterConfig,
    ])

    <div class="row mb-5 bieumau">
        <div class="col-lg-2">
            <a href="javascript:" data-toggle="modal" data-target="#exportBieuMauModal">
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
            <a href="javascript:" data-toggle="modal" data-target="#moDalExportData"><i class="fa fa-upload"
                    aria-hidden="true"></i>
                Xuất dữ liệu ra Excel</a>
        </div>
        @can('them_moi_danh_sach_doi_ngu_quan_ly')
        <div class="col-lg-6" style="text-align: right">
            <a href="{{ route('so-lieu-can-bo-quan-ly.create') }}"><button type="button" class="btn btn-secondary">Thêm mới</button></a>
            </div>
        @endcan
    </div>

    @include('layouts.partials.table', [
        'titles' => $titles,
        'data' => $data
    ])
</div>

{{-- thanhnv form import export --}}
@php
$routeLayFormBieuMau = 'layformbieumau.solieucanbo.quanly';
$routeImportError = 'import-error-so-lieu-quan-ly';
$routeExportData = 'exportdata.solieucanbo.quanly';
@endphp

@include('layouts.formExcel.from', [
    'routeLayFormBieuMau' => $routeLayFormBieuMau,
    'routeImportError' => $routeImportError,
    'routeExportData' => $routeExportData
])


@endsection
@section('title', "Số liệu cán bộ quản lý")

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
{{-- thanhnv update change to service 6/25/2020 --}}
<script>
    var routeImport = "{{route('import-so-lieu-quan-ly')}}";
</script>
<script src="{!! asset('excel-js/js-xuat-time.js') !!}"></script>
<script src="{!! asset('excel-js/js-form.js') !!}"></script>
{{-- end --}}
@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Thêm thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@if (session('update'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Cập nhật thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@endsection
