@extends('layouts.admin')
@section('title', "Cập nhật sinh viên đang theo học")
@section('style')
{{-- <link href="{!! asset('tuyensinh/css/suatuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
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
<div class="m-content">
  @forelse ($data as $item)


  <form action="{{route('xuatbc.sua-so-sv', ['id'=> $item->id])}}" id="validate-form-update" method="post" novalidate>
    @csrf
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
              <i class="m-menu__link-icon flaticon-web"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Cập nhật<small>Sinh viên đang theo học</small>
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <div class="m-form__section m-form__section--first">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">Năm </label>
                <div class="col-lg-8">
                  <select disabled class=" form-control col-7 ">
                    <option value="{{$item->nam}}">{{$item->nam}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label disabled class="col-lg-2 col-form-label">Đợt</label>
                <div class="col-lg-8">
                  <select disabled class="form-control col-7">
                    <option {{( $item->dot == 1 ) ? 'selected' : ''}} value="1">Đợt 1</option>
                    <option {{( $item->dot == 2 ) ? 'selected' : ''}} value="2">Đợt 2</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label disabled class="col-lg-2 col-form-label">Ngành Nghề </label>
                <div class="col-lg-8">
                  <select disabled class="form-control col-7">
                    <option value="{{$item->nghe_id}}">{{$item->ten_nganh_nghe}} - {{$item->nghe_id}} </option>
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
    </div>

    <div class="m-portlet">
      <div class="m-portlet__body">

        <table class="table m-table m-table--head-bg-brand">
          <thead>
            <tr class=" text-center ">
              <th></th>
              <th>Cao Đẳng</th>
              <th>Trung Cấp</th>
              <th>Sơ Cấp</th>
              <th>Khác</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Số Lượng Sinh Viên</td>
              <td><input class="form-control name-field" name="so_luong_sv_Cao_dang" type="number"
                  value="{{$item ->so_luong_sv_Cao_dang}}">
                @error('so_luong_sv_Cao_dang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_Trung_cap" type="number"
                  value="{{$item ->so_luong_sv_Trung_cap}}">
                @error('so_luong_sv_Trung_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_So_cap" type="number"
                  value="{{$item ->so_luong_sv_So_cap}}">
                @error('so_luong_sv_So_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_he_khac" type="number"
                  value="{{$item ->so_luong_sv_he_khac}}">
                @error('so_luong_sv_he_khac')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <label id="so_luong_sv_Cao_dang-error" class="error" for="so_luong_sv_Cao_dang"></label>
              </td>
              <td>
                <label id="so_luong_sv_Trung_cap-error" class="error" for="so_luong_sv_Trung_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_So_cap-error" class="error" for="so_luong_sv_So_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_he_khac-error" class="error" for="so_luong_sv_he_khac"></label>
              </td>
            </tr>
            <tr>
              <td>Số Lượng Sinh Viên Nữ</td>
              <td><input class="form-control name-field" name="so_luong_sv_nu_Cao_dang" type="number"
                  value="{{$item ->so_luong_sv_nu_Cao_dang}}">
                @error('so_luong_sv_nu_Cao_dang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_nu_Trung_cap" type="number"
                  value="{{$item ->so_luong_sv_nu_Trung_cap}}">
                @error('so_luong_sv_nu_Trung_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_nu_So_cap" type="number"
                  value="{{$item ->so_luong_sv_nu_So_cap}}">
                @error('so_luong_sv_nu_So_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_nu_khac" type="number"
                  value="{{$item ->so_luong_sv_nu_khac}}">
                @error('so_luong_sv_nu_khac')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <label id="so_luong_sv_nu_Cao_dang-error" class="error" for="so_luong_sv_nu_Cao_dang"></label>
              </td>
              <td>
                <label id="so_luong_sv_nu_Trung_cap-error" class="error" for="so_luong_sv_nu_Trung_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_nu_So_cap-error" class="error" for="so_luong_sv_nu_So_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_nu_khac-error" class="error" for="so_luong_sv_nu_khac"></label>
              </td>
            </tr>
            <tr>
              <td>Số Lượng Sinh Viên Dân Tộc</td>
              <td><input class="form-control name-field" name="so_luong_sv_dan_toc_Cao_dang" type="number"
                  value="{{$item ->so_luong_sv_dan_toc_Cao_dang}}">
                @error('so_luong_sv_dan_toc_Cao_dang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_dan_toc_Trung_cap" type="number"
                  value="{{$item ->so_luong_sv_dan_toc_Trung_cap}}">
                @error('so_luong_sv_dan_toc_Trung_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_dan_toc_So_cap" type="number"
                  value="{{$item ->so_luong_sv_dan_toc_So_cap}}">
                @error('so_luong_sv_dan_toc_So_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_dan_toc_khac" type="number"
                  value="{{$item ->so_luong_sv_dan_toc_khac}}">
                @error('so_luong_sv_dan_toc_khac')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <label id="so_luong_sv_dan_toc_Cao_dang-error" class="error" for="so_luong_sv_dan_toc_Cao_dang"></label>
              </td>
              <td>
                <label id="so_luong_sv_dan_toc_Trung_cap-error" class="error"
                  for="so_luong_sv_dan_toc_Trung_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_dan_toc_So_cap-error" class="error" for="so_luong_sv_dan_toc_So_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_dan_toc_khac-error" class="error" for="so_luong_sv_dan_toc_khac"></label>
              </td>
            </tr>
            <tr>
              <td>Số Lượng Sinh Viên Hộ Khẩu Hà Nội</td>
              <td><input class="form-control name-field" name="so_luong_sv_ho_khau_HN_Cao_dang" type="number"
                  value="{{$item ->so_luong_sv_ho_khau_HN_Cao_dang}}">
                @error('so_luong_sv_ho_khau_HN_Cao_dang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_ho_khau_HN_Trung_cap" type="number"
                  value="{{$item ->so_luong_sv_ho_khau_HN_Trung_cap}}">
                @error('so_luong_sv_ho_khau_HN_Trung_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_ho_khau_HN_So_cap" type="number"
                  value="{{$item ->so_luong_sv_ho_khau_HN_So_cap}}">
                @error('so_luong_sv_ho_khau_HN_So_cap')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
              <td><input class="form-control name-field" name="so_luong_sv_ho_khau_HN_khac" type="number"
                  value="{{$item ->so_luong_sv_ho_khau_HN_khac}}">
                @error('so_luong_sv_ho_khau_HN_khac')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <label id="so_luong_sv_ho_khau_HN_Cao_dang-error" class="error"
                  for="so_luong_sv_ho_khau_HN_Cao_dang"></label>
              </td>
              <td>
                <label id="so_luong_sv_ho_khau_HN_Trung_cap-error" class="error"
                  for="so_luong_sv_ho_khau_HN_Trung_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_ho_khau_HN_So_cap-error" class="error"
                  for="so_luong_sv_ho_khau_HN_So_cap"></label>
              </td>
              <td>
                <label id="so_luong_sv_ho_khau_HN_khac-error" class="error" for="so_luong_sv_ho_khau_HN_khac"></label>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height ">
              <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                      Tổng số
                    </h3>
                  </div>
                </div>
              </div>
              <div class="m-portlet__body">
                <div class="tab-content">
                  <table class="table m-table m-table--head-bg-brand">
                    <thead>
                      <tr>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Trong đó</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Tổng số học sinh, sinh viên nữ</td>
                        <td><input name="tong_so_nu" type="number" min="0" step="1" class="form-control name-field"
                            value="{{$item->tong_so_nu}}">
                          @error('tong_so_nu')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          <label id="tong_so_nu-error" class="error" for="tong_so_nu"></label>
                        </td>
                      </tr>
                      <tr>
                        <td>Tổng số học sinh, sinh viên dân tộc</td>
                        <td><input name="tong_so_dan_toc_thieu_so" type="number" min="0" step="1"
                            class="form-control name-field" value="{{$item->tong_so_dan_toc_thieu_so}}">
                          @error('tong_so_dan_toc_thieu_so')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror

                          <label id="tong_so_dan_toc_thieu_so-error" class="error"
                            for="tong_so_dan_toc_thieu_so"></label>
                        </td>
                      </tr>
                      <tr>
                        <td>Tổng số học sinh, sinh viên hộ khẩu Hà Nội</td>
                        <td><input name="tong_so_ho_khau_HN" type="number" min="0" step="1"
                            class="form-control name-field" value="{{$item->tong_so_ho_khau_HN}}">
                          @error('tong_so_ho_khau_HN')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          <label id="tong_so_ho_khau_HN-error" class="error" for="tong_so_ho_khau_HN"></label></td>
                      </tr>
                      <tr>
                        <td>Tổng số học sinh, sinh viên các trình độ</td>
                        <td><input name="tong_so_HSSV_co_mat_cac_trinh_do" type="number" min="0" step="1"
                            class="form-control name-field" value="{{$item->tong_so_HSSV_co_mat_cac_trinh_do}}">
                          @error('tong_so_HSSV_co_mat_cac_trinh_do')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                          <label id="tong_so_HSSV_co_mat_cac_trinh_do-error" class="error"
                            for="tong_so_HSSV_co_mat_cac_trinh_do"></label></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center mr-5 ">
          <button type="submit" class="btn btn-danger btn-fillter ml-5">Hủy</button>
          <button type="submit" class="btn btn-primary btn-fillter ml-5">Sửa</button>
        </div>

      </div>
    </div>
  </form>
  @empty

  @endforelse
</div>
@endsection
@section('script')
<script src="{!! asset('chinh_sach_sinh_vien/validate-update-cssv.js') !!}"></script>
<script src="{!! asset('chinh_sach_sinh_vien/validate-number.js') !!}"></script>
@endsection