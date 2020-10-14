<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\ChinhSachSinhVienService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChinhSachSinhVienValidate;
use App\Http\Requests\UpdateChinhSachSinhVienValidate;
use Storage;

class ChinhSachSinhVienController extends Controller
{
    protected $ChinhSachSinhVienService;

    public function __construct(ChinhSachSinhVienService $ChinhSachSinhVienService)
    {
        $this->ChinhSachSinhVienService = $ChinhSachSinhVienService;
    }

    public function tonghopchinhsachsinhvien()
    {
        $loaihinh = DB::table('loai_hinh_co_so')->get();
        $quanhuyen = DB::table('devvn_quanhuyen')->get();
        $coso = DB::table('co_so_dao_tao')->get();
        $chinhsach = DB::table('chinh_sach')->get();
        $params = request()->all();
        if (isset(request()->page_size)) {
            $limit = request()->page_size;
        } else {
            $limit = 10;
        }

        $data = $this->ChinhSachSinhVienService->getChinhSachSinhVien($params, $limit);

        $data->appends(request()->input())->links();

        return view('chinhsachsinhvien.tong_hop_chinh_sach_sinh_vien', compact('data', 'loaihinh', 'quanhuyen', 'coso', 'chinhsach', 'limit', 'params'));
    }

    public function themchinhsachsinhvien()
    {
        $coso = DB::table('co_so_dao_tao')->get();
        $chinhsach = DB::table('chinh_sach')->get();
        return view('chinhsachsinhvien.them_chinh_sach_sinh_vien', compact('coso', 'chinhsach'));
    }

    public function postthemchinhsachsinhvien(ChinhSachSinhVienValidate $request)
    {
        $requestParams = $request->all();

        $data = [
            [
                'id' => 'co_so_id',
                'value' => $requestParams['co_so_id']
            ],
            [
                'id' => 'nam',
                'value' => $requestParams['nam']
            ],
            [
                'id' => 'dot',
                'value' => $requestParams['dot']
            ],
            [
                'id' => 'chinh_sach_id',
                'value' => $requestParams['chinh_sach_id']
            ],

        ];
        $result = $this->ChinhSachSinhVienService->checktontaiChinhSachSinhVien($data, $requestParams);

        return redirect($result['route'])->with('thongbao', $result['mess']);
    }

    function checktontaichinhsachsinhvien(Request $request)
    {
        $datacheck =  $request->datacheck;
        $getdata = $this->ChinhSachSinhVienService->getSoLieu($datacheck);
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
                'result' => route('xuatbc.post-sua-chinh-sach-sinh-vien', ['id' => $getdata->id]),
            ]);
        }
    }
    public function suachinhsachsinhvien($id)
    {
        $data = $this->ChinhSachSinhVienService->getsuaChinhSachSinhVien($id);
        return view('chinhsachsinhvien.sua_chinh_sach_sinh_vien', compact('data'));
    }

    public function postsuachinhsachsinhvien($id, UpdateChinhSachSinhVienValidate $request)
    {
        $data = $this->ChinhSachSinhVienService->updateData($id, $request);
        return redirect()->route('xuatbc.tong-hop-chinh-sach-sinh-vien')->with('thongbao_edit', 'Cập nhật số liệu chính sách sinh viên thành công');
    }
    // thanhnv update 6/25/2020

    public function exportBieuMau(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->ChinhSachSinhVienService->exportBieuMau($id_co_so);
    }
    public function exportData(Request $request)
    {
        $listCoSoId = $request->truong_id;
        $nam_muon_xuat = $request->nam_muon_xuat;
        $dot_muon_xuat = $request->dot_muon_xuat;

        $this->ChinhSachSinhVienService->exportData($listCoSoId, $nam_muon_xuat, $dot_muon_xuat);
    }
    public function importFile(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->ChinhSachSinhVienService->importFile($fileRead, $duoiFile, $year, $dot);
        if ($kq == 'errorkitu') {
            return response()->json('exportError', 200);
        } else if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'nhapKhongDungDong') {
            return response()->json(['messageError' => 'Chỉ nhập các ô chính sách trong bảng'], 200);
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
        $this->ChinhSachSinhVienService->importError($fileRead, $duoiFile, $pathLoad);
    }
}
