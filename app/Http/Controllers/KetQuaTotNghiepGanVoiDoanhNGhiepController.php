<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KetQuaTotNghiepGanVoiDoanhNGhiepService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validateUpdateKetQuaTotNghiepGanVoiDoanhNghiep;
use App\Http\Requests\Excel\ExportDuLieu;
use Storage;
use App\Http\Requests\validateKetQuaTotNghiepGanVoiDoanhNghiep;

class KetQuaTotNghiepGanVoiDoanhNGhiepController extends Controller
{
    protected $KetQuaTotNghiepGanVoiDoanhNGhiepService;

    public function __construct(KetQuaTotNghiepGanVoiDoanhNGhiepService $KetQuaTotNghiepGanVoiDoanhNGhiepService)
    {
        $this->KetQuaTotNghiepGanVoiDoanhNGhiepService = $KetQuaTotNghiepGanVoiDoanhNGhiepService;
    }
    public function index()
    {
        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }
        $data = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getKetQuaTotNghiepGanVoiDoanhNghiep($params, $limit);

        $quanhuyen = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getTenQuanHuyen();
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }
        $bac_nghe = 0;
        $nghe_cap_2 = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getNganhNghe(2);
        $nghe_cap_3 = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getNganhNghe(3);
        $nghe_cap_4 = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getNganhNghe(4);
        $loai_hinh = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getLoaiHinhCoSo();
        $coso = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getCoSo();
        $data->appends(request()->input())->links();

        return view('ket-qua-tot-nghiep-voi-doanh-nghiep.ket-qua-hssv-tot-nghiep-dao-tao-nghe-gan-voi-doanh-nghiep', compact(
            'data',
            'quanhuyen',
            'xaphuongtheoquanhuyen',
            'params',
            'limit',
            'nghe_cap_2',
            'nghe_cap_3',
            'nghe_cap_4',
            'loai_hinh',
            'coso',
            'bac_nghe'
        ));
    }

    public function show($co_so_id)
    {
        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }

        $params = request()->all();
        $data = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->ChiTietKetQuaTotNghiepGanVoiDoanhNghiep($co_so_id, $params, $limit);
        $data->appends(request()->input())->links();
        //dd($data);
        $co_so = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->findCoSoDaoTao($co_so_id);
        return view('ket-qua-tot-nghiep-voi-doanh-nghiep.chi-tiet-ket-qua-hssv-tot-nghiep-dao-tao-nghe-gan-voi-doanh-nghiep', compact('data', 'params', 'limit', 'co_so'));
    }

    public function edit($id)
    {
        $data = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->SuaKetQuaTotNghiepGanVoiDoanhNghiep($id);

        return view('ket-qua-tot-nghiep-voi-doanh-nghiep.sua-ket-qua-hssv-tot-nghiep-dao-tao-nghe-gan-voi-doanh-nghiep', compact('data'));
    }

    public function update($id, validateUpdateKetQuaTotNghiepGanVoiDoanhNghiep $request, $co_so_id)
    {

        $data = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->updateData($id, $request);
        return redirect()->route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $co_so_id])->with('thongbao_edit', 'Cập nhật số liệu thành công');
    }

    public function create()
    {
        $data = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getCoSo();
        return view('ket-qua-tot-nghiep-voi-doanh-nghiep.them-ket-qua-hssv-tot-nghiep-dao-tao-nghe-gan-voi-doanh-nghiep', compact('data'));
    }

    public function store(validateKetQuaTotNghiepGanVoiDoanhNghiep $request)
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
        $result = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getCheckTonTai($data, $requestParams);

        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    public function getCheckTonTai(Request $request)
    {
        $datacheck =  $request->datacheck;
        $getdata = $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->getSoLieu($datacheck);
        if ($getdata == 'tontai') {
            return response()->json([
                'result' => 1,
            ]);
        } else if ($getdata == null) {
            return response()->json([
                'result' => 2,
            ]);
        } else {
            return response()->json([
                'result' => route('xuatbc.sua-ket-qua-tot-nghiep-voi-doanh-nghiep', ['id' => $getdata->id]),
            ]);
        }
    }

    // thanhnv 6/22/2020 import export

    public function exportBieuMau(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->exportBieuMau($id_co_so);
    }

    public function exportData(ExportDuLieu $request){
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->exportData($listCoSoId, $fromDate, $toDate);
    }

    public function importFile(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];

        $kq =  $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->importFile($fileRead, $duoiFile, $year, $dot);

        if ($kq == 'errorkitu') {
            return response()->json('exportError', 200);
        } else if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'NgheUnsign') {
            return response()->json(['messageError' => ' Số lượng nghề không phù hợp với nghề đã đăng kí'], 200);
        } else if ($kq == 'noCorrectIdTruong') {
            return response()->json(['messageError' => ' Trường không đúng hãy nhập lại'], 200);
        } else if ($kq == 'ngheKoThuocTruong') {
            return response()->json(['messageError' => 'Có nghề không thuộc trong trường'], 200);
        } else {
            return response()->json(['messageError' => $kq], 200);
        }
    }

    public function importError(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;

        $nameFile = $request->file_import->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file_import']['tmp_name'];
        $pathLoad = Storage::putFile(
            'uploads/excels',
            $request->file('file_import')
        );
        // $path = str_replace('/', '\\', $pathLoad);
        $this->KetQuaTotNghiepGanVoiDoanhNGhiepService->importError($fileRead, $duoiFile, $pathLoad);
    }
}
