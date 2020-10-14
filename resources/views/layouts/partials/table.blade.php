<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="col-12 form-group m-form__group d-flex justify-content-end">
            <label class="col-lg-2 col-form-label">Kích thước:</label>
            <div class="col-lg-2">
                <select class="form-control" id="page_size">
                    @foreach(config('common.paginate_size.list') as $size)
                    <option value="{{$size}}">{{$size}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="table table-bordered m-table m-table--head-bg-primary table-responsive">
            <thead>
                <th scope="col">STT</th>
                @foreach ($titles as $key => $title)
                <th id="{{ $key }}">{!! $title !!}&nbsp;&nbsp;<i class="fas fa-angle-down pointer"></i></th>
                @endforeach
                @if (
                (isset($route_edit) && !empty($route_edit)) ||
                (isset($route_show) && !empty($route_show))
                )

                <th scope="col" colspan="2">
                    @can('cap_nhat_quan_ly_giao_vien')
                    Thao tác
                    @endcan
                </th>

                @endif
            </thead>

            <tbody>
                @php
                $i = !request()->has('page') ? 1 : ($limit * (request()->get('page') - 1) + 1)
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    @foreach ($titles as $key => $title)
                    <td>{!! $item->$key !!}</td>
                    @endforeach

                   

                    <td>
                        @if (isset($route_edit) && !empty($route_edit))
                        <a href="{{ route($route_edit, [ $item->id ]) }}">Sửa</a>
                        @endif
                    </td>
                    <td>
                        @if (isset($route_show) && !empty($route_show))
                        <a href="{{ route($route_show, [ $item->id ]) }}">Chi tiết</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-portlet__foot d-flex justify-content-end">
        {{ $data->links() }}
    </div>
</div>