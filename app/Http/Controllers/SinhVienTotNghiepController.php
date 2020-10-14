<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SinhVienTotNghiepService;
use App\Http\Requests\TotNghiep\UpdateRequest;
use App\Http\Requests\TotNghiep\StoreRequest;

use App\Http\Requests\Excel\ExportDuLieu;
use Storage;

class SinhVienTotNghiepController extends Controller
{
    protected $SinhVienTotNghiepService;

	public function __construct(SinhVienTotNghiepService $SinhVienTotNghiepService){
		$this->SinhVienTotNghiepService = $SinhVienTotNghiepService;
    }

    public function index()
    {
        $params = request()->all();
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        
        $data = $this->SinhVienTotNghiepService->index($params,$limit);
        $coso = $this->SinhVienTotNghiepService->getTenCoSoDaoTao();
        $quanhuyen = $this->SinhVienTotNghiepService->getTenQuanHuyen();
        $nghe_cap_2 = $this->SinhVienTotNghiepService->getNganhNghe(2);
        if(isset(request()->devvn_quanhuyen)){
            $xaphuongtheoquanhuyen = $this->SinhVienTotNghiepService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        }else{
            $xaphuongtheoquanhuyen=[];
        }
        
            $nghe_cap_3=$this->SinhVienTotNghiepService->getNganhNghe(3);
            $nghe_cap_4=$this->SinhVienTotNghiepService->getNganhNghe(4);


        $loaiHinh = $this->SinhVienTotNghiepService->getListLoaiHinh();
        $data->appends(request()->input())->links();
        // dd($data);
        return view('tot_nghiep.tong_hop_ket_qua_tot_nghiep', [
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
    public function show($coSoId)
    {
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $params = request()->all();
        $thongtincoso = $this->SinhVienTotNghiepService->getThongTinCoSo($coSoId);
        $data = $this->SinhVienTotNghiepService->getChiTietTongHopTotNghiep($coSoId,$limit,$params);
        $data->appends(request()->input())->links();
        return view('tot_nghiep.chi_tiet_tong_hop_ket_qua_tot_nghiep', [
            'data' => $data,
            'limit' => $limit,
            'params'=>$params,
            'thongtincoso'=>$thongtincoso 
        ]);
    }
    public function edit($id)
    {  
        $data_tot_nghiep_id = $this->SinhVienTotNghiepService->getSuaSoLieuTotNghiep($id);
        return view('tot_nghiep.sua_tong_hop_ket_qua_tot_nghiep',['data_tot_nghiep_id'=>$data_tot_nghiep_id]);
    }

    public function update($id,UpdateRequest $request)
    {
        $data = $this->SinhVienTotNghiepService->updateData($id,$request);
        $data_tot_nghiep =$this->SinhVienTotNghiepService->findById($id);
        return redirect()->route('xuatbc.chi-tiet-tong-hop', ['id' => $data_tot_nghiep->co_so_id])->with('thongbao','Sửa số liệu tuyển sinh thành công');
    }

    public function create()
    {
        $data = $this->SinhVienTotNghiepService->getTenCoSoDaoTao();
        return view('tot_nghiep.them_tong_hop_ket_qua_tot_nghiep',compact('data'));
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
                'id'=>'nghe_id',
                'value'=>$requestParams["nghe_id"]
            ],
            [
                'id'=>'nam',
                'value'=>$requestParams["nam"]
            ],
            [
                'id'=>'dot',
                'value'=>$requestParams["dot"]
            ],
        ];

        $result = $this->SinhVienTotNghiepService->getCheckTonTaiSoLieuTotNghiep($data, $requestParams);
        return redirect($result['route'])->with('thongbao', $result['message']);
    }


    public function getCheckTonTaiSoLieuTotNghiep(Request $request)
    {
        $datacheck=  $request->datacheck;
        $getdata = $this->SinhVienTotNghiepService->getSoLieu($datacheck);
        if($getdata == 'tontai'){
            return 1;
        }else if($getdata == null){
            return 2;
        }else{
            return $urledit = route('xuatbc.sua-tong-hop', ['id' => $getdata->id]);
        }
    }
    // thanhnv 6/25/2020 update change to service 

    public function exportBieuMau(Request $request){
        $id_co_so = $request->id_cs;
        $this->SinhVienTotNghiepService->exportBieuMau($id_co_so);
    }
    
    public function exportData(ExportDuLieu $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom); 
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo); 
        $toDate = date("Y-m-d", $changeTo);
        $this->SinhVienTotNghiepService->exportData($listCoSoId ,$fromDate,$toDate);
    }

    public function importFile(Request $request){
        $dot=$request->dot;
        $year=$request->nam;
        $nameFile=$request->file->getClientOriginalName();
        $nameFileArr=explode('.',$nameFile);
        $duoiFile=end($nameFileArr);
        
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->SinhVienTotNghiepService->importFile($fileRead, $duoiFile, $year, $dot);

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
        $this->SinhVienTotNghiepService->importError($fileRead, $duoiFile,$pathLoad);
    }
}
