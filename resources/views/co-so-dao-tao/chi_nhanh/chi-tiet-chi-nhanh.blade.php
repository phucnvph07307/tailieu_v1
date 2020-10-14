@extends('layouts.admin');
@section('title', 'Thông tin địa điểm đào tạo')
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
                        {{-- <i class="m-menu__link-icon flaticon-web"></i> --}}
                    </span>
                    <h3 class="m-portlet__head-text">
                        Thông tin chi tiết địa điểm đào tạo
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <ul class="list-highlight-row ul-chi-tiet-csdt p-4">
                @forelse ($data as $item)
                {{-- @php
                    dd($item)
                @endphp --}}
                <li>
                    <h5>Cơ sở trực thuộc</h5>
                    <h5 class="co-so-info">{{$item->csdt_ten}}</h5>
                </li>

                <li>
                    <h5>Mã chứng nhận hoạt động</h5>
                    <h5 class="co-so-info">{{ $item->ma_chung_nhan_dang_ki_hoat_dong }}</h5>
                </li>

                <li>
                    <h5>Điện thoại</h5>
                    <h5 class="co-so-info">{{ $item->hotline}}</h5>
                </li>

                <li>
                    <h5>Xã/phường, Quận/Huyện</h5>
                    <h5 class="co-so-info">{{ $item->tenxaphuong}}, {{ $item->tenquanhuyen }}</h5>
                </li>

                <li>
                    <h5>Địa chỉ</h5>
                    <h5 class="co-so-info">{{ $item->dia_chi}}</h5>
                </li>
                <li class="d-flex flex-column">
                    <div class="row col-lg-12">
                        <a href="{{route('chi-nhanh.danh-sach-nghe', ['id' => $item->id])}}"
                            class=" btn btn-outline-info col-lg-5 col-md-5 m-2">Xem danh sách ngành nghề</a>
                        <a href="" class=" btn btn-outline-info col-lg-5 col-md-5 m-2">Xem danh sách nhân sự</a>
                    </div>
                </li>
                @empty
                <h5>Không tìm thấy cơ sở đào tạo</h5>
                @endforelse

            </ul>
        </div>
    </div>
</div>
@endsection