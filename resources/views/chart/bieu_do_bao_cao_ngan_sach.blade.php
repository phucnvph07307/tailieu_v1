
@extends('layouts.admin')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<h1>Biểu đồ báo cáo ngân sách</h1>
<div class="m-content container-fluid">
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="m-menu__link-icon flaticon-network"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Biểu đồ 
                    </h3>
                </div>
            </div>
        </div>
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
                                <label class="col-lg-2 col-form-label">Năm:</label>
                                <div class="col-lg-8">
                                  <select name="id" class="form-control select2">
                                      <option value="">-----Cơ sở đào tạo-----</option>
                                      @foreach($coSo as $item)
                                      <option @if(isset($params['id']) && $params['id']==$item->id) selected @endif
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
       
        
        
    </div>

</div>
@endsection