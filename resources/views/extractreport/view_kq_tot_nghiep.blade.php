@extends('layouts.admin')
@section('title', "Kết quả tốt nghiệp")

@section('content')
<div class="m-content">
    <div class="row">

        <div class="col-xl-12">



            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Kết quả tốt nghiệp
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">



                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table table-bordered m-table m-table--border-brand ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã ngành nghề</th>
                                        <th>Tên cơ sở</th>
                                        <th>Loại hình cơ sở</th>
                                        <th>Tổng số người học tốt nghiệp</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Jhon</td>
                                        <td>Stone</td>
                                        <td>@jhon</td>
                                        <td>@jhon</td>
                                        <td>@jhon</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--end::Section-->

             
                </div>

                <!--end::Form-->
            </div>

            <!--end::Portlet-->


        </div>
    </div>
</div>


@endsection