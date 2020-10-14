@extends('layouts.admin');
@section('title', 'Danh sách giấy phép')
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
                        Danh sách giấy phép
                    </h3>
                </div>
            </div>
        </div>
        @if (count($defaultCsdt) > 0)
        <div class="m-portlet__body">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h5 class="m-portlet__head-text">
                        Thông tin cơ sở: <b>
                            {{ $defaultCsdt['text'] }}
                        </b>
                    </h5>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="m-portlet">
        <div class="m-portlet__body">
            @if (\Session::has('mess-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong>{!! \Session::get('mess-success') !!}</strong>
            </div>
            @endif

            @if (count($defaultCsdt) > 0)
            <table class="table m-table m-table--head-bg-brand table-reponsive">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên giấy phép</th>
                        <th>Ngày ban hành</th>
                        <th>Ngày hiệu lực</th>
                        <th>Ngày hết hạn</th>
                        <th>Ảnh giấy phép</th>
                        <th>@if (count($defaultCsdt) > 0)
                            <a href="{{ route('giay-phep.tao-moi', ['id' => $defaultCsdt['id']] )}}"
                                class="btn btn-success btn-sm">Thêm mới</a>
                            @endif</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $id = 1;
                    @endphp
                    @forelse ($data as $item)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $item->ten_giay_phep }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ngay_ban_hanh)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ngay_hieu_luc)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->ngay_het_han)->format('d-m-Y') }}</td>
                        <td><a href="{!! asset('storage/' . $item->anh_giay_phep) !!}" target="_blank"><i
                                    class="fas fa-eye"></i> xem ảnh</a></td>
                        <td>
                            @if (count($defaultCsdt) > 0)
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('giay-phep.chi-tiet', ['giay_phep_id' => $item->id, 'co_so_id' => $defaultCsdt['id']]) }}">Xem
                                chi tiết</a>
                            @endif
                            {{-- <form action="{{ route('giay-phep.chi-tiet') }}" method="get">
                            <input type="hidden" name="giay_phep_id" value="{{$item->id}}">
                            @if (count($defaultCsdt) > 0)
                            <input type="hidden" name="co_so_id" value="{{$defaultCsdt['id']}}">
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm">Xem chi tiết</button>
                            </form> --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-danger">Cơ sở hiện không có giấy phép nào</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            @else
            <h5 class="text-center text-danger">Vui lòng chọn trường</h5>
            @endif

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function(){
        $('#co-so-id-js').select2({
            ajax: {
                url: '{{route('co-so-dao-tao.api-search-co-so-dao-tao')}}',
                method: 'POST',
                data: function(params){
                    var query = {
                        keyword: params.term || '',
                        page: params.page || 1
                    }
                    return query;
                },
                cache: true,
                dataType: 'json',
                processResults: function (data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                }
            }
        });
        $('#co-so-id-js').on('change', function(){
            var csdtId = $(this).val();
            window.location.href = `${currentUrl}/${csdtId}`;
        });
    }); 
</script>
@endsection