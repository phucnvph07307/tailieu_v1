@extends('layouts.admin')
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
                        Danh sách <small>phê duyệt báo cáo</small>
                    </h3>
                </div>
            </div>
        </div>
        {{-- <form action="">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="col-12 form-group m-form__group">
                        <div class="col-12 d-flex">
                            <div class="form-group mr-4 col-6">
                                <label for="">Tên nghề:</label>
                                <select class="form-control" name="" id="">
                                <option>sd</option>
                                <option>sdf</option>
                                <option>dsf</option>
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Mã nghề:</label>
                                <select class="form-control" name="" id="">
                                <option>sd</option>
                                <option>sdf</option>
                                <option>dsf</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 d-flex">
                            <div class="form-group mr-4 col-6">
                                <label for="">Bậc nghề:</label>
                                <select class="form-control" name="" id="">
                                <option>sd</option>
                                <option>sdf</option>
                                <option>dsf</option>
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Ngày ban hành:</label>
                                <select class="form-control" name="" id="">
                                <option>sd</option>
                                <option>sdf</option>
                                <option>dsf</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> --}}


        <div class="m-portlet">
            <div class="m-portlet__body table-scrollable">
                <div class="col-12 form-group m-form__group d-flex justify-content-end">
                    <label class="col-lg-2 col-form-label">Kích thước:</label>
                    <div class="col-lg-2">
                        <select class="form-control" id="page-size">
                            @foreach(config('common.paginate_size.list') as $size)
                            <option value="{{$size}}">{{$size}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <table class="table m-table m-table--head-bg-brand table-scrollable table-responsive">
                    <thead>
                            <tr>
                                <th class="mw-10">STT</th>
                                <th class="mw-90">Tên cơ sở</th>
                                <th class="mw-90">Loại báo cáo</th>
                                <th class="mw-90">Trạng thái</th>
                                <th class="mw-200">Lí do từ chối</th>
                                <th class="mw-90">Thời gian nộp</th>
                                <th class="mw-90">Người phê duyệt 1</th>
                                <th class="mw-90">Thời gian phê duyệt lần 1</th>
                                <th class="mw-90">Người phê duyệt 2</th>
                                <th class="mw-90">Thời gian phê duyệt lần 2</th>
                                <th class="mw-90">Đợt báo cáo</th>
                                <th class="mw-240" scope="col">Thao tác</th>
                            </tr>
                    </thead>`
                    <tbody>
                        @php($i = 1)
                        @foreach ($danhSachBaoCao as $baoCao)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $baoCao->pheDuyetBaoCao->coSoDaoTao->ten }}</td>
                                <td>{{ $baoCao->loai_bao_cao }}</td>
                                <td>{{ $baoCao->trangThaiPheDuyet->ten_trang_thai }}</td>
                                <td>{{ $baoCao->li_do_tu_choi }}</td>
                                <td>{{ $baoCao->thoi_gian_nop }}</td>
                                <td>{{ $baoCao->nguoiPheDuyetLan1->name ?? '' }}</td>
                                <td>{{ $baoCao->thoi_gian_phe_duyet_1 ?? '' }}</td>
                                <td>{{ $baoCao->nguoiPheDuyetLan2->name ?? '' }}</td>
                                <td>{{ $baoCao->thoi_gian_phe_duyet_2 ?? '' }}</td>
                                <td>{{ $baoCao->dot_id }}</td>
                                <td>
                                    @can('chi_tiet_danh_sach_phe_duyet')
                                    <a
                                    href="{{ $baoCao->chi_tiet_bao_cao }}"
                                    class="btn btn-primary">
                                    Chi Tiết
                                    </a>
                                    @endcan

                                    @if(auth()->user()->can('phe_duyet_1_' .  $baoCao->pheDuyetBaoCao->getTable()) || auth()->user()->can('phe_duyet_2_' .  $baoCao->pheDuyetBaoCao->getTable()) )
                                    <a
                                    href="javascript:"
                                    data-toggle="modal"
                                    data-target="#phe_duyet_{{ $baoCao->id }}"
                                    class="btn btn-success">Thay đổi trạng thái
                                    </a> 
                                    @endif
                                    
                                    <form
                                        action="{{ route('phe_duyet_bao_cao.phe_duyet', $baoCao->id) }}"
                                        id="form_phe_duyet_{{ $baoCao->id }}"
                                        method="post">
                                        @csrf
                                        <div
                                            class="modal fade"
                                            id="phe_duyet_{{ $baoCao->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Phê duyệt báo cáo
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Thay đổi trạng thái</label>
                                                            <select
                                                                name="trang_thai"
                                                                class="form-control"
                                                                data-id="{{ $baoCao->id }}"
                                                                id="trang_thai_{{ $baoCao->id }}">
                                                                <option disabled selected>Chọn trạng thái phê duyệt</option>
                                                            </select>
                                                            <small class="d-none text-danger" id="error_trang_thai_{{ $baoCao->id }}"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Lí do từ chối</label>
                                                            <textarea
                                                                name="li_do_tu_choi"
                                                                id="li_do_tu_choi_{{ $baoCao->id }}"
                                                                class="form-control"
                                                                cols="20"
                                                                disabled
                                                                rows="8"></textarea>
                                                            <small class="d-none text-danger" id="error_li_do_tu_choi_{{ $baoCao->id }}"></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn btn-primary">Submit</a>                           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    th.mw-10 {
        min-width: 10px;
    }

    th.mw-50 {
        min-width: 50px;
    }

    th.mw-90 {
        min-width: 90px;
    }

    th.mw-200 {
        min-width: 240px;
    }

    th.mw-240 {
        min-width: 240px;
    }

    .modal-body > .form-group > span.select2 {
        width: 100% !important;
    }
</style>
@endsection

@section('script')
<script>
    const urlListTrangThai = "{{ route('phe_duyet_bao_cao.get_list_trang_thai') }}";
    $("form[id^='form_phe_duyet_']").submit(function (event) {
        event.preventDefault();
        const url = $(this)[0].action;
        const id = url.substring(url.lastIndexOf('/') + 1);
        const trangThai = $("#trang_thai_" + id).val();
        const liDoTuChoi = $("#li_do_tu_choi_" + id).val();
        console.log('-----', id, $("#li_do_tu_choi_" + id));
        axios({
            method: 'POST',
            url: url,
            data: {
                'trang_thai': trangThai,
                'bao_cao_id': id,
                'li_do_tu_choi': liDoTuChoi,
            },
            headers: {
                "Content-Type": "application/json",
                'X-Requested-With': 'XMLHttpRequest',
            },
        }).then(function (response) {
            if (response.status === 200) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 1700
                }).then(function () {
                    location.reload();
                })
            }
        }).catch(function (error) {
            const errors = error.response.data.errors;
            if (errors.li_do_tu_choi) {
                $("#error_li_do_tu_choi_" + id).text(errors.li_do_tu_choi[0]);
                $("#error_li_do_tu_choi_" + id).removeClass('d-none');
            }

            if (errors.trang_thai) {
                $("#error_trang_thai_" + id).text(errors.trang_thai[0]);
                $("#error_trang_thai_" + id).removeClass('d-none');
            }
        });
    });

    $("select[id^='trang_thai_']").select2({
        ajax: {
            url: function (params) {
                const elementId = this[0].id;
                const baoCaoId = elementId.split('_').reverse()[0];
                return urlListTrangThai + `/${baoCaoId}`;
            },
            method: 'GET',
            cache: true,
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data.listTrangThai
                };
            }
        }
    }).on('select2:select', function (event) {
        const selected = event.params.data;
        const disabled = selected.id !== 2 ? true : false;
        $("#li_do_tu_choi_" + $(this).attr('data-id')).attr('disabled', disabled);
    });
</script>
@endsection
