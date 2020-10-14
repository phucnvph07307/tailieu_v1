@extends('layouts.admin');
@section('title', 'Bổ sung nghề vào chi nhánh')
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
                        Bổ sung nghề vào chi nhánh
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form action="">
                <div class="form-group col-lg-12">
                    <label class="form-name" for="">Chọn nghề cao đẳng</label>
                    <select class="form-control" multiple name="nghe_cao_dang[]" id="chon-nghe-cao-dang">
                        @forelse ($dsNghe as $item)
                        <option value="{{ $item->ma_nghe }}">{{ $item->ma_nghe }} - {{ $item->ten_nghe }}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label class="form-name" for="">Chọn nghề trung cấp</label>
                    <select class="form-control" multiple name="nghe_trung_cap[]" id="chon-nghe-trung-cap">
                        @forelse ($dsNghe as $item)
                        <option value="{{ $item->ma_nghe }}">{{ $item->ma_nghe }} - {{ $item->ten_nghe }}</option>
                        @empty

                        @endforelse
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#chon-nghe-cao-dang').select2();
    });

</script>
@endsection