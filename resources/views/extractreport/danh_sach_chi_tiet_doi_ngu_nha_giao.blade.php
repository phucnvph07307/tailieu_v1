@extends('layouts.admin')
@section('title', "Chi tiết số liệu đội ngũ đào tạo")
@section('style')
<style>
    .m-table.m-table--border-danger,
    .m-table.m-table--border-danger th,
    .m-table.m-table--border-danger td {
        border-color: #bcb1b1;
    }

    table thead th[colspan="4"],
    th[colspan="5"] {
        border-bottom-width: 1px;
        border-bottom: 1px solid #bcb1b1 !important;
    }
    pre{
        font-size: 100%;
    }
</style>
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
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
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
                        <div class="col-md-6 ">
                            <div class="form-group m-form__group row">
                                <label for="" class="col-lg-2 col-form-label">Đợt</label>
                                <div class="col-lg-8">
                                    <select name="dot" id="" class="form-control select2">
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
        <div class="m-portlet__body">
            <div class="col-12 form-group m-form__group d-flex justify-content-end">
                <label class="col-lg-2 col-form-label">Kích thước:</label>
                <div class="col-lg-2">
                    <select class="form-control" id="page-size">
                        @foreach(config('common.paginate_size.list') as $size)
                        <option @if($params['page_size']==$size) selected @endif value="{{$size}}">{{$size}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <h3>Cơ sở đào tạo: {{$thongtincoso[0]->ten}}</h3>
            </div>
            <table
                class=" text-center table table-bordered m-table m-table--border-danger m-table--head-bg-primary table-responsive border table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" class="border"><pre class="text-white">STT</pre></th>
                        <th rowspan="2" class="border"><pre class="text-white">Năm</pre></th>
                        <th rowspan="2" class="border"><pre class="text-white">Đợt</pre></th>
                        <th rowspan="2" class="border"><pre class="text-white">Mã nghề</pre></th>
                        <th rowspan="2" class="border"><pre class="text-white">Tên nghề</pre></th>
                        <th rowspan="2" class="border"><pre class="text-white">Tổng số</pre></th>
                        <th colspan="7" class="border">Trong đó</th>
                        <th colspan="2" class="border">Chia theo cư hữu</th>
                        <th colspan="6" class="border">Chia theo trình độ chuyên môn</th>
                        <th colspan="6" class="border">Chia theo trình độ ngoại ngữ</th>
                        <th colspan="2" class="border">Chia theo trình độ tin học</th>
                        <th colspan="3" class="border">Chia theo trình độ kỹ năng nghề</th>
                        <th colspan="3" class="border">Chia theo trình độ nghiệp vụ sư phạm</th>
                        <th rowspan="2" class="border">
                            <pre
                                class="text-white">Số nhà giáo <br>tham gia <br>đào tạo,<br>bồi dưỡng <br>trong năm</pre>
                        </th>
                        @can('cap_nhat_danh_sach_doi_ngu_nha_giao')
                        <th rowspan="2" class="border">
                            <pre class="text-white">Tác vụ</pre>
                        </th>
                        @endcan
                    </tr>

                    <tr class="pt-3 row2">
                        <th class="border">
                            <pre class="text-white">Nữ</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Dân tộc ít người</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Giáo sư</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Phó giáo sư</pre>
                        </th>
                        <th class="border">
                            <pre
                                class="text-white">Nhà giáo nhân dân,<br>nghệ sĩ nhân dân,<br>nghệ nhân nhân dân,<br>thầy thuốc nhân dân</pre>
                        </th>
                        <th class="border">
                            <pre
                                class="text-white">Nhà giáo ưu tú,<br>nghệ sĩ ưu tú,<br>nghệ nhân ưu tú,<br>thầy thuốc ưu tú</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Nhà giáo giảng dạy<br>môn học chung</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Biên chế</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Hợp đồng<br>(từ 1 năm trở lên)</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Tiến sỹ</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Thạc sỹ</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Đại học</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Cao đẳng</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Trung cấp</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Trình độ khác</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 1</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 2</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 3</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 4</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 5</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Bậc 6</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Cơ bản</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Nâng cao</pre>
                        </th>

                        <th class="border">
                            <pre class="text-white">Chính chỉ KNN quốc gia bậc 1 <br> (tương đương)</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Chính chỉ KNN quốc gia bậc 2 <br> (tương đương)</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Chính chỉ KNN quốc gia bậc 3 <br> (tương đương)</pre>
                        </th>


                        <th class="border">
                            <pre class="text-white">Chính chỉ sư phạm <br> dạy trình độ CĐ</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Chính chỉ sư phạm <br> dạy trình độ TC</pre>
                        </th>
                        <th class="border">
                            <pre class="text-white">Chính chỉ sư phạm <br> dạy trình độ SC</pre>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = !isset($_GET['page']) ? 1 : ($params['page_size'] * ($_GET['page']-1) + 1);
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$item->nam}}</td>
                        <td>{{$item->dot}}</td>
                        <td>{{$item->nghe_id}}</td>
                        <td>{{$item->ten_nghe}}</td>
                        <td>{{$item->tong_so_can_bo}}</td>

                        <td>{{$item->so_luong_nu}}</td>
                        <td>{{$item->dan_toc_it_nguoi}}</td>
                        <td>{{$item->giao_su}}</td>
                        <td>{{$item->pho_giao_su}}</td>
                        <td>{{$item->NGND_NSND_NNND_TTND}}</td>
                        <td>{{$item->NGUT_NSUT_NNUT_TTUT}}</td>
                        <td>{{$item->nha_giao_giang_day_mon_hoc_chung}}</td>

                        <td>{{$item->bien_che}}</td>
                        <td>{{$item->hop_dong_1_nam_tro_len}}</td>

                        <td>{{$item->so_tien_sy}}</td>
                        <td>{{$item->so_thac_si}}</td>
                        <td>{{$item->so_dai_hoc}}</td>
                        <td>{{$item->so_cao_dang}}</td>
                        <td>{{$item->so_trung_cap}}</td>
                        <td>{{$item->so_khac}}</td>

                        <td>{{$item->bac1}}</td>
                        <td>{{$item->bac2}}</td>
                        <td>{{$item->bac3}}</td>
                        <td>{{$item->bac4}}</td>
                        <td>{{$item->bac5}}</td>
                        <td>{{$item->bac6}}</td>

                        <td>{{$item->trinh_do_tin_hoc_co_ban}}</td>
                        <td>{{$item->trinh_do_tin_hoc_nang_cao}}</td>

                        <td>{{$item->chung_chi_KNN_quoc_gia_bac_1}}</td>
                        <td>{{$item->chung_chi_KNN_quoc_gia_bac_2}}</td>
                        <td>{{$item->chung_chi_KNN_quoc_gia_bac_3}}</td>

                        <td>{{$item->chung_chi_su_pham_day_trinh_do_CD}}</td>
                        <td>{{$item->chung_chi_su_pham_day_trinh_do_TC}}</td>
                        <td>{{$item->chung_chi_su_pham_day_trinh_do_SC}}</td>

                        <td>{{$item->so_nha_giao_tham_gia_dao_tao}}</td>

                        @can('cap_nhat_danh_sach_doi_ngu_nha_giao')
                        <td>
                            <a class="btn btn-sm btn-primary" target="_blank"
                                href="{{route('xuatbc.sua-ds-nha-giao',['id'=>$item->id])}}">
                                Sửa</a>
                        </td>
                        @endcan
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
            {{$data->links()}}
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var currentUrl = `{{route($route_name,['co_so_id'=>$thongtincoso[0]->id])}}`;
    $(document).ready(function () {
        $('#page-size').change(function () {
            var dot = $('[name="dot"]').val();
            var nam = $('[name="nam"]').val();
            var page_size = $(this).val();
            var reloadUrl = `${currentUrl}?dot=${dot}&nam=${nam}&page_size=${page_size}`;
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