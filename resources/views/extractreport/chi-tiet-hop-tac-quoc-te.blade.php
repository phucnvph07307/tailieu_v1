@extends('layouts.admin')
@section('title', "Chi tiết kết quả hợp tát quốc tế")
@section('style')
@endsection
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
                        Chi tiết <small>Thông tin đội ngũ đào tạo</small>
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
       
            <h3>Cơ sở đào tạo: {{$thongtincoso[0]->ten}}</h3>
            <p>Loại hình cơ sở: {{$thongtincoso[0]->loai_hinh_co_so}}</p>
            <p>Địa chỉ: {{$thongtincoso[0]->dia_chi}}</p>
            <p>Phường/Xã: {{$thongtincoso[0]->tenxaphuong}}</p>
            <p>Quận/Huyện: {{$thongtincoso[0]->tenquanhuyen}}</p>
      
          

        </div>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Chi tiết<small>kết quả hợp tác quốc tế</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form pt-5">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Năm</label>
                                <div class="col-lg-8">
                                    <select name="nam" class="form-control select2">
                                        <option value="">-----Chọn năm-----</option>

                                        @foreach(config('common.nam.list') as $nam)
                                        <option @if(isset($params['nam']) && $params['nam']==$nam) selected @endif
                                            value="{{$nam}}">{{$nam}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select name="dot" class="form-control select2">
                                        <option value="">-----Chọn đợt-----</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.1'))
                                            selected @endif value="{{config('common.dot.1')}}">
                                            {{config('common.dot.1')}}</option>
                                        <option @if(isset($params['dot']) && $params['dot']==config('common.dot.2'))
                                            selected @endif value="{{config('common.dot.2')}}">
                                            {{config('common.dot.2')}}</option>

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
    <div class="m-portlet">
        <div class="m-portlet__body table-responsive">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div> 
            <div class="row justify-content-center">
            <h3>Cơ sở đào tạo: {{$thongtincoso[0]->ten}}</h3>
            </div>
            <table class="table table-bordered m-table m-table- m-table--head-bg-primary table-boder-white ">
                              
                <thead>
                    <tr class="text-center">
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Tên đơn vị</th>
                        <th rowspan="2">Năm</th>
                        <th rowspan="2">Đợt</th>
                        <th colspan="4">Kết quả tuyển sinh theo chương trình hợp tác quốc tế</th>
                        <th colspan="3">Số học sinh được cấp bằng tốt nghiệp theo hình thức hợp tác quốc tế</th>
                        <th rowspan="2">Số học sinh có việc làm sau khi tốt nghiệp chương trình hợp tác quốc tế</th>
                        <th rowspan="2">Số lượng chương trình,giáo trình xây dựng , phát triển theo hình thức hợp tác
                            quốc tế</th>
                        <th colspan="3">Hợp tác quốc tế trong đào tạo , bồi dưỡng giáo viên , cán bộ quản lý</th>
                        <th colspan="3">Hợp tác quốc tế trong đầu tư cơ sở vật chất , trang thiết bị</th>
                        <th rowspan="2">Thao tác</th>

                    </tr>
                    <tr class="text-center">
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Cao đẳng</th>
                        <th rowspan="2">Trung cấp</th>
                        <th rowspan="2">Sơ cấp</th>
                        <th rowspan="2">Tổng số</th>
                        <th rowspan="2">Số HS được các đơn vị/tổ chức nước ngoài hợp tác đào tạo cấp bằng</th>
                        <th rowspan="2">Số HS được nhà nước cấp bằng theo hình thức hợp tác quốc tế</th>
                        <th rowspan="2">Tổng số </th>
                        <th rowspan="2">Số giáo viên được đào tạo , bồi dưỡng , tập huấn</th>
                        <th rowspan="2">Số cán bộ quản lý được đào tạo , bồi dưỡng , tập huấn</th>
                        <th rowspan="2">Số phòng học đầu tư</th>
                        <th rowspan="2">Số nhà xưởng thực hành được đầu tư</th>
                        <th rowspan="2">Tổng kinh phí đầu tư trang thiết bị , máy móc</th>
                     
                    </tr>

                </thead>
                <tbody>
                    @php
                   $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->ten_co_so }}</td>
                        <td>{{ $item->nam }}</td>
                        <td>{{ $item->dot }}</td>

                        <td><b>{{ $item->tong_tuyen_sinh }}</b></td>
                        <td>{{ $item->tong_tuyen_sinh_CD }}</td>
                        <td>{{ $item->tong_tuyen_sinh_TC }}</td>
                        <td>{{ $item->tong_tuyen_sinh_SC }}</td>

                        <td><b>{{ $item->tong_so_hs_duoc_cap_bang }}</b></td>
                        <td>{{ $item->so_hs_duoc_cac_don_vi_cap_bang }}</td>
                        <td>{{ $item->so_hs_duoc_nha_truong_cap_bang }}</td>

                        <td>{{ $item->so_hs_co_viec_lam_sau_khi_tot_nghiep }}</td>
                        <td>{{ $item->so_luong_chuong_trinh_xay_dung_phat_trien }}</td>

                        <td><b>{{ $item->tong_hop_tac_quoc_te_trong_dao_tao_boi_duong }}</b></td>
                        <td>{{ $item->so_gv_duoc_dao_tao_boi_duong }}</td>
                        <td>{{ $item->so_can_bo_quan_ly_duoc_dao_tao_boi_duong }}</td>

                        <td>{{ $item->so_phong_hoc_duoc_dau_tu }}</td>
                        <td>{{ $item->so_nha_xuong_duoc_dau_tu }}</td>
                        <td><b>{{ ($item->tong_kinh_phi / 1000000) }}</b></td>

                        <td>
                            <a class="btn btn-sm btn-primary" target="_blank" href="{{route('xuatbc.sua-ds-hop-tac-qte',['id'=>$item->id])}}">
                                Sửa</a>                        
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div>
            @if ($thongbao)
            <div class="thongbao border" style="color: red; text-align: center;">
                <h4 class="m-portlet__head-text ">
                    {{$thongbao}}
                </h4>
            </div>
            @endif
        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
            {!! $data->links() !!}

        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

    var currentUrl = `{{route($route_name,['co_so_id'=>$thongtincoso[0]->id])}}`;
    $(document).ready(function () {
        $('#page-size').change(function () {
            var dot = $('[name="dot"]').val();
            var nam = $('[name="nam"]').val();
            var page_size = $(this).val();
            var reloadUrl =
                `${currentUrl}?dot=${dot}&nam=${nam}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });
        $('.select2').select2();

    });

</script>
@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Cập nhật thành công !',
        showConfirmButton: false,
        timer: 3500
    })
</script>
@endif
@endsection
