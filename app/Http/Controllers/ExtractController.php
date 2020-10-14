<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiaoVien\StoreRequest as GiaoVienStoreRequest;
use App\Http\Requests\DoiNguNhaGiao\validateAddDoiNguNhaGiao;
use App\Http\Requests\DoiNguNhaGiao\validateUpdateDoiNguNhaGiao;
use Illuminate\Http\Request;
use App\Repositories;
use App\Services\QlsvService;
use App\Services\DoiNguNhaGiaoService;
use App\Services\LoaiHinhCoSoService;
use App\Services\CoQuanChuQuanService;
use App\Services\CoSoDaoTaoService;
use App\Services\NganhNgheService;
use App\Services\HopTacQuocTeService;
use App\Services\ChiTieuTuyenSinhService;



use App\Http\Requests\HopTacQuocTe\StoreHopTacQuocTeRequest;
use App\Http\Requests\HopTacQuocTe\UpdateHopTacQuocTeRequest;
use App\Http\Requests\ChiTieuTuyenSinh\StoreChiTieuTuyenSinhRequest;
use App\Http\Requests\ChiTieuTuyenSinh\UpdateChiTieuTuyenSinhRequest;

use App\Http\Requests\validateCreateSinhVienDangQuanLi;
use App\Http\Requests\validateUpdateSinhVienDangQuanLi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DoiNguNhaGiao\ExportRequest;
use App\Http\Requests\DoiNguNhaGiao\ExportBieuMauRequest;
use App\Http\Requests\DoiNguNhaGiao\ImportRequest;
use Psy\Readline\Readline;

use App\Http\Requests\Excel\ExportDuLieu;
use Storage;

class ExtractController extends Controller
{
    protected $QlsvService;
    protected $DoiNguNhaGiaoService;
    protected $LoaiHinhCoSoService;
    protected $CoQuanChuQuanService;
    protected $CoSoDaoTaoService;
    protected $NganhNgheService;
    protected $HopTacQuocTeService;
    protected $ChiTieuTuyenSinhService;


    public function __construct(
        QlsvService $QlsvService,
        DoiNguNhaGiaoService $DoiNguNhaGiaoService,
        LoaiHinhCoSoService $LoaiHinhCoSoService,
        CoQuanChuQuanService $CoQuanChuQuanService,
        CoSoDaoTaoService $CoSoDaoTaoService,
        NganhNgheService $NganhNgheService,
        HopTacQuocTeService $HopTacQuocTeService,
        ChiTieuTuyenSinhService $ChiTieuTuyenSinhService

    ) {
        $this->QlsvService = $QlsvService;
        $this->DoiNguNhaGiaoService = $DoiNguNhaGiaoService;
        $this->LoaiHinhCoSoService = $LoaiHinhCoSoService;
        $this->CoQuanChuQuanService = $CoQuanChuQuanService;
        $this->CoSoDaoTaoService = $CoSoDaoTaoService;
        $this->NganhNgheService = $NganhNgheService;
        $this->HopTacQuocTeService = $HopTacQuocTeService;
        $this->ChiTieuTuyenSinhService = $ChiTieuTuyenSinhService;
    }

    // phunv - BM:6 -> Chức năng Tổng hợp trích xuất báo cáo - Danh sách đội ngũ nhà giáo

    /* Danh sách đội ngũ nhà giáo.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function danhsachnhagiao(Request $request)
    {
        $params = $request->all();

        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $coSo = $this->CoSoDaoTaoService->getAll();
        $data = $this->DoiNguNhaGiaoService->getDanhSachDoiNguNhaGiao($params);
        $params['get_loai_hinh_co_so'] = $this->LoaiHinhCoSoService->getAll();
        $params['get_co_quan_chu_quan'] = $this->CoQuanChuQuanService->getAll();
        $params['get_nganh_nghe'] = $this->NganhNgheService->getAll();
        $params['get_co_so'] = $this->CoSoDaoTaoService->getAll();

        $data->withPath("?coquanchuquan=$request->coquanchuquan&loaihinhcoso=$request->loaihinhcoso&dot=$request->dot&nam=$request->nam&co_so_id=$request->co_so_id&page_size=$request->page_size");

        if ($data->count() < 1) {
            return view(
                'extractreport.danh_sach_doi_ngu_nha_giao',
                compact('data', 'params', 'route_name', 'coSo'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }
        return view(
            'extractreport.danh_sach_doi_ngu_nha_giao',
            compact('data', 'params', 'route_name', 'coSo'),
            ['thongbao' => '']
        );
    }

    /* Danh sách chi tiết đội ngũ nhà giáo theo cơ sở.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function chiTietTheoCoSo(Request $request, $co_so_id)
    {
        $check_co_so = $this->CoSoDaoTaoService->checkTonTai($co_so_id);
        if (!$check_co_so) {
            return redirect()->route('xuatbc.ds-nha-giao');
        }
        $params = $request->all();
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->DoiNguNhaGiaoService->chiTietTheoCoSo($co_so_id, $params);
        $thongtincoso = $this->CoSoDaoTaoService->getSingleCsdt($co_so_id);

        $data->withPath("?dot=$request->dot&nam=$request->nam&page_size=$request->page_size");

        if ($data->count() < 1) {
            return view(
                'extractreport.danh_sach_chi_tiet_doi_ngu_nha_giao',
                compact('data', 'params', 'thongtincoso', 'route_name'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }
        return view(
            'extractreport.danh_sach_chi_tiet_doi_ngu_nha_giao',
            compact('data', 'params', 'thongtincoso', 'route_name'),
            ['thongbao' => '']
        );
    }

    /* Màn hình thêm Danh sách đội ngũ nhà giáo
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function themDanhSachDoiNguNhaGiao()
    {
        $params['cosodaotao'] = $this->DoiNguNhaGiaoService->getAllCoSoDaoTao();
        return view('extractreport.them-moi-doi_ngu_nha_giao', compact('params'));
    }

    /* Danh sách ngành nghề theo ID cơ sở.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function layNganhNgheTheoCoSo($co_so_id)
    {
        $nganhNghe = $this->DoiNguNhaGiaoService->getNganhNgheTheoCoSo($co_so_id);
        return $nganhNghe;
    }

    /* Lưu dữ liệu từ màn hình thêm dữ liệu Danh sách đội ngũ nhà giáo.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function saveDanhSachDoiNguNhaGiao(validateAddDoiNguNhaGiao $request)
    {
        $params = $request->all();
        $kq = $this->DoiNguNhaGiaoService->checkTonTaiKhiThem($params);
        if ($kq) {
            return redirect()->route('xuatbc.them-ds-nha-giao')->with(['edit' => $kq->id])->withInput();
        }

        $dateTime = Carbon::now();
        $request->request->set('created_at', $dateTime->format('Y-m-d H:i:s'));

        $this->DoiNguNhaGiaoService->store($request->except('_token'));
        return redirect()->route('xuatbc.ds-nha-giao')->with(['success' => 'thêm thành công']);
    }

    /* Màn hình cập nhật dữ liệu Danh sách đội ngũ nhà giáo.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function suaDanhSachDoiNguNhaGiao($id)
    {
        $data = $this->DoiNguNhaGiaoService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-nha-giao');
        }

        $cosodaotao = $this->DoiNguNhaGiaoService->getAllCoSoDaoTao();
        $nganh_nghe_theo_id = $this->NganhNgheService->findById($data->nghe_id);
        $ten_nghe = $nganh_nghe_theo_id->ten_nganh_nghe;

        $params = [
            'cosodaotao' => $cosodaotao,
            'ten_nghe' => $ten_nghe
        ];
        return view('extractreport.chinh_sua_doi_ngu_nha_giao', compact('params', 'data'));
    }

    /* Update dữ liệu từ màn hình cập nhật dữ liệu Danh sách đội ngũ nhà giáo.
     * @author: phucnv
     * @created_at 2020-06-_ _
     */
    public function updateDanhSachDoiNguNhaGiao($id, validateUpdateDoiNguNhaGiao $request)
    {
        $data = $this->DoiNguNhaGiaoService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-nha-giao');
        }

        $dateTime = Carbon::now();
        $request->request->set('updated_at', $dateTime->format('Y-m-d H:i:s'));
        $this->DoiNguNhaGiaoService->updateData($id, $request);

        return redirect()->route('xuatbc.chi-tiet-theo-co-so', ['co_so_id' => $data->co_so_id])->with(['success' => 'Cập nhật thành công !']);
    }
    // phunv - end

    public function danhsachquanly()
    {
        return view('extractreport.danh_sach_doi_ngu_quan_ly');
    }
    public function add()
    {
        $data = $this->QlsvService->getQlsv();
        $coso = $this->QlsvService->getCoSo();
        $nganhNghe = $this->QlsvService->getMaNganhNghe();
        $nghe_cap_2 = $this->QlsvService->getNganhNghe(2);
        $nghe_cap_3 = $this->QlsvService->getNganhNghe(3);
        $nghe_cap_4 = $this->QlsvService->getNganhNghe(4);
        return view('crud.add_quan_ly_sv', [
            'data' => $data,
            'nganhNghe' => $nganhNghe,
            'coso' => $coso,
            'nghe_cap_2' => $nghe_cap_2,
            'nghe_cap_3' => $nghe_cap_3,
            'nghe_cap_4' => $nghe_cap_4
        ]);
    }
    public function checkTonTai(Request $request)
    {
        $datacheck =  $request->datacheck;
        $getdata = $this->QlsvService->getSoLieu($datacheck);
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
                'result' => route('xuatbc.sua-so-sv', ['id' => $getdata->id]),
            ]);
        }
    }
    public function saveAdd(validateCreateSinhVienDangQuanLi $request)
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

        $result = $this->QlsvService->checkTonTai($data, $requestParams);

        return redirect($result['route'])->with('thongbao', $result['mess']);
    }
    public function edit($id)
    {
        $data = $this->QlsvService->suaSoLieuSv($id);
        $nghe_cap_2 = $this->QlsvService->getNganhNghe(2);
        $nghe_cap_3 = $this->QlsvService->getNganhNghe(3);
        $nghe_cap_4 = $this->QlsvService->getNganhNghe(4);
        return view('crud.edit_quan_ly_sv', [
            'data' => $data,
            'nghe_cap_2' => $nghe_cap_2,
            'nghe_cap_3' => $nghe_cap_3,
            'nghe_cap_4' => $nghe_cap_4
        ]);
    }
    public function saveEdit($id, validateUpdateSinhVienDangQuanLi $request)
    {
        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $request->request->set('nam', $dateTime->year);
        $request->request->set('dot', 1);
        $getdata = $request->all();
        $this->QlsvService->update($id, $request);
        $dataqlsv = $this->QlsvService->findById($id);
        // dd( $this->QlsvService->update($id, $request));
        return redirect()->route('xuatbc.chi-tiet-so-lieu', ['co_so_id' => $dataqlsv->co_so_id])->with('mess', 'dd');
    }
    public function tonghopsvdanghoc()
    {
        $params = request()->all();
        $quanhuyen = $this->QlsvService->getTenQuanHuyen();
        $nghe_cap_2 = $this->QlsvService->getNganhNghe(2);
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->QlsvService->getTenXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }
        $data = $this->QlsvService->getQlsv($params);
        $nganhNghe = $this->QlsvService->getMaNganhNghe();
        $data->appends(request()->input())->links();
        $nghe_cap_3 = $this->QlsvService->getNganhNghe(3);
        $nghe_cap_4 = $this->QlsvService->getNganhNghe(4);
        // $nam = $this->QlsvService->getNamDaoTao();
        $loaiHinhCs = $this->QlsvService->getLoaiHinh();
        $coso = $this->QlsvService->getCoSo();
        $route_name = Route::current();
        return view('crud.tong_hop_sinh_vien_dang_theo_hoc', [
            // 'limit'=>$limit,
            'route_name' => $route_name,
            'data' => $data,
            'nganhNghe' => $nganhNghe,
            'loaiHinh' => $loaiHinhCs,
            'coso' => $coso,
            'quanhuyen' => $quanhuyen,
            'xaphuongtheoquanhuyen' => $xaphuongtheoquanhuyen,
            'params' => $params,
            'nghe_cap_2' => $nghe_cap_2,
            'nghe_cap_3' => $nghe_cap_3,
            'nghe_cap_4' => $nghe_cap_4
        ]);
    }
    public function tongHopChiTietSvDangTheoHoc($coSoId)
    {

        $params = request()->all();
        $quanhuyen = $this->QlsvService->getTenQuanHuyen();
        if (isset(request()->devvn_quanhuyen)) {
            $xaphuongtheoquanhuyen = $this->QlsvService->getTenXaPhuongTheoQuanHuyen(request()->devvn_quanhuyen);
        } else {
            $xaphuongtheoquanhuyen = [];
        }
        $data = $this->QlsvService->chiTietSoLieuQlsv($coSoId, $params);
        $loaiHinhCs = $this->QlsvService->getLoaiHinh();
        $coso = $this->QlsvService->getCoSo();
        $nganhNghe = $this->QlsvService->getMaNganhNghe();
        $nghe_cap_2 = $this->QlsvService->getNganhNghe(2);
        $nghe_cap_3 = $this->QlsvService->getNganhNghe(3);
        $nghe_cap_4 = $this->QlsvService->getNganhNghe(4);
        $data_coso = $this->QlsvService->ChiTietCoSo($coSoId);

        return view('crud.lich_su_sinh_vien_dang_theo_hoc', [
            'data' => $data,
            'loaiHinh' => $loaiHinhCs,
            'nganhNghe' => $nganhNghe,
            'coso' => $coso,
            'params' => $params,
            'quanhuyen' => $quanhuyen,
            'xaphuongtheoquanhuyen' => $xaphuongtheoquanhuyen,
            'nghe_cap_2' => $nghe_cap_2,
            'nghe_cap_3' => $nghe_cap_3,
            'nghe_cap_4' => $nghe_cap_4,
            'data_coso' => $data_coso
        ]);
    }


    //phunv - BM:13 Tổng hợp kết quả hợp tác quốc tế trong giáo dục nghề nghiệp

    /* Danh sách kết quả hợp tác quốc tế.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function tonghophoptacquocte(Request $request)
    {
        $params = $request->all();
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $params['co_so_dao_tao'] = $this->CoSoDaoTaoService->getAll();
        $data = $this->HopTacQuocTeService->getDanhSachKetQuaHopTacQuocTe($params);

        // thanhnv
        $coso = DB::table('co_so_dao_tao')->get();

        $data->withPath("?co_so_id=$request->co_so_id&dot=$request->dot&nam=$request->nam&page_size=$request->page_size");
        if ($data->count() < 1) {
            return view(
                'extractreport.tong_hop_hop_tac_quoc_te',
                compact('data', 'params', 'route_name', 'coso'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }

        return view(
            'extractreport.tong_hop_hop_tac_quoc_te',
            compact('data', 'params', 'route_name', 'coso'),
            ['thongbao' => '']
        );
    }


    /* Danh sách chi tiết hợp tác quốc tế theo Cơ sở.
     * @author: phucnv
     * @created_at 2020-06-16
     */
    public function chiTietTongHopHopTacQuocTe(Request $request, $co_so_id)
    {
        $check_co_so = $this->CoSoDaoTaoService->checkTonTai($co_so_id);
        if (!$check_co_so) {
            return redirect()->route('xuatbc.ds-hop-tact-qte');
        }

        $params = $request->all();
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->HopTacQuocTeService->chiTietTheoCoSo($co_so_id, $params);
        $thongtincoso = $this->CoSoDaoTaoService->getSingleCsdt($co_so_id);

        $data->withPath("?dot=$request->dot&nam=$request->nam&page_size=$request->page_size");

        if ($data->count() < 1) {
            return view(
                'extractreport.chi-tiet-hop-tac-quoc-te',
                compact('data', 'params', 'route_name', 'thongtincoso'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }
        return view(
            'extractreport.chi-tiet-hop-tac-quoc-te',
            compact('data', 'params', 'route_name', 'thongtincoso'),
            ['thongbao' => '']
        );
    }

    /* Màn hình thêm tổng hợp hợp tác quốc tế.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function themTongHopHopTacQuocTe()
    {
        $params['co_so_dao_tao'] = $this->CoSoDaoTaoService->getAll();
        return view(
            'extractreport.them-moi-hop-tac-quoc-te',
            compact('params')
        );
    }

    /* Lưu lại dữ liệu màn hình thêm tổng hợp hợp tác quốc tê.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function saveTongHopHopTacQuocTe(StoreHopTacQuocTeRequest $request)
    {
        $params = $request->all();

        $kq = $this->HopTacQuocTeService->checkTonTaiKhiThem($params);
        if ($kq) {
            return redirect()->route('xuatbc.them-ds-hop-tac-qte')->with(['edit' => $kq->id])->withInput();
        }

        $this->HopTacQuocTeService->store($request->except(['_token']));
        return redirect()->route('xuatbc.them-ds-hop-tac-qte')->with(['success' => 'thêm thành công']);
    }


    /* Màn hình sửa tổng hợp hợp tác quốc tê.
     * @author: phucnv
     * @created_at 2020-06-16
     */
    public function suaTongHopHopTacQuocTe($id)
    {
        $data = $this->HopTacQuocTeService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-hop-tact-qte');
        }

        $params['co_so_dao_tao'] = $this->CoSoDaoTaoService->getAll();
        return view('extractreport.sua-hop-tac-quoc-te', compact('params', 'data'));
    }


    /* Cập nhật màn hình sửa tổng hợp hợp tác quốc tê.
     * @author: phucnv
     * @created_at 2020-06-16
     */
    public function updateTongHopHopTacQuocTe($id, UpdateHopTacQuocTeRequest $request)
    {
        $data = $this->HopTacQuocTeService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-hop-tact-qte');
        }

        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $this->HopTacQuocTeService->updateData($id, $request);
        return redirect()->route('xuatbc.chi-tiet-ds-hop-tac-qte', ['co_so_id' => $data->co_so_id])->with(['success' => 'thêm thành công']);
    }

    //phucnv end BM:13




    public function tonghopchinhsachsv()
    {
        return view('extractreport.tong_hop_thuc_hien_chinh_sach_cho_sinh_vien');
    }
    public function tonghopkqtuyensinh()
    {
        return view('extractreport.tong_hop_ket_qua_tuyen_sinh');
    }
    public function chiteittonghopkqtuyensinh()
    {
        return view('extractreport.chi_tiet_tong_hop_ket_qua_tuyen_sinh');
    }


    public function tonghopxdchuongtrinh()
    {
        return view('extractreport.tong_hop_xay_dung_chuong_trinh_giao_trinh');
    }


    public function tonghopdaotaonguoikhuyettat()
    {
        return view('extractreport.tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat');
    }
    public function tonghopdaotaothanhnien()
    {
        return view('extractreport.tong_hop_dao_tao_nghe_cho_thanh_nien');
    }
    public function tonghopdaotaovoidoanhnghiep()
    {
        return view('extractreport.tong_hop_dao_tao_nghe_gan_voi_doanh_nghiep');
    }

    //phucnv BM:8
    /* Danh sách kết quả chỉ tuyển sinh.
     * @author: phucnv
     * @created_at 2020-06-17
     */
    public function tonghoptuyensinh(Request $request)
    {
        $params = $request->all();
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->ChiTieuTuyenSinhService->getDanhSachChiTieuTuyenSinh($params);

        $params['get_loai_hinh_co_so'] = $this->LoaiHinhCoSoService->getAll();

        $params['get_nganh_nghe'] = $this->NganhNgheService->getAll();
        $params['get_co_so'] = $this->CoSoDaoTaoService->getAll();

        $data->withPath("?loaihinhcoso=$request->loaihinhcoso&dot=$request->dot&nam=$request->nam&co_so_id=$request->co_so_id&page_size=$request->page_size");

        // thanhnv them co so
        $coso = DB::table('co_so_dao_tao')->get();

        if ($data->count() < 1) {
            return view(
                'extractreport.tong_hop_ket_qua_tuyen_sinh',
                compact('data', 'params', 'route_name', 'coso'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }
        return view(
            'extractreport.tong_hop_ket_qua_tuyen_sinh',
            compact('data', 'params', 'route_name', 'coso'),
            ['thongbao' => '']
        );
    }

    /* Màn hình đăng ký chỉ tiêu tuyển sinh.
     * @author: phucnv
     * @created_at 2020-06-17
     */
    public function themChiTieuTuyenSinh()
    {
        $params['get_nganh_nghe'] = $this->NganhNgheService->getAll();
        $params['get_co_so'] = $this->CoSoDaoTaoService->getAll();
        return view(
            'extractreport.them_dang_ky_chi_tieu_tuyen_sinh',
            compact('params')
        );
    }
    /* Lưu dữ liệu Màn hình đăng ký chỉ tiêu tuyển sinh.
     * @author: phucnv
     * @created_at 2020-06-17
     */
    public function saveChiTieuTuyenSinh(StoreChiTieuTuyenSinhRequest $request)
    {
        $params = $request->all();
        $kq = $this->ChiTieuTuyenSinhService->checkTonTaiKhiThem($params);
        if ($kq) {
            return redirect()->route('xuatbc.them-dang-ky-chi-tieu-tuyen-sinh')->with(['edit' => $kq->id])->withInput();
        }

        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $this->ChiTieuTuyenSinhService->store($request->except('_token'));
        return redirect()->route('xuatbc.ds-chi-tieu-ts')->with(['success' => 'thêm thành công']);
    }

    /* Màn hình sửa chỉ tiêu tuyển sinh.
     * @author: phucnv
     * @created_at 2020-06-17
     */
    public function suaChiTieuTuyenSinh($id)
    {
        $data = $this->ChiTieuTuyenSinhService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-chi-tieu-ts');
        }

        $params['ten_nghe'] = $this->NganhNgheService->findById($data->nghe_id)->ten_nganh_nghe;
        $params['co_so_dao_tao'] = $this->CoSoDaoTaoService->getAll();
        return view('extractreport.sua_dang_ky_chi_tieu_tuyen_sinh', compact('params', 'data'));
    }


    public function updateChiTieuTuyenSinh($id, UpdateChiTieuTuyenSinhRequest $request)
    {
        $data = $this->ChiTieuTuyenSinhService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-chi-tieu-ts');
        }

        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $this->ChiTieuTuyenSinhService->updateData($id, $request);
        return redirect()->route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh', ['co_so_id' => $data->co_so_id])->with(['success' => 'Cập nhật thành công !']);
    }

    public function chitietChiTieuTuyenSinh($co_so_id, Request $request)
    {
        $check_co_so = $this->CoSoDaoTaoService->checkTonTai($co_so_id);
        if (!$check_co_so) {
            return redirect()->route('xuatbc.ds-chi-tieu-ts');
        }

        $params = $request->all();
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->ChiTieuTuyenSinhService->chiTietTheoCoSo($co_so_id, $params);
        $params['get_nganh_nghe_theo_co_so'] = $this->ChiTieuTuyenSinhService->getNganhNgheTheoCoSo($co_so_id);
        $thongtincoso = $this->CoSoDaoTaoService->getSingleCsdt($co_so_id);

        $data->withPath("?nghe_id=$request->nghe_id&dot=$request->dot&nam=$request->nam&page_size=$request->page_size");

        if ($data->count() < 1) {
            return view(
                'extractreport.chi-tiet-tong-hop-dang-ky-chi-tieu-tuyen-sinh',
                compact('data', 'params', 'route_name', 'thongtincoso'),
                ['thongbao' => 'Không tìm thấy kết quả !']
            );
        }
        return view(
            'extractreport.chi-tiet-tong-hop-dang-ky-chi-tieu-tuyen-sinh',
            compact('data', 'params', 'route_name', 'thongtincoso'),
            ['thongbao' => '']
        );
    }
    //phucnv end BM:8

    public function export(ExportRequest $request)
    {
        $nam = $request->get('nam');
        $dot = $request->get('dot');
        $coSoIds = $request->get('co_so_id');

        $this->DoiNguNhaGiaoService->export($coSoIds, $nam, $dot);
    }

    public function exportBieuMau(ExportBieuMauRequest $request)
    {
        $coSoId = $request->get('co_so_id');

        $this->DoiNguNhaGiaoService->export([$coSoId]);
    }

    public function import(ImportRequest $request)
    {
        $nam = $request->get('nam');
        $dot = $request->get('dot');
        $fileExtension = $request->file('file_import')->extension();
        $path = Storage::putFile(
            'public/uploads/excels',
            $request->file('file_import')
        );

        $this->DoiNguNhaGiaoService->import($nam, $dot, $path, $fileExtension);

        if ($request->ajax()) {
            return response()->json([
                'status' => 200,
                'message' => 'Dữ liệu đã được thêm thành công.',
            ]);
        }

        return redirect()->route('xuatbc.ds-nha-giao');
    }

    // thanhnv import export bieu mau 8

    public function exportFormBm8(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->ChiTieuTuyenSinhService->exportBieuMau($id_co_so);
    }

    public function exportDataBm8(ExportDuLieu $request)
    {
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->ChiTieuTuyenSinhService->exportData($listCoSoId, $fromDate, $toDate);
    }

    public function importErrorbm8(Request $request)
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
        $this->ChiTieuTuyenSinhService->importError($fileRead, $duoiFile, $pathLoad);
    }

    public function importFilebm8(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->ChiTieuTuyenSinhService->importFile($fileRead, $duoiFile, $year, $dot);

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

    // thanhnv bm13

    public function exportBieuMaubm13(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->HopTacQuocTeService->exportBieuMau($id_co_so);
    }
    public function exportDatabm13(ExportDuLieu $request)
    {
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->HopTacQuocTeService->exportData($listCoSoId, $fromDate, $toDate);
    }

    public function importFilebm13(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->HopTacQuocTeService->importFile($fileRead, $duoiFile, $year, $dot);
        if ($kq == 'errorkitu') {
            return response()->json('exportError', 200);
        } else if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'chiDuocNhap1CoSo') {
            return response()->json(['messageError' => 'Chỉ nhập cho 1 cơ sở'], 200);
        } else if ($kq == 'noCorrectIdTruong') {
            return response()->json(['messageError' => ' Trường không đúng hãy nhập lại'], 200);
        } else {
            return response()->json(['messageError' => $kq], 200);
        }
    }
    public function importErrorbm13(Request $request)
    {
        $nameFile = $request->file_import->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file_import']['tmp_name'];
        $pathLoad = Storage::putFile(
            'uploads/excels',
            $request->file('file_import')
        );
        // $path = str_replace('/', '\\', $pathLoad);
        $this->HopTacQuocTeService->importError($fileRead, $duoiFile, $pathLoad);
    }

    // thanhnv update change service bm4 6/25/2020

    public function exportBieuMaubm4(Request $request)
    {
        $id_co_so = $request->id_cs;
        $this->QlsvService->exportBieuMau($id_co_so);
    }
    public function exportDatabm4(Request $request)
    {
        $listCoSoId = $request->truong_id;
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;

        $changeFrom = strtotime($dateFrom);
        $fromDate = date("Y-m-d", $changeFrom);

        $changeTo = strtotime($dateTo);
        $toDate = date("Y-m-d", $changeTo);
        $this->QlsvService->exportData($listCoSoId, $fromDate, $toDate);
    }
    public function importFilebm4(Request $request)
    {
        $dot = $request->dot;
        $year = $request->nam;
        $nameFile = $request->file->getClientOriginalName();
        $nameFileArr = explode('.', $nameFile);
        $duoiFile = end($nameFileArr);

        $fileRead = $_FILES['file']['tmp_name'];
        $kq =  $this->QlsvService->importFile($fileRead, $duoiFile, $year, $dot);

        if ($kq == 'errorkitu') {
            return response()->json('exportError', 200);
        } else if ($kq == 'ok') {
            return response()->json('ok', 200);
        } else if ($kq == 'NgheUnsign') {
            return response()->json(['messageError' => ' Số lượng nghề nhập không phù hợp với lượng nghề đã đăng kí'], 200);
        } else if ($kq == 'noCorrectIdTruong') {
            return response()->json(['messageError' => ' Trường không đúng hãy nhập lại'], 200);
        } else if ($kq == 'ngheKoThuocTruong') {
            return response()->json(['messageError' => 'Có nghề không thuộc trong trường'], 200);
        } else {
            return response()->json(['messageError' => $kq], 200);
        }
    }

    public function importErrorbm4(Request $request)
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
        $this->QlsvService->importError($fileRead, $duoiFile, $pathLoad);
    }
}
