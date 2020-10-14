<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GiaoVienService;
use App\Http\Requests\GiaoVien\StoreRequest;
use App\Http\Requests\GiaoVien\UpdateRequest;
use App\Models\GiaoVien;
use Illuminate\Support\Facades\DB;

class QuanLyGiaoVienController extends Controller
{
    protected $giaoVienService;

    public function __construct(
        GiaoVienService $giaoVienService
    ) {
        $this->giaoVienService = $giaoVienService;
       

    }

    public function index()
    {
        $filterConfig = $this->giaoVienService->getFilterConfig();
        $limit = request()->get('paginate_size') ?? config('common.paginate_size.default');
        $params = request()->except(['limit']);

        $data = $this->giaoVienService->getList($params, $limit);
        $data->appends(request()->input())->links();

        $titles = config('tables.quan_ly_giao_vien');
        //  thanhnv them coso 

        $routeEdit = auth()->user()->can('cap_nhat_quan_ly_giao_vien')
            ? 'ql-giao-vien.edit' : '';

        $coso = DB::table('co_so_dao_tao')->get();
        return view('ql_giao_vien.index', [
            'filterConfig' => $filterConfig,
            'data' => $data,
            'limit' => $limit,
            'titles' => $titles,
            'coso' => $coso,
            'route_edit' => $routeEdit,
            // 'route_show' => 'ql-giao-vien.show',
        ]);
    }

    public function create()
    {
        $listCoSo = $this->giaoVienService->getListCoSo();
        $listTrinhDo = $this->giaoVienService->getListTrinhDo();
        $listNganhNghe = $this->giaoVienService->getListNganhNghe();

        /*
         * Do khi validate fail StoreRequest sẽ redirect về route này,
         * $oldInput['nganh_nghe'] = [ 'id1', 'id2' ]
         * nên cần query để format lại old('nganh_nghe') để lấy được id & tên
         */
        if (!empty(old('nganh_nghe'))) {
            $oldInputNganhNghe = $this->giaoVienService
                ->getListNganhNghe(old('nganh_nghe'), ['id'])
                ->pluck('ten_nganh_nghe', 'id')
                ->toArray();

            session()->put([
                '_old_input.nganh_nghe' => $oldInputNganhNghe,
            ]);
        }

        return view('ql_giao_vien.create', [
            'listCoSo' => $listCoSo,
            'listTrinhDo' => $listTrinhDo,
            'listNganhNghe' => $listNganhNghe,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $result = $this->giaoVienService->store($data);

        return redirect()->route('ql-giao-vien.index');
    }

    public function edit(GiaoVien $giaoVien)
    {
        $oldInput = session()->getOldInput();

        $chucDanh = $giaoVien->giao_su == 1 ?
            config('common.giao_vien.chuc_danh.giao_su') : ($giaoVien->pho_giao_su ? config('common.giao_vien.chuc_danh.pho_giao_su') :
                config('common.giao_vien.chuc_danh.khong'));

        $giaoVienData = [
            'id_giao_vien' => $giaoVien->id,
            'ten_giao_vien' => $giaoVien->ten,
            'co_so_id' => $giaoVien->co_so_id,
            'gioi_tinh' => $giaoVien->gioi_tinh,
            'mon_chung' => $giaoVien->mon_chung,
            'trinh_do' => $giaoVien->trinh_do_id,
            'dan_toc_thieu_so' => $giaoVien->dan_toc_it_nguoi,
            'chuc_danh' => $chucDanh,
            'nha_giao_nhan_dan' => $giaoVien->nha_giao_nhan_dan,
            'nha_giao_uu_tu' => $giaoVien->nha_giao_uu_tu,
            'loai_hop_dong' => $giaoVien->loai_hop_dong,
            'trinh_do_ngoai_ngu' => $giaoVien->trinh_do_ngoai_ngu,
            'trinh_do_nghe' => $giaoVien->trinh_do_ky_nang_nghe,
            'nghiep_vu_su_pham' => $giaoVien->trinh_do_nghiep_vu_su_pham,
            'trinh_do_tin_hoc' => $giaoVien->trinh_do_tin_hoc,
            'trinh_do_tien_sy' => $giaoVien->trinh_do_tien_sy,
            'trinh_do_thac_sy' => $giaoVien->trinh_do_thac_sy,
            'trinh_do_dai_hoc' => $giaoVien->trinh_do_dai_hoc,
            'trinh_do_cao_dang' => $giaoVien->trinh_do_cao_dang,
            'trinh_do_trung_cap' => $giaoVien->trinh_do_trung_cap,
            'trinh_do_khac' => $giaoVien->trinh_do_khac,
        ];

        $giaoVienData['nganh_nghe'] = [];
        if (!empty($giaoVien->nghe_giang_day)) {
            $listNgheGiangDay = [];
            $ngheGiangDay = explode(',', $giaoVien->nghe_giang_day);

            foreach ($ngheGiangDay as $nghe) {
                $ngheId = explode(' - ', $nghe)[1];
                $listNgheGiangDay[$ngheId] = $nghe;
            }

            $giaoVienData['nganh_nghe'] = $listNgheGiangDay;
        }

        /*
         * Do khi validate fail UpdateRequest sẽ redirect về route này,
         * $giaoVienData['nganh_nghe'] = [ 'id' => 'Tên nghề - id' ]
         * $oldInput['nganh_nghe'] = [ 'id1', 'id2' ]
         * nên cần query để format lại old('nganh_nghe') cho giống với $giaoVienData['nganh_nghe']
         * để merge vào với nhau.
         */
        if (!empty(old('nganh_nghe'))) {
            $oldInput['nganh_nghe'] = $this->giaoVienService
                ->getListNganhNghe(old('nganh_nghe'), ['id'])
                ->pluck('ten_nganh_nghe', 'id')
                ->toArray();
        }

        $data = array_merge($giaoVienData, $oldInput);

        $listCoSo = $this->giaoVienService->getListCoSo();
        $listTrinhDo = $this->giaoVienService->getListTrinhDo();
        $listNganhNghe = $this->giaoVienService->getListNganhNghe();

        return view('ql_giao_vien.update', [
            'listCoSo' => $listCoSo,
            'listTrinhDo' => $listTrinhDo,
            'listNganhNghe' => $listNganhNghe,
            'data' => $data,
        ]);
    }

    public function update(UpdateRequest $request, GiaoVien $giaoVien)
    {
        $data = $request->except('_token');
        $result = $this->giaoVienService->updateGiaoVien($giaoVien->id, $data);

        return redirect()->route('ql-giao-vien.index');
    }
    public function exportBieuMau(Request $request)
    {
        $id_coso = $request->id_cs;
        $this->giaoVienService->exportBieuMau($id_coso);
    }

    public function exportData(Request $request)
    {
        $id_coso =  $request->truong_id;
        $this->giaoVienService->exportData($id_coso);
    }


    public function importFile(Request $request)
    {
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];
        $kq = $this->giaoVienService->importFile($fileRead, $duoiFile);

        if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'exportError') {
            return response()->json('exportError', 200);
        } else if ($kq == 'NoHaveNgheDk') {
            return response()->json(['messageError' => 'Nghề của nhập giáo viên chưa đăng ki'], 200);
        } else {
            return response()->json(['messageError' => $kq], 200);
        }
    }


    public function importError(Request $request)
    {
        $nameFile = $request->file_import->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file_import']['tmp_name'];
        $this->giaoVienService->importError($fileRead, $duoiFile);
    }
}