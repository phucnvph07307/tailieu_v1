@extends('layouts.admin')
@section('title', 'Phản hồi yêu cầu hỗ trợ')
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
                            Hỗ trợ <small>Phản hồi hỗ trợ</small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <div class="row">
                            <div class="col-md-6">
                                @if(Session::has('result_status'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        </button>
                                        {{Session::get('result_status')}}
                                    </div>
                                @endif
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        </button>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <h3 class="m-form__heading-title">Mã yêu cầu: #{{$model->id}} - {{$model->tieu_de}}</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Họ và tên: {{$model->ten_nguoi_gui}}</p>
                            <p>Email: {{$model->email_nguoi_gui}} &nbsp;&nbsp;&nbsp; Số điện thoại: {{$model->so_dien_thoai_nguoi_gui}}</p>
                            <p>Ngày gửi yêu cầu: {{\Carbon\Carbon::parse($model->created_at)->format("d-m-Y")}}</p>
                            <p>Trạng thái:
                                @if($model->trang_thai == config('common.trang_thai_ho_tro.chua_phan_hoi'))
                                    <button type="button" class="btn btn-brand" data-toggle="modal" data-target="#m_modal_tra_loi">Chưa phản hồi</button>
                                @else
                                    <button type="button" class="btn btn-success">Đã phản hồi</button>
                                @endif
                            </p>
                            <div class="form-group m-form__group">
                                <label for="">Nội dung:</label>
                                <textarea class="form-control m-input m-input--solid" disabled="disabled" rows="5">{{ $model->noi_dung }}</textarea>
                            </div>
                            @if($model->trang_thai == config('common.trang_thai_ho_tro.da_phan_hoi'))
                                <div class="m-separator m-separator--space m-separator--dashed"></div>
                                <h3>Nội dung phản hồi</h3>
                                <p>Người phản hồi: {{$model->nguoiPhanHoi->name}}</p>
                                <p>Ngày thực hiện phản hồi: {{\Carbon\Carbon::parse($model->updated_at)->format("d-m-Y h:i:s")}}</p>
                                <div class="form-group m-form__group">
                                    <label for="">Nội dung phản hồi:</label>
                                    <textarea class="form-control m-input m-input--solid" disabled="disabled" rows="5">{{ $model->noi_dung_phan_hoi }}</textarea>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="m_modal_tra_loi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">#{{$model->id}} - {{$model->tieu_de}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-tra-loi-yeu-cau" action="" method="post">
                    @csrf
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="form-control-label">Tiêu đề <span class="text-danger">*</span>:</label>
                                <input type="text" class="form-control" name="tieu_de_phan_hoi" value="{{old('tieu_de_phan_hoi', "Trả lời yêu cầu #$model->id - $model->tieu_de")}}" placeholder="Tiêu đề trả lời yêu cầu">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="form-control-label">Nội dung trả lời <span class="text-danger">*</span>:</label>
                                <textarea class="form-control" rows="5" name="noi_dung_phan_hoi">{{old('noi_dung_phan_hoi')}}</textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#form-tra-loi-yeu-cau').validate({
                rules: {
                    tieu_de_phan_hoi: {
                        required: true,
                        maxlength: 255
                    },
                    noi_dung_phan_hoi: {
                        required: true
                    }
                },
                messages: {
                    tieu_de_phan_hoi: {
                        required: "Hãy nhập tiêu đề trả lời",
                        maxlength: "Vượt độ dài quy định"
                    },
                    noi_dung_phan_hoi: {
                        required: "Hãy nhập nội dung trả lời"
                    }
                }
            });
        })
    </script>
@endsection