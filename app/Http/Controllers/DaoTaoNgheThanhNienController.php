<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DaoTaoNgheChoThanhNienService;
use App\Http\Requests\DaoTaoThanhNien\UpdateRequest;
use App\Http\Requests\DaoTaoThanhNien\StoreRequest;
use App\Http\Requests\Excel\ExportDuLieu;

class DaoTaoNgheThanhNienController extends Controller
{

    protected $DaoTaoNgheChoThanhNienService;

	public function __construct(DaoTaoNgheChoThanhNienService $DaoTaoNgheChoThanhNienService){
		$this->DaoTaoNgheChoThanhNienService = $DaoTaoNgheChoThanhNienService;
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
        
        $data = $this->DaoTaoNgheChoThanhNienService->index($params,$limit);
        $coso = $this->DaoTaoNgheChoThanhNienService->getTenCoSoDaoTao();
        $quanhuyen = $this->DaoTaoNgheChoThanhNienService->getTenQuanHuyen();
        $nghe_cap_2 = $this->DaoTaoNgheChoThanhNienService->getNganhNghe(2);
        if(isset(request()->devvn_quanhuyen)){
            $xaphuongtheoquanhuyen = $this->DaoTaoNgheChoThanhNienService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        }else{
            $xaphuongtheoquanhuyen=[];
        }
        
            $nghe_cap_3=$this->DaoTaoNgheChoThanhNienService->getNganhNghe(3);
            $nghe_cap_4=$this->DaoTaoNgheChoThanhNienService->getNganhNghe(4);


        $loaiHinh = $this->DaoTaoNgheChoThanhNienService->getListLoaiHinh();
        $data->appends(request()->input())->links();
        return view('dao_tao_nghe_cho_thanh_nien.index', [
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
        $data = $this->DaoTaoNgheChoThanhNienService->getTenCoSoDaoTao();
        return view('dao_tao_nghe_cho_thanh_nien.create',['ten_co_so'=>$data]);
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

        $result = $this->DaoTaoNgheChoThanhNienService->getCheckDaoTaoThanhNien($data, $requestParams);
        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    public function getCheckDaoTaoThanhNien(Request $request)
    {
        $datacheck=  $request->datacheck;
        $getdata = $this->DaoTaoNgheChoThanhNienService->getSoLieu($datacheck);
        if($getdata == 'tontai'){
            return 1;
        }else if($getdata == null){
            return 2;
        }else{
            return $urledit = route('nhapbc.dao-tao-thanh-nien.edit', ['id' => $getdata->id]);
        }
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
        $thongtincoso = $this->DaoTaoNgheChoThanhNienService->getThongTinCoSo($id);
        $nganh_nghe_cap_4_thuoc_co_so = $this->DaoTaoNgheChoThanhNienService->getNganhNgheThuocCoSo($id);
        $data = $this->DaoTaoNgheChoThanhNienService->getChiTietDaoTaoNgheThanhNien($id,$limit,$params);
        $data->appends(request()->input())->links();
        return view('dao_tao_nghe_cho_thanh_nien.show', [
            'data' => $data,
            'limit' => $limit,
            'params'=> $params,
            'thongtincoso' => $thongtincoso,
            'nganh_nghe_cap_4_thuoc_co_so' => $nganh_nghe_cap_4_thuoc_co_so
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
        $data = $this->DaoTaoNgheChoThanhNienService->edit($id);
        return view('dao_tao_nghe_cho_thanh_nien.edit',["data"=>$data]);
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
        $this->DaoTaoNgheChoThanhNienService->updateData($id,$request);
        $get_id = $this->DaoTaoNgheChoThanhNienService->findById($id);
        return redirect()->route('nhapbc.dao-tao-thanh-nien.show', ['id' => $get_id->co_so_id])->with('thongbao','Sửa số liệu đào tạo nghề cho thanh niên thành công');
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

    public function exportForm(Request $request){
        $id_co_so = $request->id_cs;
        $this->DaoTaoNgheChoThanhNienService->exportBieuMau($id_co_so);
    }
    public function exportData(ExportDuLieu $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom); 
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo); 
        $toDate = date("Y-m-d", $changeTo);
        $this->DaoTaoNgheChoThanhNienService->exportData($listCoSoId ,$fromDate,$toDate);
    }

    public function importFile(Request $request){
        $dot=$request->dot;
        $year=$request->nam;
        $nameFile=$request->file->getClientOriginalName();
        $nameFileArr=explode('.',$nameFile);
        $duoiFile=end($nameFileArr);
        
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->DaoTaoNgheChoThanhNienService->importFile($fileRead, $duoiFile, $year, $dot);

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
        $this->DaoTaoNgheChoThanhNienService->importError($fileRead, $duoiFile);
    }
}
