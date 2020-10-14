@extends('layouts.admin')
@section('title', "Thêm liên kết đào tạo")
@section('style')
<style>
  .batbuoc {
    color: red;
  }

  .error {
    color: red;
  }

  table input {
    border: 1px solid #000 !important;
  }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
  <form action="{{route('xuatbc.post-them-lien-ket-dao-tao', ['id' => 0])}}" id="validate-form-add" novalidate
    method="post">
    @csrf
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
              <i class="m-menu__link-icon flaticon-web"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Thêm mới liên kết đào tạo
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <div class="m-form__section m-form__section--first">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Tên cơ sở đào tạo</label>
                <div class="col-lg-8">
                  <select class="form-control select2" onchange="getdatacheck(this)" name="co_so_id" id="co_so_dao_tao">
                    <option value="">Chọn</option>
                    @foreach ($data as $item)
                    <option value="{{$item->id}}">{{$item->ten}}</option>
                    @endforeach
                  </select>
                  <label id="co_so_dao_tao-error" class="error" for="co_so_dao_tao"></label>
                  @error('co_so_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Năm</label>
                <div class="col-lg-8">
                  <select class="form-control select2" onchange="getdatacheck(this)" name="nam" id="nam">
                    <option value="">Chọn</option>
                    @foreach (config('common.nam_tuyen_sinh.list') as $item)
                    <option @if (isset($params['nam'])) {{( $params['nam'] ==  $item ) ? 'selected' : ''}} @endif
                      value="{{$item}}"> {{$item}}
                    </option>
                    @endforeach
                  </select>
                  <label id="nam-error" class="error" for="nam"></label>
                  @error('nam')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Tên nghề đào tạo</label>
                <div class="col-lg-8">
                  <select class="form-control select2" disabled onchange="getdatacheck(this)" name="nghe_id"
                    id="ma_nganh_nghe">
                    <option value="" selected>Mã ngành nghề</option>
                  </select>
                  <label id="nghe_id-error" class="error" for="nghe_id"></label>
                  @error('nghe_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Đợt</label>
                <div class="col-lg-8">
                  <select class="form-control select2" onchange="getdatacheck(this)" name="dot" id="dot">
                    <option value="" selected>Chọn</option>
                    <option value="1">Đợt 1</option>
                    <option value="2">Đợt 2</option>
                  </select>
                  <label id="dot-error" class="error" for="dot"></label>
                  @error('dot')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- start liên kết --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="m-portlet m-portlet--full-height ">
          <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                  Liên kết đào tạo
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="tab-content">
              <table class="table m-table m-table--head-bg-brand ">
                <tbody>
                  <tr>
                    <td>Chỉ tiêu</td>
                    <td><input type="number" min="0" step="1" name="chi_tieu" class="form-control name-field">
                      @error('chi_tieu')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>
                  </tr>
                  <tr>
                    <td>Thực tuyển</td>
                    <td><input type="number" min="0" step="1" name="thuc_tuyen" class="form-control name-field">
                      @error('thuc_tuyen')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>

                  </tr>
                  <tr>
                    <td>Số HSSV tốt nghiệp</td>
                    <td><input type="number" min="0" step="1" name="so_HSSV_tot_nghiep" class="form-control name-field">
                      @error('so_HSSV_tot_nghiep')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>
                  </tr>
                  <tr>
                    <td>Đơn vị liên kết </td>
                    <td><input type="text" name="don_vi_lien_ket" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td>Ghi chú </td>
                    <td>
                      <textarea class="form-control" name="ghi_chu" rows="3"
                        style="border: 1px solid #000000"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
    {{-- end liên kết --}}

    @if (session('thongbao'))
    <div class="thongbao" style="color: red; text-align: center;">
      {{session('thongbao')}}
    </div>
    @endif

    <div class="row mt-4" style="float: right">
      <div class="col-md-12">
        <a style="color: white;" href="{{route('xuatbc.tong-hop-lien-ket-dao-tao')}}"><button type="button"
            class="btn btn-danger mr-5">Hủy</button></a>
        <button type="submit" class="btn btn-primary">Thêm mới</button>

      </div>
    </div>
  </form>
</div>
@endsection
@section('script')
<script>
  var routeCheck = "{{ route('xuatbc.check-ton-tai-lien-ket-dao-tao', ['id' => 0]) }}";
 var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";

$(document).ready(function(){
  $('.select2').select2();
  
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('lien_ket_dao_tao/lien_ket_dao_tao.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
@endsection