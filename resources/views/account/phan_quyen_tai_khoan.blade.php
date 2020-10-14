@extends('layouts.admin')
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
                        Quyền <small>Danh sách quyền</small>
                    </h3>
                </div>
            </div>
        </div>
        <form action="" method="get" class="m-form">
            {{-- <input type="hidden" name="page_size" value="{{$params['page_size']}}"> --}}
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Bộ lọc:</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">Quyền hạn: </label>
                                <div class="col-lg-8">
                                    <select name="role" id="role" class="form-control ">
                                        <option value="" selected>All</option>
                                        @foreach($roleList as $item)
                                        <option value="{{$item->id}}" @if($item->id == $role) selected @endif>{{$item->name}}</option>                                       
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
            <table class="table m-table m-table--head-bg-brand">
                <thead>
                    <th>STT</th>
                    <th>Tên quyền</th>
                    <th>
                        @can('them_quyen')
                        <a href="{{ route('account.them-quyen') }}" class="btn btn-success btn-sm">Thêm mới</a>
                        @endcan
                    </th>
                </thead>
                @php($i=1)
                @foreach ($data as $role)
                <tbody>
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('sua_quyen')
                                <a class="btn btn-primary btn-sm" 
                                    href="{{ route('account.sua-quyen',['id'=>$role->id]) }}">Sửa
                                </a>
                            @endcan
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div>


            </div>

        </div>
        <div class="m-portlet__foot d-flex justify-content-end">
        </div>
    </div>

</div>
@endsection