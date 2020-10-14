<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ChartTongKetQuaTuyenSinhService;
use App\Services\ChartTongSoLuongTruongService;
use App\Services\ChartSoLuongTruongService;

class ChartController extends Controller
{

    protected $ChartKetQuaTuyenSinhService;
    protected $ChartTongKetQuaTuyenSinhService;
    protected $ChartTongSoLuongTruongService;


    public function __construct(
        ChartKetQuaTuyenSinhService $ChartKetQuaTuyenSinhService,
        ChartKetQuaTuyenSinhService $ChartTongKetQuaTuyenSinhService,
        ChartTongSoLuongTruongService $ChartTongSoLuongTruongService
    )
    {
        $this->ChartKetQuaTuyenSinhService = $ChartKetQuaTuyenSinhService;
        $this->ChartTongKetQuaTuyenSinhService = $ChartTongKetQuaTuyenSinhService;
        $this->ChartTongSoLuongTruongService = $ChartTongSoLuongTruongService;
    }
    public function bdbaocaongansach()
    {
        $coSo = DB::table('co_so_dao_tao')->get();
        return view('chart.bieu_do_bao_cao_ngan_sach',compact('coSo'));
    }
    
    public function bdkqtuyensinh(Request $request)
    {
        $params = $request->all();


$data = $this->ChartKetQuaTuyenSinhService->getKetQuaTuyenSinhChart($params);
        $coSo = DB::table('co_so_dao_tao')->get();
        return view('chart.bieu_do_ket_qua_tuyen_sinh',compact('coSo','data','params'));
    }
    public function bdsvdanghoc(Request $request)

    {
       
    //    $params = $request->all();
    //    $query = DB::table('sv_dang_quan_ly');
    //    if (isset($params['dot']) && $params['dot'] != 0) {
    //     $query->where('sv_dang_quan_ly.dot', $params['dot']);
    //     }
    //     if (isset($params['nam']) && $params['nam'] != 0) {
    //         $query->where('sv_dang_quan_ly.nam', $params['nam']);
    //     }
    //     if (isset($params['co_so_id']) && $params['co_so_id'] != 0) {
    //         $query->where('sv_dang_quan_ly.co_so_id', $params['co_so_id']);
    //     }
    //     $data = (array)$query->first();

       
  
    //     if($data == []){
    //         $data = [
    //             'so_luong_sv_Cao_dang'=> 0,
    //             'so_luong_sv_Trung_cap'=> 0,
    //             'so_luong_sv_So_cap'=> 0,
    //             'so_luong_sv_he_khac'=> 0
    //         ];
    //     }
    //     else{
     
    //         $data['so_luong_sv_Cao_dang'] = isset($data['so_luong_sv_Cao_dang'])  ?  $data['so_luong_sv_Cao_dang'] : 0 ;
    //         $data['so_luong_sv_Trung_cap'] = isset($data['so_luong_sv_Trung_cap'])  ?  $data['so_luong_sv_Trung_cap'] : 0 ;
    //         $data['so_luong_sv_So_cap'] = isset($data['so_luong_sv_So_cap'])  ?  $data['so_luong_sv_So_cap'] : 0 ;
    //         $data['so_luong_sv_he_khac'] = isset($data['so_luong_sv_he_khac'])  ?  $data['so_luong_sv_he_khac'] : 0 ;
    //     }

         
        $coSo = DB::table('co_so_dao_tao')->get();
        return view('chart.bieu_do_sinh_vien_dang_theo_hoc',compact('coSo','data','params'));
    }
    


    
    public function bdsoluongtotnghiep(Request $request)
    {
        // $params = $request->all();
        // $query = DB::table('sv_tot_nghiep');
        // if (isset($params['dot']) && $params['dot'] != 0) {
        //     $query->where('sv_tot_nghiep.dot', $params['dot']);
        // }
        // if (isset($params['nam']) && $params['nam'] != 0) {
        //     $query->where('sv_tot_nghiep.nam', $params['nam']);
        // }else{
        //     $query->where('sv_tot_nghiep.nam',  Carbon::now()->year);
        // } 
        // if (isset($params['co_so_id']) && $params['co_so_id'] != 0) {
        //     $query->where('sv_tot_nghiep.co_so_id', $params['co_so_id']);
        // }

        // $data =(array)$query->first();
        // // dd($data);

        // if($data == []){
        //     $data = [
        //         'SoSV_TN_TrinhDoCD'=> 0,
        //         'SoSV_TN_TrinhDoTC'=> 0,
        //         'SoSV_TN_TrinhDoSC'=> 0,
        //         'SoSV_TN_NgheKhac'=> 0
        //     ];
        // }
        // else{
     
        //     $data['SoSV_TN_TrinhDoCD'] = isset($data['SoSV_TN_TrinhDoCD'])  ?  $data['SoSV_TN_TrinhDoCD'] : 0 ;
        //     $data['SoSV_TN_TrinhDoTC'] = isset($data['SoSV_TN_TrinhDoTC'])  ?  $data['SoSV_TN_TrinhDoTC'] : 0 ;
        //     $data['SoSV_TN_TrinhDoSC'] = isset($data['SoSV_TN_TrinhDoSC'])  ?  $data['SoSV_TN_TrinhDoSC'] : 0 ;
        //     $data['SoSV_TN_NgheKhac'] = isset($data['SoSV_TN_NgheKhac'])  ?  $data['SoSV_TN_NgheKhac'] : 0 ;
        // }

        $coSo = DB::table('co_so_dao_tao')->get();
        return view('chart.bieu_do_so_luong_tot_nghiep',compact('coSo','data','params'));
    }
   




    
    public function bdhoptacquocte(Request $request)
    {
        // $params = $request->all();
        // $query = DB::table('ket_qua_hop_tac_quoc_te');
        // if (isset($params['dot']) && $params['dot'] != 0) {
        //     $query->where('ket_qua_hop_tac_quoc_te.dot', $params['dot']);
        //     }
        //     if (isset($params['nam']) && $params['nam'] != 0) {
        //         $query->where('ket_qua_hop_tac_quoc_te.nam', $params['nam']);
        //     }
        //     if (isset($params['co_so_id']) && $params['co_so_id'] != 0) {
        //         $query->where('ket_qua_hop_tac_quoc_te.co_so_id', $params['co_so_id']);
        //     }
        //     $data = (array)$query->first();

        $coSo = DB::table('co_so_dao_tao')->get();
        return view('chart.bieu_do_hop_tac_quoc_te',compact('coSo','data','params'));
    }

    
}