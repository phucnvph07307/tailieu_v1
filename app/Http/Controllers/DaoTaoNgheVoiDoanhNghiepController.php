<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DaoTaoNgheVoiDoanhNghiepService;

use App\Http\Requests\DaoTaoNgheVoiDoanhNghiep\UpdateRequest;

use App\Http\Requests\DaoTaoNgheVoiDoanhNghiep\StoreRequest;
use App\Http\Requests\Excel\ExportDuLieu;

use Storage;

class DaoTaoNgheVoiDoanhNghiepController extends Controller
{
    protected $DaoTaoNgheVoiDoanhNghiepService;
    public function __construct(DaoTaoNgheVoiDoanhNghiepService $DaoTaoNgheVoiDoanhNghiepService)
    {
       $this->DaoTaoNgheVoiDoanhNghiepService = $DaoTaoNgheVoiDoanhNghiepService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = request()->all();
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $data = $this->DaoTaoNgheVoiDoanhNghiepService->index($params,$limit);
        $coso = $this->DaoTaoNgheVoiDoanhNghiepService->getTenCoSoDaoTao();
        $quanhuyen = $this->DaoTaoNgheVoiDoanhNghiepService->getTenQuanHuyen();
        $nghe_cap_2 = $this->DaoTaoNgheVoiDoanhNghiepService->getNganhNghe(2);
        if(isset(request()->devvn_quanhuyen)){
            $xaphuongtheoquanhuyen = $this->DaoTaoNgheVoiDoanhNghiepService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        }else{
            $xaphuongtheoquanhuyen=[];
        }
        
            $nghe_cap_3=$this->DaoTaoNgheVoiDoanhNghiepService->getNganhNghe(3);
            $nghe_cap_4=$this->DaoTaoNgheVoiDoanhNghiepService->getNganhNghe(4);


        $loaiHinh = $this->DaoTaoNgheVoiDoanhNghiepService->getListLoaiHinh();
        $data->appends(request()->input())->links();
        return view('dao_tao_nghe_voi_doanh_nghiep.index', [
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->DaoTaoNgheVoiDoanhNghiepService->getTenCoSoDaoTao();
        return view('dao_tao_nghe_voi_doanh_nghiep.create',['ten_co_so'=>$data]);
    }

    public function getCheckTonTaiDaoTaoGanVoiDoanhNghiep(Request $request)
    {
        $datacheck=  $request->datacheck;
        $getdata = $this->DaoTaoNgheVoiDoanhNghiepService->getSoLieu($datacheck);
        if($getdata == 'tontai'){
            return response()->json([
                'result' => 1,
            ]);
        }else if($getdata == null){
            return response()->json([
                'result' => 2,
            ]);
        }else{
            return response()->json([
                'result' => route('xuatbc.dao-tao-nghe-doanh-nghiep.edit', ['id' => $getdata->id]),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $result = $this->DaoTaoNgheVoiDoanhNghiepService->getCheckTonTaiDaoTaoGanVoiDoanhNghiep($data, $requestParams);
        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $params = request()->all();
        $thongtincoso = $this->DaoTaoNgheVoiDoanhNghiepService->getThongTinCoSo($id);
        $data = $this->DaoTaoNgheVoiDoanhNghiepService->show($id, $limit, $params);
        $data->appends(request()->input())->links();
        return view('dao_tao_nghe_voi_doanh_nghiep.show', [
            'data' => $data,
            'limit' => $limit,
            'params' => $params,
            'thongtincoso' => $thongtincoso
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->DaoTaoNgheVoiDoanhNghiepService->edit($id);
        return view('dao_tao_nghe_voi_doanh_nghiep.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->DaoTaoNgheVoiDoanhNghiepService->updateData($id,$request);
        $get_id = $this->DaoTaoNgheVoiDoanhNghiepService->findById($id);
        return redirect()->route('xuatbc.dao-tao-nghe-doanh-nghiep.show', ['id' => $get_id->co_so_id])->with('thongbao','Sửa số liệu đào tạo nghề với doanh nghiệp thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportBieuMau(Request $request){
        $id_co_so = $request->id_cs;
        $this->DaoTaoNgheVoiDoanhNghiepService->exportBieuMau($id_co_so);
    }
    
    public function exportData(ExportDuLieu $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom); 
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo); 
        $toDate = date("Y-m-d", $changeTo);
        $this->DaoTaoNgheVoiDoanhNghiepService->exportData($listCoSoId ,$fromDate,$toDate);
    }

    public function importFile(Request $request){
        $dot=$request->dot;
        $year=$request->nam;
        $nameFile=$request->file->getClientOriginalName();
        $nameFileArr=explode('.',$nameFile);
        $duoiFile=end($nameFileArr);
        
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->DaoTaoNgheVoiDoanhNghiepService->importFile($fileRead, $duoiFile, $year, $dot);

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
        $this->DaoTaoNgheVoiDoanhNghiepService->importError($fileRead, $duoiFile,$pathLoad);
    }

}
