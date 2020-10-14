@extends('layouts.admin')
@section('title', "Danh sách tài khoản")
@section('content')
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-users"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Tài khoản <small>Danh sách tài khoản</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            <input type="hidden" name="page_size" value="{{$params['page_size']}}">
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="form-group m-form__group row ">
                                <label class="col-lg-2 col-form-label">Trạng thái:</label>
                                <div class="col-lg-8">
                                    <select name="status" id="status" class="form-control ">
                                        <option value="" selected>All</option>
                                        <option value="1" @if($status==1) selected @endif>Kích hoạt</option>
                                        <option value="2" @if($status==2) selected @endif>Khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Từ khóa:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control m-input" @if(isset($keyword))
                                        value="{{$keyword}}" @endif
                                        placeholder="Tìm kiếm Name, Email, Phone , Cơ sở ..." name="keyword">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Quyền hạn:</label>
                                <div class="col-lg-8">
                                    <select name="role" id="role" class="form-control ">
                                        <option value="" selected>All</option>
                                        @foreach($roleList as $cursor)
                                        <option value="{{$cursor->id}}" @if($cursor->id == $role) selected @endif>{{$cursor->name}}</option>
                                        @endforeach
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
            @if (\Session::has('mess'))
            <div class="alert alert-success" role="alert">
                <strong>{!! \Session::get('mess') !!}</strong>
            </div>
            <div class="m-portlet">
                @endif
                <table class="table m-table m-table--head-bg-brand">
                    <thead>
                        <th>STT</th>
                        <th>Họ và Tên</th>
                        <th>Ảnh đại diện</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Cơ sở đào tạo</th>
                        <th>Tên quyền</th>
                        <th>Trạng thái</th>
                        <th>
                            @can('them_tai_khoan')
                            <a target="_blank" href="{{ route('account.tao-tk') }}" class="btn btn-success btn-sm">Thêm mới</a>
                            @endcan
                        </th>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        function displayAvatar($avatarImg)
                        {
                        if($avatarImg != null) {
                            return asset('storage/'.$avatarImg);
                        }
                            return asset('images/avatardefault.jpg');
                        }
                        @endphp

                        @foreach ($users as $user)


                        <tr>
                            <th scope="row" class="vertical-middle">{{ $i }}</th>
                            @php
                            $i++;
                            @endphp
                            <td>{{ $user->name }}</td>
                            <td><img width="60" class="td_show-avatar" src="{!! displayAvatar($user->avatar) !!}"
                                    alt="avatar">
                            </td>
                            <td>{{ $user->email }}</td>

                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->ten }}</td>
                            <td>{{ $user->role_name }}</td>
                            @can('vo_hieu_hoa_tai_khoan')
                            <td>
                                <form class="m-form">

                                    <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
                                        <label>
                                            <input type="checkbox" onclick="editstatus(this)" user-id="{{ $user->id }}"
                                                name="" @if ($user->status ==
                                            1)
                                            checked
                                            @endif>
                                            <span></span>
                                        </label>
                                    </span>

                                </form>
                            </td>
                            @endcan
                            <td>
                                @can('sua_tai_khoan')
                                <a target="_blank" class="btn btn-primary btn-sm"
                                    href="{{ route('account.edit',['id'=>$user->id]) }}">Sửa</a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>    
            <div>

                @if (count($users) == 0)
                <div class="thongbao border" style="color: red; text-align: center;">

                    <h4 class="m-portlet__head-text ">
                        Không tìm thấy kết quả
                    </h4>
                </div>
                @endif

            </div>

        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
            {!! $users->links() !!}
        </div>
    </div>

</div>
</div>
@endsection
@section('script')
<script>
    var currentUrl = '{{route($route_name)}}';
    $(document).ready(function () {
        $('#page-size').change(function () {
            var status = $('[name="status"]').val();
            var role = $('[name="role"]').val();
            var keyword = $('[name="keyword"]').val();
            var page_size = $(this).val();
            var reloadUrl =
                `${currentUrl}?status=${status}&role=${role}&keyword=${keyword}&page_size=${page_size}`;
            window.location.href = reloadUrl;
        });

    });

</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // function showimages(element) {

    //     var file = element.files[0];
    //     var reader = new FileReader();
    //     reader.onloadend = function () {
    //         $('#showavatar').attr('src', reader.result);
    //         // console.log('RESULT', reader.result)
    //     }
    //     reader.readAsDataURL(file);

    //     $('#showavatar').attr('src', reader.result);
    // }

    function editstatus(element) {
        console.log('Đang thay đổi status');
        // console.log($id);

        let userId = $(element).attr('user-id')
        axios.post('/account/edit-status', {
                id: userId
            })
            .then(function (response) {
                console.log('Thay đổi status THÀNH CÔNG');
            })
            .catch(function (error) {
                // console.log(error);
            });
    }

    $(document).ready(function(){
        $('.td_show-avatar').each(function(){
            var avatarImgUrl = $(this).attr('src');
            SystemUtil.defaultImgUrl(avatarImgUrl, this, "{{  asset('images/avatardefault.png') }}");
        });
    })
</script>

@endsection