@extends('layouts.admin')

@section('title', "Chi tiết danh sách đội ngũ cán bộ quản lý")

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
                        Chi tiết <small>Số liệu đội ngũ quản lý</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <h3>Cơ sở đào tạo: {{ $coSoDaoTao->ten }}</h3>
            <p>Loại hình cơ sở: {{ $coSoDaoTao->loai_hinh_co_so }}</p>
        </div>
    </div>

    @include('layouts.partials.table', [
        'titles' => config('tables.so_lieu_can_bo_quan_ly_show'),
        'data' => $listSoLieu,
    ])
</div>
@endsection

@section('script')
<script src="{{ asset('js/common/index_table.js') }}"></script>
@endsection
