<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SoLieuCanBoQuanLyService;
use App\Http\Requests\SoLieuCanBoQuanLy\StoreRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SoLieuCanBoQuanLy\UpdateRequest;
use App\Models\SoLieuCanBoQuanLy;
use App\CoSoDaoTao;
use Storage;

class SoLieuCanBoQuanLyController extends Controller
{
    protected $soLieuCBQLService;

    public function __construct(
        SoLieuCanBoQuanLyService $soLieuCanBoQuanLyService
    ) {
        $this->soLieuCBQLService = $soLieuCanBoQuanLyService;

        $this->middleware('permission:danh_sach_doi_ngu_quan_ly', ['only' => ['index']]);
        $this->middleware('permission:them_moi_danh_sach_doi_ngu_quan_ly', ['only' => ['create','store']]);
        $this->middleware('permission:cap_nhat_danh_sach_doi_ngu_quan_ly', ['only' => ['edit','update']]);
        $this->middleware('permission:xem_chi_tiet_danh_sach_doi_ngu_quan_ly', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filterConfig = $this->soLieuCBQLService->getFilterConfig();
        $params = request()->except(['limit']);
        $limit = request()->get('paginate_size') ?? config('common.paginate_size.default');

        $data = $this->soLieuCBQLService->getList($params, $limit);
        $data->appends(request()->input())->links();

        // thanh
        $co_so = DB::table('co_so_dao_tao')->get();

        $routeShow = auth()->user()->can('xem_chi_tiet_danh_sach_doi_ngu_quan_ly')
            ? 'so-lieu-can-bo-quan-ly.show' : '';

        $routeEdit = auth()->user()->can('cap_nhat_danh_sach_doi_ngu_quan_ly')
            ? 'so-lieu-can-bo-quan-ly.edit' : '';

        $titles = config('tables.so_lieu_can_bo_quan_ly');
        return view('so_lieu_can_bo_quan_ly.index', [
            'filterConfig' => $filterConfig,
            'data' => $data,
            'limit' => $limit,
            'titles' => $titles,
            'route_edit' => $routeEdit,
            'route_show' => $routeShow,
            'coso' => $co_so,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listCoSo = $this->soLieuCBQLService->getListCoSo();
        $listNam = config('common.nam.list');
        $listDot = config('common.dot');
        
        return view('so_lieu_can_bo_quan_ly.create', [
            'listCoSo' => $listCoSo,
            'listNam' => array_combine($listNam, $listNam),
            'listDot' => array_combine($listDot, $listDot),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $params = $request->except([
            '_token',
            'loai_hinh_co_so_id',
        ]);
        $kq = $this->soLieuCBQLService->checkTonTaiKhiThem($params);
        if($kq){
            return redirect()->route('so-lieu-can-bo-quan-ly.create')->with(['edit'=> $kq->id])->withInput();
        }

        $soLieuQL = $this->soLieuCBQLService->store($params);

        return redirect()->route('so-lieu-can-bo-quan-ly.index')->with(['success'=> 'them  thanh cong']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($soLieuId)
    {
        $params = request()->except([
            'paginate_size',
        ]);

        $coSoDaoTao = $this->soLieuCBQLService->getCoSo($soLieuId);

        $limit = request()->get('paginate_size') ?? config('common.paginate_size.default');
        $listSoLieu = $this->soLieuCBQLService->getListByCoSo($coSoDaoTao->id, $limit, $params);

        $listSoLieu->appends(request()->input())->links();

        return view('so_lieu_can_bo_quan_ly.show', [
            'coSoDaoTao' => $coSoDaoTao,
            'listSoLieu' => $listSoLieu,
            'limit' => $limit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SoLieuCanBoQuanLy $soLieuCanBoQuanLy)
    {
        $listCoSo = $this->soLieuCBQLService->getListCoSo();
        $listNam = config('common.nam.list');
        $listDot = config('common.dot');
        $data = array_merge($soLieuCanBoQuanLy->getAttributes(), session()->getOldInput());

        return view('so_lieu_can_bo_quan_ly.edit', [
            'listCoSo' => $listCoSo,
            'listNam' => array_combine($listNam, $listNam),
            'listDot' => array_combine($listDot, $listDot),
            'data' => $data,
        ]);
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
        $params = $request->except([
            '_method',
            '_token',
            'co_so_dao_tao_id',
            'loai_hinh_co_so_id',
        ]);

        $result = $this->soLieuCBQLService->updateSoLieu($id, $params);
        return redirect()->route('so-lieu-can-bo-quan-ly.index')->with(['update'=> 'cap nhat thanh cong']);
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

    // thanhvn update change service 6/24/2020
    public function exportBieuMau(Request $request){
        $id_co_so = $request->id_cs;
        $this->soLieuCBQLService->exportBieuMau($id_co_so);
    }
    
    public function exportData(Request $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->soLieuCBQLService->exportData($listCoSoId, $fromDate, $toDate);
    }

    public function importFile(Request $request){
        $dot=$request->dot;
        $year=$request->nam;
        $nameFile=$request->file->getClientOriginalName();
        $nameFileArr=explode('.',$nameFile);
        $duoiFile=end($nameFileArr);
        
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->soLieuCBQLService->importFile($fileRead, $duoiFile, $year, $dot);

        if($kq=='errorkitu'){
                return response()->json('exportError',200);   
        }else if($kq=='ok'){
                return response()->json('ok',200); 
        }else if($kq=='nhapKhongDungDong'){
                return response()->json(['messageError' => 'Chỉ nhập đúng dòng trường đã chọn' ],200);   
        }else if($kq=='noCorrectIdTruong'){
            return response()->json(['messageError' => ' Trường không đúng hãy nhập lại' ],200);   
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
        $this->soLieuCBQLService->importError($fileRead, $duoiFile,$pathLoad);
    }
}
