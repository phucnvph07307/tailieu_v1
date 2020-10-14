@extends('layouts.admin')
@section('title', "Chi tiết đào tạo nghề gắn với doanh nghiệp")
@section('style')
<style>
    th{
        border-top: 1px solid #ffffff !important;
    }
    .fa-eye{
        color: blue;
        cursor: pointer;
    }
</style>
@endsection
@section('content')

<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__body">
            <h3>Cơ sở đào tạo: {{$thongtincoso->ten}}</h3>
            <p>Loại hình cơ sở: {{$thongtincoso->loai_hinh_co_so}}</p>
            <p>Địa chỉ: {{$thongtincoso->dia_chi}}</p>
            <p>Phường/Xã: {{$thongtincoso->ten_xa_phuong}}</p>
            <p>Quận/Huyện: {{$thongtincoso->ten_quan_huyen}}</p>
        </div>
    </div>

    <div class="m-portlet">
        <form action="" method="get" class="m-form">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="nam" id="nam">
                                        <option value="" selected >Chọn</option>
                                        @foreach (config('common.nam_tuyen_sinh.list') as $item)
                                        <option 
                                        @if (isset($params['nam']))
                                                {{( $params['nam'] ==  $item ) ? 'selected' : ''}}  
                                                @endif
                                                value="{{$item}}"> {{$item}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select class="form-control" name="dot" id="dot">
                                        <option value="" >Chọn</option>
                                        <option
                                        @if (isset($params['dot']))
                                            {{( $params['dot'] ==  1 ) ? 'selected' : ''}}  
                                        @endif
                                        value="1" >Đợt 1</option>
                                        <option value="2"
                                        @if (isset($params['dot']))
                                        {{( $params['dot'] ==  2 ) ? 'selected' : ''}}  
                                        @endif
                                        >Đợt 2</option>
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
        </form>
    </div>

    <!-- Start content -->
    <div class="m-portlet">
        <div class="m-portlet__body">
            @if (session('thongbao')) 
            <div class="alert alert-success">
            {{session('thongbao')}}
            </div>
            @endif 
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="m-menu__link-icon flaticon-web"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Chi tiết <small>Thông tin tuyển sinh đào tạo nghề với doanh nghiệp</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if (isset($params['page_size']))
                            {{( $params['page_size'] ==  $size ) ? 'selected' : ''}} @endif value="{{$size}}">{{$size}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="table table-bordered m-table m-table--head-bg-primary table-responsive">
           
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th rowspan="2">Mã ngành</th>
                        <th rowspan="2">Tên ngành</th>
                        <th colspan="5">Kết quả tuyển sinh, đào tạo gắn với doanh nghiệp </th>
                        <th rowspan="2">Tên doanh nghiệp</th>
                        <th rowspan="2">Số HSSV được doanh nghiệp cam kết tuyển dụng sau tốt nghiệp (người)</th>
                        <th colspan="7">Nội dung hợp tác với doanh nghiệp </th>
                        <th rowspan="2">Thao tác</th>
                    </tr>
                    <tr class="pt-3 row2">
                        <th>Tổng số</th>
                        <th>Cao đẳng</th>
                        <th>Trung cấp</th>
                        <th>Sơ cấp</th>
                        <th>Dưới 3 tháng</th>

                        <th>Doanh nghiệp tham gia xây dựng chương trình, giáo trình đào tạo (bộ) </th>
                        <th>Doanh nghiệp tham gia giảng dạy (số giờ)</th>
                        <th>Doanh nghiệp hỗ trợ trang thiết bị và nguyên, nhiên vật liệu đào tạo (triệu đồng)</th>
                        <th>Doanh nghiệp hỗ trợ kinh phí đào tạo (triệu đồng)</th>
                        <th>Doanh nghiệp đặt hàng đào tạo (người)</th>
                        <th>Doanh nghiệp tiếp nhận HSSV vào thực tập (người)</th>
                        <th>Khác (ghi rõ nội dung)</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($limit * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                   
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>
                        <td>{{$item->nghe_id}}</td>
                        <td>{{$item->ten_nganh_nghe}}</td>
                        <td>{{$item->tong_so}}</td>
                        <td>{{$item->ket_qua_CD}}</td>
                        <td>{{$item->ket_qua_TC}}</td>
                        <td>{{$item->ket_qua_SC}}</td>
                        <td>{{$item->ket_qua_duoi_3_thang}}</td>
                        <td>{{$item->ten_doanh_nghiep}}</td>
                        <td>{{$item->so_HSSV_duoc_cam_ket}}</td>
                        <td>{{$item->doanh_nghiep_xay_dung_chuong_trinh}}</td>
                        <td>{{$item->doanh_nghiep_tham_gia_giang_day}}</td>
                        <td>{{$item->doanh_nghiep_bo_tro_trang_thiet_bi}}</td>
                        <td>{{$item->doanh_nghiep_ho_tro_kinh_phi_dao_tao}}</td>
                        <td>{{$item->doanh_nghiep_dat_hang_dao_tao}}</td>
                        <td>{{$item->doanh_nghiep_tiep_nhan_HSSV_thuc_tap}}</td>
                        <td><i class="fas fa-eye" data-toggle="modal" data-target="#myModal{{$item->id}}"></i></td>
                        @can('cap_nhat_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep')
                        <td>
                            @if ($item->trang_thai<3)  
                            <a href="{{route('xuatbc.dao-tao-nghe-doanh-nghiep.edit',['id'=>$item->id])}}">Sửa</a>
                            @endif
                        </td>
                        @endcan
                        
                    </tr>
                <div class="modal fade" id="myModal{{$item->id}}">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Nội dung hợp tác với doanh nghiệp (Khác)</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                {!!$item->khac!!}
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End content -->

    <form action="{{route('layformbieumausinhvien')}}" method="post">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hãy chọn trường</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select name="id_cs" class="form-control">
                            
                            <option value=""></option>
                           
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" onclick="clickDownloadTemplate()" class="btn btn-primary">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" id="my_form_kqts_import" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="exampleModalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" id="file_import_id" name="file_import">
                        </div>
                        <div class="form-group">
                            <label for="">Chọn năm</label>
                            <select name="nam" id="nam_id" class="form-control">
                              <option value="2020">2020</option>
                              <option value="2019">2019</option>
                              <option value="2018">2018</option>
                              <option value="2017">2017</option>
                              <option value="2016">2016</option>
                            </select> 
                       </div>

                        <div class="form-group">
                            <label for="">Chọn đợt</label>
                            <select name="dot" id="dot_id" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoi">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="submitTai">Tải</a>
                            <button type="submit" hidden class="btn btn-primary" id="submitTaiok">Tải ok</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" id="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade " id="exampleModalExportData" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xuất dữ liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Chọn năm xuất</label>
                            <select name="nam_muon_xuat" id="nam_id_xuat" class="form-control">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                              </select>
                        </div> 
                        <div class="form-group">
                            <label for="">Chọn đợt xuất</label>
                            <select name="dot_muon_xuat" id="dot_id_xuat" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Chọn Trường</label>
                            <select name="truong_id" id="truong_id_xuat" class="form-control">
                                <option value=""></option>
                                
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <p class="pt-1" style="color:red;margin-right: 119px" id="echoLoiXuat">
                        </p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        {{-- <button type="button" class="btn btn-primary" id="clickXuatData">Tải</a> --}}
                        <button type="submit" class="btn btn-primary" id="submitXuatData">Tải</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('script')
<script src="{!! asset('page_size/page_size.js') !!}"></script>
@endsection