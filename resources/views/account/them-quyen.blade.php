@extends('layouts.admin')
@section('title', 'Tạo quyền truy cập')
@section('content')
<style>
    .mx-n2{
        margin-left: -0.5rem!important;
        margin-right: -0.5rem!important;
    }
    .row-eq-height .m-portlet{
        height: 100%;
    }
    .row-eq-height .col-xl-6 px-2{
        margin-bottom: 15px;
    }
    .p-2.bd-highlight{
        padding-left: 30px!important;
    }
</style>
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-layers"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Thêm vai trò
                    </h3>
                </div>
            </div>
        </div>
        <form action="{{ route('account.them-quyen') }}" method="POST">
            @csrf
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="m-form__section m-form__section--first">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tên vai trò:</label>
                                    <div class="col-lg-12">
                                        <input type="text" value="" class="form-control m-input"
                                               placeholder="Tên vai trò..." name="name">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row row-eq-height mx-n2">
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">

                                <h4>Quản lý tài khoản</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_tai_khoan') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"
                                                   name="permissions[]">
                                            {{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý quyền</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_quyen') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"
                                                   name="permissions[]">
                                            {{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý cơ sở đào tạo</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_co_so_dao_tao') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox" value="{{$key}}"
                                                   name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Danh sách địa điểm đào tạo</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_dia_diem_dao_tao') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox" value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý ngành nghề</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_nganh_nghe') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý nhân sự</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_giao_vien') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Danh sách đội ngũ nhà giáo</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_doi_ngu_nha_giao') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Danh sách đội ngũ quản lý</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.doi_ngu_quan_ly') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý sinh viên đang theo học</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_sv_dang_theo_hoc') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý chính sách</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_tong_hop_chinh_sach') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý kết quả tuyển sinh</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_tuyen_sinh') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý kết quả tốt nghiệp</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_tot_nghiep') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý đăng kí chỉ tiêu</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_dang_ky_chi_tieu') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý xây dựng chương trình giáo trình</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_xay_dung_chuong_trinh_giao_trinh') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý đào tạo nghề</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_dao_tao_nghe_cho_nguoi_khuyet_tat') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h5>Đào tạo nghề cho thanh niên</h5>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_dao_tao_nghe_cho_thanh_nien') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span class=" d-flex justify-start-around"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Kết quả tốt nghiệp đào tạo nghề <br>
                                    gắn với doanh nghiệp</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.ket_qua_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep') as $key=>
                                $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Kết quả tuyển sinh, đào tạo nghề <br> gắn với doanh nghiệp</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.ket_qua_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep') as $key=>$item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span class=""></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý liên kết</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.tong_hop_lien_ket_lien_thong') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Liên kết liên thông trình độ Cao Đẳng lên Đại Học</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.lien_ket_lien_thong_cao_dang_len_dai_hoc') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Liên kết liên thông trình độ Trung Cấp lên Đại Học</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.lien_ket_lien_thong_trung_cap_len_dai_hoc') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý giáo dục nghề nghiệp</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.tong_hop_giao_duc_nghe_nghiep') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý tổng hợp, hợp tác quốc tế</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.tong_hop_hop_tac_quoc_te') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 px-2">
                        <div class="m-portlet">
                            <div class="m-portlet__body">
                                <h4>Quản lý phê duyệt</h4>
                                <button type="button" class="btn btn-info btn-sm tick-untick-all-option">Chọn/bỏ chọn tất cả</button>
                            </div>
                            <div class="">
                                @foreach (config('permissions_setting.quan_ly_phe_duyet') as $key=> $item)
                                    <div class="p-2 bd-highlight">
                                        <label class="m-checkbox m-checkbox--air m-checkbox--state-brand">
                                            <input type="checkbox"  value="{{$key}}" name="permissions[]">{{$item}}
                                            <span></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Lưu thông tin</button>
                    <button type="submit" class="btn btn-danger mx-2">Hủy bỏ</button>
                </div>
            </div>
    </div>
    </form>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.tick-untick-all-option').on('click', function(){

                let listCheckbox = $(this).parent().parent().find("input[type='checkbox']");
                debugger;
                let countChecked = 0;

                listCheckbox.each(function(index, element){
                    if($(element).is(":checked") == false){
                        countChecked++;
                    }
                });
                let checkStatus = countChecked > 0 ? true : false;
                listCheckbox.each(function(index, element){
                    $(element).prop('checked', checkStatus);
                });
            });
        });
    </script>
@endsection
