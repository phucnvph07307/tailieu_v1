<?php

namespace App\Http\Controllers;

use App\Services\ChungNhanDangKyService;
use App\Services\CoSoDaoTaoService;
use App\Services\GiayPhepService;
use App\Services\NganhNgheService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class GiayPhepController extends Controller
{
    protected $GiayPhepService;
    protected $CoSoDaoTaoService;
    public function __construct(
        GiayPhepService $GiayPhepService,
        CoSoDaoTaoService $CoSoDaoTaoService,
        NganhNgheService $nganhNgheService,
        ChungNhanDangKyService $chungNhanDangKyService
    ) {
        $this->GiayPhepService = $GiayPhepService;
        $this->CoSoDaoTaoService = $CoSoDaoTaoService;
        $this->NganhNgheService = $nganhNgheService;
        $this->chungNhanDangKyService = $chungNhanDangKyService;;
    }

    public function danhSachGiayPhep($id = null)
    {
        $dataCoSoDaoTao = $this->CoSoDaoTaoService->getSingleCsdt($id);
        $defaultCsdt = count($dataCoSoDaoTao) > 0
            ?   [
                'id' => $dataCoSoDaoTao[0]->id,
                'text' => $dataCoSoDaoTao[0]->ma_don_vi . ' - ' . $dataCoSoDaoTao[0]->ten
            ]
            : [];
        $dsCoSo = $this->CoSoDaoTaoService->getAll();
        $params['co_so_id'] = $id;
        $data = $this->GiayPhepService->getGiayPhep($params);
        $route_name = Route::current()->action['as'];
        return view('giay-phep.danh-sach-giay-phep', compact('data', 'dsCoSo', 'route_name', 'defaultCsdt'));
    }

    public function themGiayPhep($csdtid = null)
    {
        $allNgheTC = $this->NganhNgheService->getAllNganhNghe(config('common.bac_nghe.trung_cap.ma_bac'), $csdtid);
        $allNgheCD = $this->NganhNgheService->getAllNganhNghe(config('common.bac_nghe.cao_dang.ma_bac'), $csdtid);

        $Csdt = $this->CoSoDaoTaoService->findById($csdtid);

        return view('giay-phep.them-giay-phep', compact('Csdt', 'allNgheCD', 'allNgheTC'));
    }

    public function taoMoiGiayPhep(Request $request)
    {
        $request->validate(
            [
                'co_so_id' => 'required',
                'ten_giay_phep' => 'required',
                'ngay_ban_hanh' => 'required|date_format:d-m-Y',
                'ngay_hieu_luc' => 'required|date_format:d-m-Y|after_or_equal:ngay_ban_hanh',
                'ngay_het_han' => 'required|date_format:d-m-Y|after:ngay_hieu_luc',
                'anh-giay-phep' => 'required|mimes:jpeg,png',
                'nghe_cao_dang' => 'required_without:nghe_trung_cap|array',
                'nghe_trung_cap' => 'required_without:nghe_cao_dang|array'
            ],
            [
                'co_so_id.required' => 'Vui lòng chọn cơ sở đào tạo',
                'ten_giay_phep.required' => 'Tên giấy phép không được để trống',
                'anh-giay-phep.required' => 'Vui lòng tải lên ảnh giấy phép',
                'anh-giay-phep.mimes' => 'File tải lên không đúng định dạng ảnh',

                'ngay_ban_hanh.date_format' => 'Ngày không đúng định dạng',
                'ngay_ban_hanh.required' => 'Vui lòng chọn ngày ban hành',

                'ngay_hieu_luc.date_format' => 'Ngày không đúng định dạng',
                'ngay_hieu_luc.required' => 'Vui lòng chọn ngày ban hành',
                'ngay_hieu_luc.after_or_equal' => 'Ngày hiệu lực phải sau hoặc bằng ngày ban hành',

                'ngay_het_han.date_format' => 'Ngày không đúng định dạng',
                'ngay_het_han.required' => 'Vui lòng chọn ngày hết hạn',
                'ngay_het_han.after' => 'Ngày hết hạn phải sau ngày ban hành',

                'nghe_cao_dang.required_without' => 'Chỉ được để trống khi đã chọn 1 nghề Trung Cấp',
                'nghe_trung_cap.required_without' => 'Chỉ được để trống khi đã chọn 1 nghề Cao Đẳng'
            ]
        );

        if ($request->hasFile('anh-giay-phep')) {
            $filePath = $request->file('anh-giay-phep')->store('uploads/anh-giay-phep');
            $request->request->set('anh_giay_phep', $filePath);
        }
        $giay_phep = $this->GiayPhepService->store($request->except([
            'anh-giay-phep',
            '_token',
        ]));

        $request->request->set('giay_phep_id', $giay_phep->id);
        $this->NganhNgheService->boSungNganhNgheVaoCoSo($request);

        return redirect()->route('giay-phep.danh-sach', ['id' => $request->get('co_so_id')])->with('mess-success', 'Đã thêm giấy phép thành công')->withInput();
    }

    public function suaGiayPhep(Request $request)
    {
        $params['co_so_id'] = $request->co_so_id;
        $params['giay_phep_id'] = $request->giay_phep_id;

        $thongTinGP = $this->GiayPhepService->getGiayPhep($params);
        $Csdt = $this->CoSoDaoTaoService->findById($params['co_so_id']);
        return view('giay-phep.cap-nhat-giay-phep', compact('thongTinGP', 'params', 'Csdt'));
    }

    public function capNhatGiayPhep(Request $request)
    {
        $request->validate(
            [
                'co_so_id' => 'required',
                'ten_giay_phep' => 'required',
                'ngay_ban_hanh' => 'required|date_format:d-m-Y',
                'ngay_hieu_luc' => 'required|date_format:d-m-Y|after_or_equal:ngay_ban_hanh',
                'ngay_het_han' => 'required|date_format:d-m-Y|after:ngay_hieu_luc',
                'anh-giay-phep' => 'mimes:jpeg,png'
            ],
            [
                'co_so_id.required' => 'Vui lòng chọn cơ sở đào tạo',
                'ten_giay_phep.required' => 'Tên giấy phép không được để trống',
                'anh-giay-phep.required' => 'Vui lòng tải lên ảnh giấy phép',
                'anh-giay-phep.mimes' => 'File tải lên không đúng định dạng ảnh',

                'ngay_ban_hanh.date_format' => 'Ngày không đúng định dạng',
                'ngay_ban_hanh.required' => 'Vui lòng chọn ngày ban hành',

                'ngay_hieu_luc.date_format' => 'Ngày không đúng định dạng',
                'ngay_hieu_luc.required' => 'Vui lòng chọn ngày ban hành',
                'ngay_hieu_luc.after_or_equal' => 'Ngày hiệu lực phải sau hoặc bằng ngày ban hành',

                'ngay_het_han.date_format' => 'Ngày không đúng định dạng',
                'ngay_het_han.required' => 'Vui lòng chọn ngày hết hạn',
                'ngay_het_han.after' => 'Ngày hết hạn phải sau ngày ban hành'
            ]
        );

        $data = $this->GiayPhepService->findById($request->giay_phep_id);
        if ($request->hasFile('anh-giay-phep')) {
            $filePath = $request->file('anh-giay-phep')->store('uploads/anh-giay-phep');
            $request->request->set('anh_giay_phep', $filePath);
        } else {
            $request->request->set('anh_giay_phep', $data->anh_giay_phep);
        }
        $this->GiayPhepService->updateGiayPhep($request->giay_phep_id, $request->except([
            'anh-giay-phep',
            '_token'
        ]));
        $request->session()->flash('success-update', 'Cập nhật thông tin giấy phép thành công');
        return redirect()->route('giay-phep.chi-tiet', ['co_so_id' => $request->co_so_id, 'giay_phep_id' => $request->giay_phep_id]);
    }

    public function chiTietGiayPhep(Request $request)
    {
        $params['co_so_id'] = $request->co_so_id;
        $params['giay_phep_id'] = $request->giay_phep_id;

        if (isset($request->page_size)) {
            $params['page_size'] = $request->page_size;
        } else {

            $params['page_size'] = config('common.paginate_size.default');
        }

        $route_name = Route::current()->action['as'];

        $ngheDuocCap = $this->chungNhanDangKyService->getNgheTheoGiayPhep($params);

        $thongTinGP = $this->GiayPhepService->getGiayPhep($params);
        $nganhNghe = $this->NganhNgheService->getAll()->where('ma_cap_nghe', 4);

        $allNgheTC = $this->NganhNgheService->getAllNganhNghe(config('common.bac_nghe.trung_cap.ma_bac'), $params['co_so_id']);
        $allNgheCD = $this->NganhNgheService->getAllNganhNghe(config('common.bac_nghe.cao_dang.ma_bac'), $params['co_so_id']);

        return view('giay-phep.chi-tiet-giay-phep', compact('ngheDuocCap', 'thongTinGP', 'nganhNghe', 'allNgheTC', 'allNgheCD', 'params', 'route_name'));
    }

    public function suaNgheTrongGiayPhep($id)
    {
        $data = $this->chungNhanDangKyService->findById($id);
        $nganhNghe = $this->NganhNgheService->getAll()->where('ma_cap_nghe', 4);
        return view('giay-phep.cap-nhat-nghe-trong-giay-phep', compact('nganhNghe', 'data'));
    }

    public function capNhatNgheTrongGiayPhep($id, Request $request)
    {
        $request->validate([
                'quy_mo_tuyen_sinh' => 'required|integer|min:0'
            ],
            [
                'quy_mo_tuyen_sinh.required' => "Hãy nhập quy mô tuyển sinh",
                'quy_mo_tuyen_sinh.integer' => "Quy mô tuyển sinh phải là số nguyên dương",
                'quy_mo_tuyen_sinh.min' => "Quy mô tuyển sinh phải là số nguyên dương",
            ]);
        $params['giay_phep_id'] = $request->giay_phep_id;
        $params['co_so_id'] = $request->co_so_id;
        $this->chungNhanDangKyService->update($id, $request);
        $request->session()->flash('success', 'Cập nhật thành công');
        return redirect()->route('giay-phep.chi-tiet', ['giay_phep_id' => $params['giay_phep_id'], 'co_so_id' => $params['co_so_id']]);
    }

    public function boSungNganhNgheVaoGiayPhep(Request $request)
    {
        $request->validate(
            [
                'nghe_cao_dang' => 'required_without:nghe_trung_cap|array',
                'nghe_trung_cap' => 'required_without:nghe_cao_dang|array'
            ],
            [
                'nghe_cao_dang.required_without' => 'Chỉ được để trống khi đã chọn 1 nghề Trung Cấp',
                'nghe_trung_cap.required_without' => 'Chỉ được để trống khi đã chọn 1 nghề Cao Đẳng'
            ]
        );
        $params['giay_phep_id'] = $request->giay_phep_id;
        $params['co_so_id'] = $request->co_so_id;

        if (isset($request->page_size)) {
            $params['page_size'] = $request->page_size;
        } else {

            $params['page_size'] = config('common.paginate_size.default');
        }
        $this->NganhNgheService->boSungNganhNgheVaoCoSo($request);
        $response = $params;
        return response()->json([
            'data' => $response,
            'message' => 'Bổ sung nghề thành công'
        ]);
    }

    public function xoaNgheTrongGiayPhep(Request $request)
    {
        $params['co_so_id'] = $request->co_so_id;
        $params['giay_phep_id'] = $request->giay_phep_id;
        $params['nghe_id'] = $request->nghe_id;
        $request->session()->flash('success', 'Đã xóa nghề thành công');
        $this->chungNhanDangKyService->xoaNgheTrongGiayPhep($params);
        return redirect()->route('giay-phep.chi-tiet', ['giay_phep_id' => $params['giay_phep_id'], 'co_so_id' => $params['co_so_id']]);
    }
}
