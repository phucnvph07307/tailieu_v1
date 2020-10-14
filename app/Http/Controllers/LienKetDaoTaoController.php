<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LienKetDaoTaoService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validateUpdateLienKetDaoTao;
use App\Http\Requests\validateCreateLienKetDaoTao;
use App\Http\Requests\Excel\ExportDuLieu;
use Storage;

class LienKetDaoTaoController extends Controller
{
    protected $LienKetDaoTaoService;

    public function __construct(LienKetDaoTaoService $LienKetDaoTaoService)
    {
        $this->LienKetDaoTaoService = $LienKetDaoTaoService;
    }
    public function tonghoplienketdaotao()
    {

        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }
        $data = $this->LienKetDaoTaoService->getTongHopLienKetDaoTao($params, $limit);

        $quanhuyen = $this->LienKetDaoTaoService->getTenQuanHuyen();
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->LienKetDaoTaoService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }
        $bac_nghe = 0;
        $nghe_cap_2 = $this->LienKetDaoTaoService->getNganhNghe(2);
        $nghe_cap_3 = $this->LienKetDaoTaoService->getNganhNghe(3);
        $nghe_cap_4 = $this->LienKetDaoTaoService->getNganhNghe(4);
        $loai_hinh = $this->LienKetDaoTaoService->getLoaiHinhCoSo();
        $coso = $this->LienKetDaoTaoService->getCoSo();
        $data->appends(request()->input())->links();

        return view('lien-ket-dao-tao.tong-hop-lien-ket-dao-tao', compact(
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
    public function tonghoplienketdaotaotheotrinhdo($id)
    {

        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }
        $data = $this->LienKetDaoTaoService->getTongHopLienKetDaoTaoTheoTrinhDo($params, $limit, $id);
        $quanhuyen = $this->LienKetDaoTaoService->getTenQuanHuyen();
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->LienKetDaoTaoService->getXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }
        $bac_nghe = $id;
        $nghe_cap_2 = $this->LienKetDaoTaoService->getNganhNghe(2);
        $nghe_cap_3 = $this->LienKetDaoTaoService->getNganhNghe(3);
        $nghe_cap_4 = $this->LienKetDaoTaoService->getNganhNghe(4);
        $loai_hinh = $this->LienKetDaoTaoService->getLoaiHinhCoSo();
        $coso = $this->LienKetDaoTaoService->getCoSo();
        $data->appends(request()->input())->links();
        $title = "";
        if ($id == 5) {
            $title = "Liên kết đào tạo trình độ Trung Cấp lên Đại Học";

            return view('lien-ket-dao-tao.tong-hop-lien-ket-dao-tao-trung-cap', compact(
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
                'bac_nghe',
                'title'
            ));
        }
        if ($id == 6) {
            $title = "Liên kết đào tạo trình độ Cao Đẳng lên Đại Học";

            return view('lien-ket-dao-tao.tong-hop-lien-ket-dao-tao-cao-dang', compact(
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
                'bac_nghe',
                'title'
            ));
        }
    }
    public function getmanganhnghe(Request $request)
    {
        $data = $this->LienKetDaoTaoService->getNganhNghe($request->id);
        return $data;
    }
    public function getNgheTheoCapBac(Request $request)
    {
        $id = $request->id;
        $cap_nghe = $request->cap;
        $getdata = $this->LienKetDaoTaoService->getNgheTheoCapBac($id, $cap_nghe);
        return $getdata;
    }

    public function chitietlienketdaotao($co_so_id, $bac_nghe)
    {

        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 20;
        }
        $params = request()->all();
        $data = $this->LienKetDaoTaoService->chitietlienketdaotao($co_so_id, $params, $limit, $bac_nghe);
        $data->appends(request()->input())->links();
        $co_so = $this->LienKetDaoTaoService->findCoSoDaoTao($co_so_id);

        if ($bac_nghe == 6) {
            return view('lien-ket-dao-tao.chi-tiet-lien-ket-dao-tao-cao-dang', compact('data', 'params', 'limit', 'co_so', 'bac_nghe'));
        }
        if ($bac_nghe == 5) {
            return view('lien-ket-dao-tao.chi-tiet-lien-ket-dao-tao-trung-cap', compact('data', 'params', 'limit', 'co_so', 'bac_nghe'));
        } else {
            return view('lien-ket-dao-tao.chi-tiet-lien-ket-dao-tao', compact('data', 'params', 'limit', 'co_so', 'bac_nghe'));
        }
    }

    public function sualienketdaotao($id, $bac_nghe)
    {
        $data = $this->LienKetDaoTaoService->sualienketdaotao($id, $bac_nghe);

        return view('lien-ket-dao-tao.chinh-sua-lien-ket-dao-tao', compact('data', 'bac_nghe'));
    }

    public function postsualienketdaotao($id, validateUpdateLienKetDaoTao $request, $bac_nghe, $co_so_id)
    {

        $data = $this->LienKetDaoTaoService->updateData($id, $request,$bac_nghe);

        return redirect()->route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $co_so_id, 'bac_nghe' => $bac_nghe])->with('thongbao_update', 'Cập nhật số liệu thành công');
    }

    public function themlienketdaotao()
    {
        $data = $this->LienKetDaoTaoService->getCoSo();
        return view('lien-ket-dao-tao.them-moi-lien-ket-dao-tao', compact('data'));
    }

    public function themlienketdaotaoCD()
    {
        $data = $this->LienKetDaoTaoService->getCoSo();
        return view('lien-ket-dao-tao.them-moi-lien-ket-dao-tao-cao-dang', compact('data'));
    }
    public function themlienketdaotaoTC()
    {
        $data = $this->LienKetDaoTaoService->getCoSo();
        return view('lien-ket-dao-tao.them-moi-lien-ket-dao-tao-trung-cap', compact('data'));
    }

    public function postthemlienketdaotao(validateCreateLienKetDaoTao $request, $id)
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

        $result = $this->LienKetDaoTaoService->getCheckTonTaiLienKetDaoTao($data, $requestParams, $id);

        return redirect($result['route'])->with('thongbao', $result['message']);
    }

    public function getCheckTonTaiLienKetDaoTaoTrinhDo(Request $request, $id)
    {
        $datacheck =  $request->datacheck;

        $getdata = $this->LienKetDaoTaoService->getSoLieu($datacheck);

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
                'result' => route('xuatbc.sua-lien-ket-dao-tao', ['id' => $getdata->id, 'bac_nghe' => $id]),
            ]);
        }
    }

    public function exportForm(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->LienKetDaoTaoService->exportBieuMau($id_co_so);
    }
    public function exportData(ExportDuLieu $request)
    {
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->LienKetDaoTaoService->exportData($listCoSoId, $fromDate, $toDate);
    }


    public function importFile(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        // $fileRead = $_FILES['file']['tmp_name'];
        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->LienKetDaoTaoService->importFile($fileRead, $duoiFile, $year, $dot);

        if ($kq == 'errorkitu') {
            return response()->json('exportError', 200);
        } else if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'NgheUnsign') {
            return response()->json(['messageError' => ' Số lượng nghề không phù hợp với nghề đã đăng kí'], 200);
        } else if ($kq == 'noCorrectIdTruong') {
            return response()->json(['messageError' => ' Trường không đúng '], 200);
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
        $this->LienKetDaoTaoService->importError($fileRead, $duoiFile, $pathLoad);
    }
}
