<?php

namespace App\Http\Controllers;

use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\ChartTongSoLuongTruongService;
use App\Services\ChartTongKetQuaTuyenSinhService;
use App\Services\ChartSoLieuCanBoQuanLyService;



class AnalysisController extends Controller
{
    // hieupt chart 
    protected $ChartTongSoLuongTruongService;
    protected $ChartTongKetQuaTuyenSinhService;
    protected $ChartSoLieuCanBoQuanLyService;


    public function __construct(
        ChartTongSoLuongTruongService $ChartTongSoLuongTruongService,
        ChartTongKetQuaTuyenSinhService $ChartTongKetQuaTuyenSinhService,
        ChartSoLieuCanBoQuanLyService $ChartSoLieuCanBoQuanLyService



    ){
        $this->ChartTongSoLuongTruongService = $ChartTongSoLuongTruongService;
        $this->ChartTongKetQuaTuyenSinhService = $ChartTongKetQuaTuyenSinhService;
        $this->ChartSoLieuCanBoQuanLyService = $ChartSoLieuCanBoQuanLyService;



    }
    // end hieupt chart

    function index(){
        // thống kê cơ sở đào tạo
        $data=[];
        $cs_dao_tao = DB::table('loai_hinh_co_so')->get();
        foreach ($cs_dao_tao as $item) {
            $count_loaihinh = DB::table('co_so_dao_tao')->where('ma_loai_hinh_co_so',$item->id)->count();
            $object = new \stdClass();
            $object->label = $item->loai_hinh_co_so;
            $object->data = $count_loaihinh;
            array_push($data,$object);
        }
        $data_return =json_encode($data);
        // thống kế tuyển sinh và tốt nghiệp
        // tuyển sinh
        // $data_tuyen_sinh = [];
        // $data_tot_nghiep = [];
        // $tuyensinh = DB::table('tuyen_sinh')->select('nam','so_luong_sv_Cao_dang','so_luong_sv_So_cap','so_luong_sv_he_khac')->limit(5)->orderBy('nam')->get();
        // $totnghiep = DB::table('sv_tot_nghiep')->select('nam','Tong_SoNguoi_TN')->limit(5)->orderBy('nam')->get();
        // dd($totnghiep, $tuyensinh);
        // for ($i=0; $i < count($tuyensinh) ; $i++) {
        //     $array_tuyensinh = [$tuyensinh[$i]->nam,$tuyensinh[$i]->so_luong_sv_Cao_dang+$tuyensinh[$i]->so_luong_sv_So_cap+$tuyensinh[$i]->so_luong_sv_he_khac];
        //     array_push($data_tuyen_sinh,$array_tuyensinh);
        //     $array_totnghiep = [$totnghiep[$i]->nam,$totnghiep[$i]->Tong_SoNguoi_TN];
        //     array_push($data_tot_nghiep,$array_totnghiep);
        // }
        // $data_json_tot_nghiep =json_encode($data_tot_nghiep);
        // $data_json_tuyen_sinh =json_encode($data_tuyen_sinh);


        // return view('index',['data'=>$data_return,'data_json_tot_nghiep'=>$data_json_tot_nghiep,'data_json_tuyen_sinh'=>$data_json_tuyen_sinh]);
        

        // HIEUPT CHART 7/2/2020
        $tongkqtuyensinh = $this->ChartTongKetQuaTuyenSinhService->getTongKetQuaTuyenSinhChart();
        $tongsoluongtruong = $this->ChartTongSoLuongTruongService->getTongSoLuongTruongChart();
        $canboquanly = $this->ChartSoLieuCanBoQuanLyService->getSoLieuCanBoQuanLyChart();
    
        // dd($kq[0]->so_luong_sv_So_cap);
       

       
     

        return view('index',['data'=>$data_return],compact('tongkqtuyensinh','tongsoluongtruong','canboquanly'));
    }
}