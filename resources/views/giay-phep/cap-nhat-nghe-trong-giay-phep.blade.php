@extends('layouts.admin');
@section('title', 'Cập nhật nghề trong giấy phép')
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
                        Cập nhật nghề trong giấy phép
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div>
                @if(isset($data))
                <form action="{{route('giay-phep.cap-nhat-nghe-trong-giay-phep', ['id' => $data->id])}}" method="post"
                    class="d-flex justify-content-center">
                    {{ csrf_field() }}
                    <div class="col-6">
                        <input type="hidden" name="giay_phep_id" value="{{$data->giay_phep_id}}">
                        <input type="hidden" name="co_so_id" value="{{$data->co_so_id}}">
                        <div class="form-group mb-5">
                            <label class="col-form-label">Ngành nghề</label>
                            <div class="">
                                <select id="chon-nghe-trung-cap" name="nghe_id" class="form-control">
                                    @foreach ($nganhNghe as $nghe)
                                    <option value="{{ $nghe->id }}" @if($nghe->id == $data->nghe_id) selected @endif>
                                        {{ $nghe->id }} - {{ $nghe->ten_nganh_nghe }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="Err-chon_nghe_trung_cap"></span>
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label class="col-form-label">Quy mô tuyển sinh</label>
                            <div class="">
                                <input type="number" value="{{ $data->quy_mo_tuyen_sinh }}" name="quy_mo_tuyen_sinh"
                                    class="form-control">
                                @error('quy_mo_tuyen_sinh')
                                <span class="text-danger" id="Err-quy_mo_tuyen_sinh">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-4">Cập nhật</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        
        $('.form-control').attr('autocomplete', 'off');

        $('#chon-nghe-trung-cap').select2({
            placeholder: "Tìm kiếm ngành nghề",
        });
    });
</script>
@endsection