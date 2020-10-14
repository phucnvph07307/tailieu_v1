@extends('layouts.admin')
@section('title', "Dashboard")
@section('content')
<div class="m-content">
 
    {{-- <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Biểu đồ tăng trưởng tuyển sinh
                            </font></font></h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div  id="m_flotcharts_2" style="height: 300px; padding: 0px; position: relative;">
                        <canvas class="flot-base" width="1433" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 900px; height: 300px;"></canvas>
                        <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                            <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 60px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 120px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 180px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 240px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 300px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 360px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 420px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">14</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 480px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">16</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 540px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">18</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 600px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">20</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 660px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">22</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 720px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">24</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 780px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">26</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 840px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">28</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 71px; top: 283px; left: 900px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">30</font></font></div>
                            </div>
                            <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 10px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 249px; left: 8px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 228px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">20</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 208px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">30</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 187px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">40</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 166px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">50</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 145px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">60</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 125px; left: 5px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">70</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 104px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">80</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 83px; left: 4px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">90</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 62px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">100</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 42px; left: 5px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">110</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 21px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">120</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">130</font></font></div>
                            </div>
                        </div>
                        <canvas class="flot-overlay" width="1433" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 900px; height: 300px;"></canvas>
                        <div class="legend">
                            <div style="position: absolute; width: 85.6px; height: 35.2px; top: 13px; right: 12px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
                            <table style="position:absolute;top:13px;right:12px;;font-size:smaller;color:#545454">
                                <tbody>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div style="width:4px;height:0;border:5px solid rgb(209,38,16);overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lượt truy cập duy nhất</font></font></td>
                                    </tr>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div style="width:4px;height:0;border:5px solid rgb(55,183,243);overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Lượt xem trang</font></font></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Portlet-->

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                Biểu đồ thống kê số lượng cơ sở đào tạo Quý 1/2020
                            </font></font></h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="m_flotcharts_5" style="height: 350px; padding: 0px; position: relative;">
                        <canvas
                            class="flot-base"
                            width="1433"
                            height="437"
                            style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 900px; height: 350px;">
                        </canvas>
                        <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                            <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 43px; text-align: center;">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">0</font>
                                    </font>
                                </div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 100px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 180px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 260px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 340px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 420px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 500px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 580px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 660px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 740px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">9</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 88px; top: 333px; left: 820px; text-align: center;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font></div>
                            </div>
                            <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 320px; left: 8px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 274px; left: 5px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 229px; left: 2px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">20</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 183px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">30</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 137px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">40</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 91px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">50</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 46px; left: 1px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">60</font></font></div>
                                <div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 2px; text-align: right;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">70</font></font></div>
                            </div>
                        </div>
                        <canvas class="flot-overlay" width="1433" height="437" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 900px; height: 350px;"></canvas>
                        <div class="legend">
                            <div style="position: absolute; width: 46.4px; height: 52.8px; top: 13px; right: 13px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
                            <table style="position:absolute;top:13px;right:13px;;font-size:smaller;color:#545454">
                                <tbody>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div style="width:4px;height:0;border:5px solid rgb(237,194,64);overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">bán hàng</font></font></td>
                                    </tr>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div style="width:4px;height:0;border:5px solid rgb(175,216,248);overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Thuế</font></font></td>
                                    </tr>
                                    <tr>
                                        <td class="legendColorBox">
                                            <div style="border:1px solid #ccc;padding:1px">
                                                <div style="width:4px;height:0;border:5px solid rgb(203,75,75);overflow:hidden"></div>
                                            </div>
                                        </td>
                                        <td class="legendLabel"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">lợi nhuận</font></font></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Portlet-->
        </div>
    </div> --}}
    

    <div class="row">
      
        {{-- Hieupt - chart - 29/6/2020 --}}
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                 Biểu đồ thống kê số lượng trường đào tạo
                                 
                                    </font>
                                </font>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <canvas id="biedosoluongtruong" width="400" height="400"></canvas>
                </div>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Biểu đồ thống kê kết quả tuyển sinh trong 4 năm gần nhất

                                    </font>
                                </font>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <canvas id="bieudotuyensinh" width="400" height="400"></canvas>
                </div>
            </div>

        </div>
        
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                 Biểu đồ thống kê tỉ lệ ngành nghề
                                 
                                    </font>
                                </font>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <canvas id="bieudonganhnghe" width="400" height="400"></canvas>
                </div>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Biểu đồ thống kê số liệu cán bộ quản lý

                                    </font>
                                </font>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <canvas id="bieudoicanboquanly" width="400" height="400"></canvas>
                </div>
            </div>

        </div>
    </div>
    {{-- endhieu --}}
</div>
@endsection

@section('script')
<script>
    console.log(JSON.parse($('#m_flotcharts_8').attr('attr')))
</script>
<script src="{!! asset('assets/vendors/custom/flot/flot.bundle.js') !!}" type="text/javascript"></script>
<script src="{!! asset('assets/demo/custom/components/charts/flotcharts.js') !!}" type="text/javascript"></script>


{{-- hieupt --}}
<script>
    var ctx = document.getElementById('biedosoluongtruong');
    var barChart= new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Hệ Cao Đẳng", "Hệ Trung Cấp","Hệ Khác"],
        datasets: [
          {
            label: "Hệ cao đẳng ",
            backgroundColor: ["#e96f28", "#3367b1","#54b14d"],
            data: [
                {{ $tongsoluongtruong["cao_dang"] }},
                {{ $tongsoluongtruong["trung_cap"] }},
                {{ $tongsoluongtruong["he_khac"] }},
                


            ],
            borderWidth:1
          }
        ]
      },
      options: {
        legend: { display: true },
        title: {
          display: true,
          text:'Biểu đồ tổng số lượng trường',
          fontSize: 16,
        },
        scales: {
                
                ticks: {
                    beginAtZero: true
                }
            
        },
        
      }
    });
  

</script>
<script>
    var ctx = document.getElementById('bieudotuyensinh');
    var lineChart= new Chart(ctx, {
      type: 'bar',
      data: {
      labels: [
        @forEach($tongkqtuyensinh as $key => $item)
                {{ $item->nam }},
                @endforeach
      ],
        datasets: [
          {
            label: "Hệ cao đẳng ",
            backgroundColor:"#FF8247 ",
            data: [
                @forEach($tongkqtuyensinh as $key => $item)
                {{ $item->so_luong_sv_Cao_dang }},
                @endforeach
            ],
            borderWidth:1
          },
          
          {
            label: "Hệ trung cấp ",
            backgroundColor: "#3367b1",
            data: [
                @forEach($tongkqtuyensinh as $key => $item)
                {{ $item->so_luong_sv_Trung_cap }},
                @endforeach
            ],
            borderWidth:1
          },
          
          {
            label: "Hệ sơ cấp ",
            backgroundColor: "#B066FE",
            data: [
                @forEach($tongkqtuyensinh as $key => $item)
                {{ $item->so_luong_sv_So_cap }},
                @endforeach
            ],
            borderWidth:1
          },
          {
            label: "Hệ khác",
            backgroundColor: "#54b14d",
            data: [
                @forEach($tongkqtuyensinh as $key => $item)
                {{ $item->so_luong_sv_he_khac }},
                @endforeach
               
            ],
            borderWidth:1
          },
        ]
      },
      options: {
        legend: { display: true },
        title: {
          display: true,
          text:'Biểu đồ tổng kết quả tuyển sinh 4 năm gần nhất',
          fontSize: 16,
        },
       
        scales: {
                
                ticks: {
                    beginAtZero: true
                }
            
        },
        
      }
      
    });
  

</script>

<script>
    var ctx = document.getElementById('bieudonganhnghe');
    var barChart= new Chart(ctx, {
      type: 'polarArea',
      data: {
        labels: ["Công nghệ thông tin", "Kế toán","Kinh doanh","Báo chí","Mỹ thuật","Đào tạo giáo viên","Nghệ thuật trình diễn"],
        datasets: [
          {
            label: "Hệ cao đẳng ",
            backgroundColor: ["#e96f28", "#3367b1","#54b14d","#B066FE","#FF6A6A","#FFB6C1","#DDC488"],

            data: [
               50,23,55,22,34,44,37
                


            ],
            borderWidth:1
          }
        ]
      },
      options: {
        legend: { display: true },
        title: {
          display: true,
          text:'Biểu đồ tỉ lệ ngành nghề',
          fontSize: 16,
        },
        scales: {
                
                ticks: {
                    beginAtZero: true
                }
            
        },
        
      }
    });
</script>

<script>
    var ctx = document.getElementById('bieudoicanboquanly');
    var lineChart= new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
            @forEach($canboquanly as $key => $item)
                {{ $item->nam }},
                @endforeach
        ],
        datasets: [
          {
            label: "Số liệu cán bộ quản lý",
            backgroundColor: "rgba(238, 173, 14, 0.2)",
            borderColor: "#e96f28",
            data: [
                @forEach($canboquanly as $key => $item)
                {{ $item->tong_so_quan_ly }},
                @endforeach
                


            ],
            borderWidth:1
          }
        ]
      },
      options: {
        legend: { display: true },
        title: {
          display: true,
          text:'Biểu đồ thống kê số liệu cán bộ quản lý',
          fontSize: 16,
        },
        scales: {
                
                ticks: {
                    beginAtZero: true
                }
            
        },
        
      }
    });
</script>


{{-- endhieupt --}}
@endsection