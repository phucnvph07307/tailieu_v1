<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PheDuyetBaoCaoService;
use App\Models\PheDuyetBaoCao;
use App\Http\Requests\PheDuyetBaoCao\PheDuyetRequest;
use Arr;
use DB;

class PheDuyetController extends Controller
{
    protected $pheDuyetBaoCaoService;

    public function __construct(
        PheDuyetBaoCaoService $pheDuyetBaoCaoService
    ) {
        $this->pheDuyetBaoCaoService = $pheDuyetBaoCaoService;
    }

    public function danhSach()
    {
        $danhSachBaoCao = $this->pheDuyetBaoCaoService->getDanhSachBaoCao();

        return view('phe_duyet.danh_sach', [
            'danhSachBaoCao' => $danhSachBaoCao,
        ]);
    }

    public function pheDuyet(PheDuyetRequest $request, PheDuyetBaoCao $baoCao)
    {
        $params = [
            'trang_thai' => $request->get('trang_thai'),
            'li_do_tu_choi' => $request->get('li_do_tu_choi') ?? '',
        ];
        $danhSachBaoCao = $this->pheDuyetBaoCaoService->pheDuyetBaoCao($baoCao, $params);
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Thay đổi trạng thái thành công!',
            ]);
        }

        return redirect()->route('phe_duyet_bao_cao.danh_sach');
    }

    public function getListTrangThai(PheDuyetBaoCao $baoCao)
    {
        $selects = [
            'id',
            DB::raw('ten_trang_thai AS text'),
        ];
        
        $listTrangThai = $this->pheDuyetBaoCaoService->getListTrangThai($baoCao, $selects);

        return response()->json([
            'listTrangThai' => $listTrangThai,
        ]);
    }
}
