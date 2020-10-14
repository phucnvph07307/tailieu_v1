@extends('layouts.admin')
@section('title', "Cập nhật liên kết đào tạo")
@section('style')
{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<link href="{!! asset('tuyensinh/css/themtuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
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
  <form
    action="{{route('xuatbc.post-sua-lien-ket-dao-tao', ['id' => $data->id , 'bac_nghe' => $bac_nghe, 'co_so_id' => $data->co_so_id])}}"
    id="validate-form-update" method="post">
    @csrf
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
              <i class="m-menu__link-icon flaticon-web"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Chỉnh sửa liên kết đào tạo
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
                  <select class="form-control " name="ten_co_so" id="ten_co_so" disabled>
                    <option value="">{{$data->ten}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Năm</label>
                <div class="col-lg-8">
                  <select class="form-control " name="nam" id="nam" disabled>
                    <option value="">{{$data->nam}}</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Tên nghề đào tạo</label>
                <div class="col-lg-8">
                  <select class="form-control " name="ten_nganh_nghe" id="ten_nganh_nghe" disabled>
                    <option value="">{{$data->nghe_id}} - {{$data->ten_nganh_nghe}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Đợt</label>
                <div class="col-lg-8">
                  <select class="form-control " name="dot" id="dot" disabled>
                    <option value="">{{$data->dot}}</option>

                  </select>
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
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="tab-content">
              <table class="table m-table m-table--head-bg-brand">
                <tbody>
                  <tr>
                    <td>Chỉ tiêu</td>
                    <td><input type="number" min="0" step="1" name="chi_tieu" class="form-control name-field"
                        value="{{$data->chi_tieu}}">
                      @error('chi_tieu')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>
                  </tr>
                  <tr>
                    <td>Thực tuyển </td>
                    <td><input type="number" min="0" step="1" name="thuc_tuyen" class="form-control name-field"
                        value="{{$data->thuc_tuyen}}">
                      @error('thuc_tuyen')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>
                  </tr>
                  <tr>
                    <td>Số HSSV tốt nghiệp</td>
                    <td><input type="number" min="0" step="1" name="so_HSSV_tot_nghiep" class="form-control name-field"
                        value="{{$data->so_HSSV_tot_nghiep}}">
                      @error('so_HSSV_tot_nghiep')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </td>
                  </tr>
                  <tr>
                    <td>Đơn vị liên kết </td>
                    <td><input type="text" name="don_vi_lien_ket" class="form-control"
                        value="{{$data->don_vi_lien_ket}}"></td>
                  </tr>
                  <tr>
                    <td>Ghi chú </td>
                    <td>
                      <textarea class="form-control" name="ghi_chu" rows="3" style="border: 1px solid #000000">
                      {{$data->ghi_chu}}
                      </textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4" style="float: right">
      <div class="col-md-12">
        <a style="color: white;"
          href="{{route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $data->co_so_id, 'bac_nghe' => $bac_nghe])}}">
          <button type="button" class="btn btn-danger mr-5">Hủy</button></a>

        @if ($data->trang_thai >= 3)
        @else
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        @endif

      </div>
    </div>
  </form>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
<script src="{!! asset('lien_ket_dao_tao/validate-update-lkdt.js') !!}"></script>
@endsection