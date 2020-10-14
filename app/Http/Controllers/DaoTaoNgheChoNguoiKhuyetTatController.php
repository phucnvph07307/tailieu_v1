<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\DaoTaoNgheChoNguoiKhuyetTatService;

use App\Http\Requests\DaoTaoNgheChoNguoiKhuyetTat\StoreRequest;

use App\Http\Requests\DaoTaoNgheChoNguoiKhuyetTat\UpdateRequest;
use App\Http\Requests\Excel\ExportDuLieu;


class DaoTaoNgheChoNguoiKhuyetTatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $DaoTaoNgheChoNguoiKhuyetTatService;

	public function __construct(DaoTaoNgheChoNguoiKhuyetTatService $DaoTaoNgheChoNguoiKhuyetTatService){
		$this->DaoTaoNgheChoNguoiKhuyetTatService = $DaoTaoNgheChoNguoiKhuyetTatService;
    }
    
    public function index()
    {
        $params = request()->all();
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $data = $this->DaoTaoNgheChoNguoiKhuyetTatService->index($params,$limit);
        $coso = $this->DaoTaoNgheChoNguoiKhuyetTatService->getTenCoSoDaoTao();
        $quanhuyen = $this->DaoTaoNgheChoNguoiKhuyetTatService->getTenQuanHuyen();
        $nghe_cap_2 = $this->DaoTaoNgheChoNguoiKhuyetTatService->getNganhNghe(2);
        if(isset(request()->devvn_quanhuyen)){
            $xaphuongtheoquanhuyen = $this->DaoTaoNgheChoNguoiKhuyetTatService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        }else{
            $xaphuongtheoquanhuyen=[];
        }
        
            $nghe_cap_3=$this->DaoTaoNgheChoNguoiKhuyetTatService->getNganhNghe(3);
            $nghe_cap_4=$this->DaoTaoNgheChoNguoiKhuyetTatService->getNganhNghe(4);


        $loaiHinh = $this->DaoTaoNgheChoNguoiKhuyetTatService->getListLoaiHinh();
        $data->appends(request()->input())->links();
        return view('tong_hop_nghe_nguoi_khuyet_tat.index', [
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
        $data = $this->DaoTaoNgheChoNguoiKhuyetTatService->getTenCoSoDaoTao();
        return view('tong_hop_nghe_nguoi_khuyet_tat.create',['ten_co_so'=>$data]);
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

        $result = $this->DaoTaoNgheChoNguoiKhuyetTatService->getCheckTonTaiDaoTaoChoNguoiKhuyetTat($data, $requestParams);
        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    public function getCheckTonTaiDaoTaoChoNguoiKhuyetTat(Request $request)
    {
        $datacheck=  $request->datacheck;
        $getdata = $this->DaoTaoNgheChoNguoiKhuyetTatService->getSoLieu($datacheck);
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
                'result' => route('nhapbc.dao-tao-khuyet-tat.edit', ['id' => $getdata->id]),
            ]);
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
        $thongtincoso = $this->DaoTaoNgheChoNguoiKhuyetTatService->getThongTinCoSo($id);
        $data = $this->DaoTaoNgheChoNguoiKhuyetTatService->getChiTietDaoTaoNgheChoNguoiKhuyetTat($id, $limit, $params);
        $data->appends(request()->input())->links();
        return view('tong_hop_nghe_nguoi_khuyet_tat.show', [
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
        $data = $this->DaoTaoNgheChoNguoiKhuyetTatService->edit($id);
        return view('tong_hop_nghe_nguoi_khuyet_tat.edit',["data"=>$data]);
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
        $this->DaoTaoNgheChoNguoiKhuyetTatService->updateData($id,$request);
        $get_id = $this->DaoTaoNgheChoNguoiKhuyetTatService->findById($id);
        return redirect()->route('nhapbc.dao-tao-khuyet-tat.show', ['id' => $get_id->co_so_id])->with('thongbao','Sửa số liệu đào tạo nghề cho người khuyết tật');
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
        $this->DaoTaoNgheChoNguoiKhuyetTatService->exportBieuMau($id_co_so);
    }
    public function exportData(ExportDuLieu $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->DaoTaoNgheChoNguoiKhuyetTatService->exportData($listCoSoId, $fromDate, $toDate);
    }

    public function importFile(Request $request){
        $dot=$request->dot;
        $year=$request->nam;
        $nameFile=$request->file->getClientOriginalName();
        $nameFileArr=explode('.',$nameFile);
        $duoiFile=end($nameFileArr);
        
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->DaoTaoNgheChoNguoiKhuyetTatService->importFile($fileRead, $duoiFile, $year, $dot);

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
        $this->DaoTaoNgheChoNguoiKhuyetTatService->importError($fileRead, $duoiFile);
    }

}
