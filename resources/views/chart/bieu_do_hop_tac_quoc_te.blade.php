
@extends('layouts.admin')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<div class="m-content container-fluid">
    <div class="m-portlet">
      <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
              <div class="m-portlet__head-title">
                  <span class="m-portlet__head-icon">
                      <i class="m-menu__link-icon flaticon-network"></i>
                  </span>
                  <h3 class="m-portlet__head-text">
                      Biểu đồ hợp tác quốc tế
                  </h3>
              </div>
          </div>
      </div>
      {{-- {{route('lay-du-lieu-ht-qt')}} --}}
    <form action="" method="get" class="m-form">
          <input type="hidden" name="page_size" value="">
          
          <div class="m-portlet__body">
              <div class="m-form__section m-form__section--first">
                  <div class="m-form__heading">
                      <h3 class="m-form__heading-title">Bộ lọc:</h3>
                  </div>
                  <div class="row">
                      <div class="col-md-6 p-2">
                          <div class="form-group m-form__group row ">
                              <label class="col-lg-2 col-form-label">Năm:</label>
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

                          <div class="form-group m-form__group row ">
                            <label class="col-lg-2 col-form-label">Đợt:</label>
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
                      <div class="col-md-6 p-2">
                          <div class="form-group m-form__group row ">
                              <label class="col-lg-2 col-form-label">Cơ sở:</label>
                              <div class="col-lg-8">
                                <select name="co_so_id" class="form-control select2">
                                    <option value="">-----Cơ sở đào tạo-----</option>
                                    @foreach($coSo as $item)
                                    <option @if(isset($params['co_so_id']) && $params['co_so_id']==$item->id) selected @endif
                                        value="{{$item->id}}">{{$item->ten}}</option>
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
          <div class="col-md-5 p-5" style="margin:auto;">
          <canvas id="pieChart" width="400" height="400"></canvas>
      </div>
      </div>
  </div>
 

@endsection
@section('script')
<script>
    var ctx = document.getElementById('pieChart');
   var pieChart = new Chart(ctx, {
       type: 'pie',
       data: {
           labels: ["Số học sinh được các đơn vị cấp bằng","Số hs được nhà trường cấp bằng"],
           datasets: [{
               label: "",
               data:[
                   {{ $data['so_hs_duoc_cac_don_vi_cap_bang']}},
                   {{ $data['so_hs_duoc_nha_truong_cap_bang']}}
               ],
               backgroundColor: ["#3e95cd", "#8e5ea2" ],
               
           }]        
       },
       options: {
           legend: { display: true },
           title: {
           display: true,
           text: 'Biểu đồ số lượng học sinh được cấp bằng hợp tác quốc tế',
           fontSize: 16,
           },
           tooltips: {
            enabled: true
        },
        plugins: {
            datalabels: {
                color: '#fff'
            }
        }
        
       }
       });
       

 
 $(document).ready(function(){
   $('.select2').select2()
 })
</script>
@endsection