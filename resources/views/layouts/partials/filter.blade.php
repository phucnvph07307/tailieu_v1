<section class="fillter-area  mb-5">
    <div class="fillter-title">
        <h4>Bộ lọc</h4>
    </div>
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-web"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Tổng hợp <small>quản lý giáo viên</small>
                    </h3>
                </div>
            </div>
        </div>

        <form action="{{ $config['url'] }}" method="get" class="m-portlet__body">
            @php($count = 0)
            @foreach ($config['partials'] as $key => $item)
                @php($count++)
                @if ($count % 2 === 1)
                    <div class="d-flex container pt-3">
                @endif
                    <div class="form-group col-md-6 col-12 d-flex justify-content-around align-items-center">
                        <span for="" class="fillter-name col-4">{{ $item['label'] }}</span>
                        @if(isset($item['select2']))
                            <select class="form-control col-8 {{ $item['select2'] === true ? 'select2' : '' }}" name="{{ $key }}" id="{{ $key }}">
                                <option value="0" selected>{{ $item['default'] }}</option>
                                @foreach($item['options'] as $optionKey => $optionValue)
                                    <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                                @endforeach
                            </select>
                        @else
                            <input
                                class="form-control"
                                name="{{ $key }}"
                                id="{{ $key }}"
                                />
                        @endif
                    </div>
                @if ($count % 2 === 0 || $count === count($config['partials']))
                    </div>
                @endif
            @endforeach

            <div class="row justify-content-center pt-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
</section>
