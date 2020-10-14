@extends('layouts.admin')
@section('title', "Chỉnh sửa kết quả tuyển sinh, đào tạo nghề gắn với doanh nghiệp")
@section('style')
{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<link href="{!! asset('tuyensinh/css/themtuyensinh.css') !!}" rel="stylesheet" type="text/css" /> --}}
<style>
  .batbuoc,.error {
    color: red;
  }
  table input {
    border: 1px solid #000 !important;
  }
  .note-editor.note-frame .note-editing-area .note-editable{
      padding: 20px;
  }
  .alert-danger{
    margin-top: 10px;
  }
</style>
<link href="{!! asset('/css/main.css') !!}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="m-content container-fluid">
  <form action="{{route('xuatbc.dao-tao-nghe-doanh-nghiep.update',['id'=>$data->id])}}" id="validate-form" method="post">

    @csrf
    <div class="m-portlet">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <span class="m-portlet__head-icon">
              <i class="m-menu__link-icon flaticon-web"></i>
            </span>
            <h3 class="m-portlet__head-text">
              Chỉnh sửa kết quả tuyển sinh, đào tạo nghề gắn với doanh nghiệp
            </h3>
          </div>
        </div>
      </div>
      <div class="m-portlet__body">
        <div class="m-form__section m-form__section--first">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-5 col-form-label">Tên cơ sở<span class="batbuoc">*</span></label>
                        <div class="col-lg-7">
                            <select class="form-control " disabled>
                                <option value="">{{$data->ten}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Năm<span class="batbuoc">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control "disabled >
                                <option value="">{{$data->nam}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-5 col-form-label">Nghề<span class="batbuoc">*</span></label>
                        <div class="col-lg-7">
                            <select class="form-control " disabled>
                            <option value="" selected>{{$data->nghe_id}}-{{$data->ten_nganh_nghe}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">Đợt<span class="batbuoc">*</span></label>
                        <div class="col-lg-10">
                            <select class="form-control " disabled>
                                <option value="" selected>{{$data->dot}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="m-portlet">
      <div class="m-portlet__body">
        <div class="m-form__section m-form__section--first">
          <div class="row">
          <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Tổng số kết quả tuyển sinh, đào tạo gắn với doanh nghiệp </label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->tong_so}}" name="tong_so"  class="form-control m-input" >
                    @error('tong_so')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Kết quả tuyển sinh, đào tạo Cao đẳng gắn với doanh nghiệp </label>
                <div class="col-lg-6">
                <input type="number"  value="{{$data->ket_qua_CD}}" name="ket_qua_CD"    class="form-control m-input" >
                @error('ket_qua_CD')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror  
              </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Kết quả tuyển sinh, đào tạo Trung cấp gắn với doanh nghiệp</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->ket_qua_TC}}" name="ket_qua_TC"    class="form-control m-input" >
                    @error('ket_qua_TC')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Kết quả tuyển sinh, đào tạo Sơ cấp gắn với doanh nghiệp</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->ket_qua_SC}}" name="ket_qua_SC"    class="form-control m-input" >
                    @error('ket_qua_SC')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Kết quả tuyển sinh, đào tạo dưới 3 tháng gắn với doanh nghiệp</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->ket_qua_duoi_3_thang}}" name="ket_qua_duoi_3_thang"    class="form-control m-input" >
                    @error('ket_qua_duoi_3_thang')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Tên doanh nghiệp</label>
                <div class="col-lg-6">
                    <input   value="{{$data->ten_doanh_nghiep}}" name="ten_doanh_nghiep"  class="form-control m-input" >
                    @error('ten_doanh_nghiep')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Số HSSV được doanh nghiệp cam kết tuyển dụng sau tốt nghiệp (người)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->so_HSSV_duoc_cam_ket}}" name="so_HSSV_duoc_cam_ket"    class="form-control m-input" >
                    @error('so_HSSV_duoc_cam_ket')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp tham gia xây dựng chương trình, giáo trình đào tạo (bộ) </label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_xay_dung_chuong_trinh}}" name="doanh_nghiep_xay_dung_chuong_trinh"    class="form-control m-input" >
                    @error('doanh_nghiep_xay_dung_chuong_trinh')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp tham gia giảng dạy (số giờ)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_tham_gia_giang_day}}" name="doanh_nghiep_tham_gia_giang_day"    class="form-control m-input" >
                    @error('doanh_nghiep_tham_gia_giang_day')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp hỗ trợ trang thiết bị và nguyên, nhiên vật liệu đào tạo (triệu đồng)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_bo_tro_trang_thiet_bi}}" name="doanh_nghiep_bo_tro_trang_thiet_bi"    class="form-control m-input" >
                    @error('doanh_nghiep_bo_tro_trang_thiet_bi')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp hỗ trợ kinh phí đào tạo (triệu đồng)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_ho_tro_kinh_phi_dao_tao}}" name="doanh_nghiep_ho_tro_kinh_phi_dao_tao"    class="form-control m-input" >
                    @error('doanh_nghiep_ho_tro_kinh_phi_dao_tao')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp đặt hàng đào tạo (người)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_dat_hang_dao_tao}}" name="doanh_nghiep_dat_hang_dao_tao"    class="form-control m-input" >
                    @error('doanh_nghiep_dat_hang_dao_tao')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group m-form__group row">
                <label class="col-lg-5 col-form-label">Doanh nghiệp tiếp nhận HSSV vào thực tập (người)</label>
                <div class="col-lg-6">
                    <input type="number"  value="{{$data->doanh_nghiep_tiep_nhan_HSSV_thuc_tap}}" name="doanh_nghiep_tiep_nhan_HSSV_thuc_tap"    class="form-control m-input" >
                    @error('doanh_nghiep_tiep_nhan_HSSV_thuc_tap')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row ">
                    <label cclass="col-lg-5 col-form-label">Khác (Ghi rõ nội dung)</label>
                    <div class="col-lg-9 col-md-9 colư-sm-12">
                        <textarea class="summernote" name="khac" id="" cols="30" rows="10">
                            {{$data->khac}}
                        </textarea>
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="row mt-4" style="float: right">
      <div class="col-md-12">
        <button type="button" class="btn btn-danger mr-5" style="width:90.28px"><a style="color: white;"
            href="{{route('xuatbc.dao-tao-nghe-doanh-nghiep.show',['id'=>$data->co_so_id])}}">Hủy</a></button>
        <button type="submit" class="btn btn-primary">Chỉnh sửa</button>

      </div>
    </div>
  </form>
</div>
@endsection
@section('script')
<script>
var routeCheck = "{{ route('so_lieu_tuyen_sinh.check_so_lieu') }}";
var routeGetMaNganhNghe = "{{ route('get_ma_nganh_nghe') }}";
$(document).ready(function(){
  $('#co_so_dao_tao').select2();
  $('#ma_nganh_nghe').select2();
});
</script>
<script>
  $('.summernote').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
      ],
});
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{!! asset('tuyensinh/js/tuyensinh.js') !!}"></script>
<script src="{!! asset('assets/demo/custom/crud/forms/widgets/summernote.js') !!}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="{!! asset('validate/validate_store_update.js') !!}"></script>
@endsection