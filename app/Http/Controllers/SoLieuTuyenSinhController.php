<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Requests\SoLieuTuyenSinh\StoreRequest;
use App\Http\Requests\SoLieuTuyenSinh\UpdateRequest;
use App\Services\SoLieuTuyenSinhService;


use App\Http\Requests\Excel\ExportDuLieu;
use Storage;

class SoLieuTuyenSinhController extends Controller
{

    protected $SoLieuTuyenSinhService;

    public function __construct(SoLieuTuyenSinhService $SoLieuTuyenSinhService)
    {
        $this->SoLieuTuyenSinhService = $SoLieuTuyenSinhService;
    }

    public function index()
    {

        /**
         * Thanh NV
         * $limit =10;
         * $data = $this->SoLieuTuyenSinhService->getSoLuongTuyenSinh($limit);
         * $co_so_dao_tao =  DB::table('co_so_dao_tao')->get();
         * return view('solieutuyensinh.tong_hop_so_lieu_tuyen_sinh',compact('data','limit','co_so_dao_tao'));
         * 
         */
        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }

        $data = $this->SoLieuTuyenSinhService->getSoLuongTuyenSinh($params, $limit);
        $coso = $this->SoLieuTuyenSinhService->getTenCoSoDaoTao();
        $quanhuyen = $this->SoLieuTuyenSinhService->getTenQuanHuyen();
        $nghe_cap_2 = $this->SoLieuTuyenSinhService->getNganhNghe(2);
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->SoLieuTuyenSinhService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }

        $nghe_cap_3 = $this->SoLieuTuyenSinhService->getNganhNghe(3);
        $nghe_cap_4 = $this->SoLieuTuyenSinhService->getNganhNghe(4);


        $loaiHinh = $this->SoLieuTuyenSinhService->getListLoaiHinh();
        $data->appends(request()->input())->links();
        return view('solieutuyensinh.tong_hop_so_lieu_tuyen_sinh', [
            'data' => $data,
            'loaiHinh' => $loaiHinh,
            'limit' => $limit,
            'coso'=> $coso,
            'quanhuyen' => $quanhuyen,
            'params' => $params,
            'xaphuongtheoquanhuyen' => $xaphuongtheoquanhuyen,
            'nghe_cap_2' => $nghe_cap_2,
            'nghe_cap_3' => $nghe_cap_3,
            'nghe_cap_4' => $nghe_cap_4
        ]);
    }

    public function chitietsolieutuyensinh($coSoId)
    {
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $params = request()->all();
        $thongtincoso = $this->SoLieuTuyenSinhService->getThongTinCoSo($coSoId);
        $data = $this->SoLieuTuyenSinhService->getChiTietSoLuongTuyenSinh($coSoId, $limit, $params);
        $data->appends(request()->input())->links();
        return view('solieutuyensinh.chi_tiet_so_lieu_tuyen_sinh', [
            'data' => $data,
            'limit' => $limit,
            'params' => $params,
            'thongtincoso' => $thongtincoso
        ]);
    }


    public function edit($id)
    {
        $datatuyensinhid = $this->SoLieuTuyenSinhService->getsuasolieutuyensinh($id);
        return view('solieutuyensinh.sua_so_luong_tuyen_sinh', compact('datatuyensinhid'));
    }

    public function update($id, UpdateRequest $request)
    {
        $data = $this->SoLieuTuyenSinhService->updateData($id, $request);
        $datatuyensinh = $this->SoLieuTuyenSinhService->findById($id);
        return redirect()->route('chitietsolieutuyensinh', ['co_so_id' => $datatuyensinh->co_so_id])->with('thongbao', 'Sửa số liệu tuyển sinh thành công');
    }

    public function create()
    {
        $data = $this->SoLieuTuyenSinhService->getTenCoSoDaoTao();
        return view('solieutuyensinh.them_so_lieu_tuyen_sinh', compact('data'));
    }

    public function store(StoreRequest $request)
    {
        $requestParams = $request->all();
        $data = [
            [
                'id' => "co_so_id",
                'value' => $requestParams["co_so_id"],
            ],
            [
                'id' => 'nghe_id',
                'value' => $requestParams["nghe_id"]
            ],
            [
                'id' => 'nam',
                'value' => $requestParams["nam"]
            ],
            [
                'id' => 'dot',
                'value' => $requestParams["dot"]
            ],
        ];

        $result = $this->SoLieuTuyenSinhService->getCheckTonTaiSoLieuTuyenSinh($data, $requestParams);
        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    public function getmanganhnghe(Request $request)
    {
        $data = $this->SoLieuTuyenSinhService->getmanganhnghe($request->id);
        return $data;
    }

    public function getCheckTonTaiSoLieuTuyenSinh(Request $request)
    {
        $datacheck =  $request->datacheck;
        $getdata = $this->SoLieuTuyenSinhService->getSoLieu($datacheck);
        if ($getdata == 'tontai') {
            return 1;
        } else if ($getdata == null) {
            return 2;
        } else {
            return $urledit = route('suasolieutuyensinh', ['id' => $getdata->id]);
        }
    }

    public function getCoSoTuyenSinhTheoLoaiHinh(Request $request)
    {
        $id = $request->id;
        $getdata = $this->SoLieuTuyenSinhService->getCoSoTuyenSinhTheoLoaiHinh($id);
        return $getdata;
    }

    public function getXaPhuongTheoQuanHuyen(Request $request)
    {
        $id = $request->id;
        $getdata = $this->SoLieuTuyenSinhService->getXaPhuongTheoQuanHuyen($id);
        return $getdata;
    }
    public function getNgheTheoCapBac(Request $request)
    {
        $id = $request->id;
        $cap_nghe = $request->cap;
        $getdata = $this->SoLieuTuyenSinhService->getNgheTheoCapBac($id, $cap_nghe);
        return $getdata;
    }

        // thanhnv 6/25/2020 update change to service 

        public function exportBieuMau(Request $request){
            $id_co_so = $request->id_cs;
            $this->SoLieuTuyenSinhService->exportBieuMau($id_co_so);
        }

        public function exportData(ExportDuLieu $request){
            $listCoSoId = $request->truong_id;
            $dateFrom = $request->dateFrom;
            $dateTo = $request->dateTo;
    
            $changeFrom = strtotime($dateFrom); 
            $fromDate = date("Y-m-d", $changeFrom);
    
            $changeTo = strtotime($dateTo); 
            $toDate = date("Y-m-d", $changeTo);
            $this->SoLieuTuyenSinhService->exportData($listCoSoId ,$fromDate,$toDate);
        }

        public function importFile(Request $request){
            $dot=$request->dot;
            $year=$request->nam;
            $nameFile=$request->file->getClientOriginalName();
            $nameFileArr=explode('.',$nameFile);
            $duoiFile=end($nameFileArr);
            
            $fileRead = $_FILES['file']['tmp_name'];
            $kq =  $this->SoLieuTuyenSinhService->importFile($fileRead, $duoiFile, $year, $dot);
    
            if($kq=='errorkitu'){
                    return response()->json('exportError',200);   
            }else if($kq=='ok'){
                    return response()->json('ok',200); 
            }else if($kq=='NgheUnsign'){
                    return response()->json(['messageError' => ' Số lượng nghề không phù hợp với nghề đã đăng kí' ],200);   
            }else if($kq=='noCorrectIdTruong'){
                return response()->json(['messageError' => ' Trường không đúng hãy nhập lại' ],200);   
            }else if($kq=='ngheKoThuocTruong'){
                return response()->json(['messageError' => 'Có nghề không thuộc trong trường' ],200);   
            }else{
                return response()->json(['messageError' => $kq ],200);   
            }

        }
    
        public function importError(Request $request){
            $dot=$request->dot;
            $year=$request->nam;
    
            $nameFile=$request->file_import->getClientOriginalName();
            $nameFileArr=explode('.',$nameFile);
            $duoiFile=end($nameFileArr);
    
            $fileRead = $_FILES['file_import']['tmp_name'];
            $pathLoad = Storage::putFile(
                'uploads/excels',
                $request->file('file_import')
            );
            // $path = str_replace('/', '\\', $pathLoad);  
            $this->SoLieuTuyenSinhService->importError($fileRead, $duoiFile,$pathLoad);
        }

        public function exportFollowSreach(Request $request){
            $params = $request->all();
            $data = $this->SoLieuTuyenSinhService->exportFollowSreach($params);
        }
}
