<?php

namespace App\Http\Controllers;

use App\CoSoDaoTao;
use App\Repositories;
use App\Services\CoSoDaoTaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class CoSoDaoTaoController extends Controller
{
    protected $CoSoDaoTaoService;
    public function __construct(CoSoDaoTaoService $CoSoDaoTaoService)
    {
        $this->CoSoDaoTaoService = $CoSoDaoTaoService;
    }

    public function danhsachCSDT(Request $request)
    {
        $params = $request->all();
        if (!isset($params['ten_co_so'])) $params['ten_co_so'] = null;
        if (!isset($params['ma_don_vi'])) $params['ma_don_vi'] = null;
        if (!isset($params['loai_hinh_co_so'])) $params['loai_hinh_co_so'] = null;
        if (!isset($params['quanhuyen'])) $params['quanhuyen'] = null;
        if (!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $data = $this->CoSoDaoTaoService->getCsdt($params);
        $loaihinh = DB::table('loai_hinh_co_so')->get();
        $quanhuyen = DB::table('devvn_quanhuyen')->get();
        $data->appends(request()->input())->links();
        $route_name = Route::current()->action['as'];
        return view('co-so-dao-tao.danh_sach_co_so_dao_tao', compact('data', 'loaihinh', 'quanhuyen', 'params', 'route_name'));
    }

    public function chitietCSDT($id)
    {
        $data = $this->CoSoDaoTaoService->getSingleCsdt($id);
        return view('co-so-dao-tao.chi_tiet_co_so', ['data' => $data]);
    }

    public function themCSDT()
    {
        $qd = DB::table('quyet_dinh_thanh_lap_csdt')->get();
        $coquan = DB::table('co_quan_chu_quan')->get();
        $loaihinh = DB::table('loai_hinh_co_so')->get();
        $quanhuyen = DB::table('devvn_quanhuyen')->get();
        $xaphuong = DB::table('devvn_xaphuongthitran')->get();
        return view('co-so-dao-tao.them_co_so', [
            'qd' => $qd,
            'coquan' => $coquan,
            'loaihinh' => $loaihinh,
            'quanhuyen' => $quanhuyen,
            'xaphuong' => $xaphuong
        ]);
    }

    public function taomoiCSDT(Request $request)
    {
        
        $request->validate(
            [
                'ten' => 'required|unique:co_so_dao_tao',
                'ma_don_vi' => 'required|unique:co_so_dao_tao',
                'upload_logo' => 'required|mimes:jpeg,png',
                'dien_thoai' => 'required|numeric |digits_between:10,12',
                'website' => 'required|url',
                'dia_chi' => 'required|unique:co_so_dao_tao',
                // 'ten_quoc_te' => 'required',
                'co_quan_chu_quan_id' => 'required',
                'ma_loai_hinh_co_so' => 'required',
                'quyet_dinh_id' => 'required',
                'maqh' => 'required',
                'xaid' => 'required'
            ],
            [
                'ten.required' => 'Tên cơ sở đào tạo không được để trống',
                'ten.required' => 'Tên cơ sở đào tạo đã tồn tại',
                'ma_don_vi.required' => 'Mã đơn vị không được để trống',
                'upload_logo.required' => 'Logo không được để trống',
                'upload_logo.mimes' => 'Logo không đúng định dạng file ảnh',
                'dien_thoai.required' => 'Điện thoại không được để trống',
                'dien_thoai.digits_between' => 'Số điện thoại sai định dạng',
                'dien_thoai.numeric ' => 'Số điện thoại sai định dạng',
                'website.url' => 'Website không đúng định dạng',
                'website.required' => 'Website không được để trống',
                'dia_chi.required' => 'địa chỉ không được để trống',
                'dia_chi.mimes' => 'Địa chỉ đã tồn tại trong hệ thống',
                // 'ten_quoc_te.required' => 'Vui lòng điền tên quốc tế của cơ sở',
                'co_quan_chu_quan_id.required' => 'Vui lòng chọn cơ quan chủ quản',
                'ma_loai_hinh_co_so.required' => 'Vui lòng chọn loại hình cơ sở',
                'quyet_dinh_id.required' => 'Vui lòng chọn quyết định của cơ sở',
                'maqh.required' => 'Vui lòng chọn Quận/huyện',
                'xaid.required' => 'Vui lòng chọn Xã/phường'
            ]
        );

        if ($request->hasFile('upload_logo')) {
            $filePath = $request->file('upload_logo')->store('uploads/logoCsdt');
            $request->request->set('logo', $filePath);
        }

        $this->CoSoDaoTaoService->create($request, ['upload_logo']);
        return redirect()->route('csdt.danh-sach')->withInput()->with('mess', 'Thêm cơ sở thành công');
    }

    public function suaCSDT($id)
    {
        $data = $this->CoSoDaoTaoService->getSingleCsdt($id);
        $parent = DB::table('co_quan_chu_quan')->get();
        $loai_coso = DB::table('loai_hinh_co_so')->get();
        $qd = DB::table('quyet_dinh_thanh_lap_csdt')->get();
        $quanhuyen = DB::table('devvn_quanhuyen')->get();
        $xaphuong = DB::table('devvn_xaphuongthitran')->where('');

        return view('co-so-dao-tao.sua_co_so', compact('data', 'parent', 'loai_coso', 'qd', 'quanhuyen', 'xaphuong'));
    }

    public function capnhatCSDT($id, Request $request)
    {
        $request->validate(
            [
                'ten' => ['required', Rule::unique('co_so_dao_tao')->ignore($id)],
                'ma_don_vi' => 'required',
                'upload_logo' => 'mimes:jpeg,png',
                'dien_thoai' => 'required|numeric|digits_between:10,12',
                'dia_chi' => 'required',
                'website' => 'required|url',
                // 'ten_quoc_te' => 'required',
                'co_quan_chu_quan_id' => 'required',
                'ma_loai_hinh_co_so' => 'required',
                'quyet_dinh_id' => 'required',
                'maqh' => 'required',
                'xaid' => 'required'
            ],
            [
                'ten.required' => 'Tên cơ sở đào tạo không được để trống',
                'ten.unique' => 'Tên cơ sở đào tạo đã tồn tại',
                'ma_don_vi.required' => 'Mã đơn vị không được để trống',
                'ma_don_vi.unique' => 'Mã đơn vị đã tồn tại',
                'upload_logo.mimes' => 'File ảnh không đúng định dạng',
                'dien_thoai.required' => 'Điện thoại không được để trống',
                'dien_thoai.digits_between' => 'Số điện thoại sai định dạng',
                'dien_thoai.numeric ' => 'Số điện thoại sai định dạng',  
                'dia_chi.required' => 'Địa chỉ không được để trống',
                'website.url' => 'Website không đúng định dạng',
                'website.required' => 'Website không được để trống',
                // 'ten_quoc_te.required' => 'Tên quốc tế không được để trống',
                'co_quan_chu_quan_id.required' => 'Vui lòng chọn cơ quan chủ quản',
                'ma_loai_hinh_co_so.required' => 'Vui lòng chọn loại hình cơ sở',
                'quyet_dinh_id.required' => 'Vui lòng chọn quyết định',
                'maqh.required' => 'Vui lòng chọn Quận/huyện',
                'xaid.required' => 'Vui lòng chọn Xã/phường'
            ]
        );

        if ($request->hasFile('upload_logo')) {
            $filePath = $request->file('upload_logo')->store('uploads/logoCsdt');
            $request->request->set('logo', $filePath);
        }
        $this->CoSoDaoTaoService->update($id, $request, ['upload_logo', '_token']);

        return redirect()->route('csdt.cap-nhat', ['id' => $id])->with('mess', 'Đã cập nhật thông tin cơ sở đào tạo')->withInput();
    }

    public function apiSearchCoSoDaoTao(Request $request)
    {
        $params['keyword'] = $request->keyword;
        $params['page'] = $request->page;
        $data = $this->CoSoDaoTaoService->apiSearchCoSoDaoTao($params);
        return response()->json($data);
    }

    public function addCoQuanChuQuan(Request $request)
    {
        $request->validate(
            [
                'ten' => 'required|unique:co_quan_chu_quan',
                'ma' => 'required|unique:co_quan_chu_quan'
            ],
            [
                'ten.required' => 'Tên không được để trống',
                'ten.unique' => 'Cơ quan đã tồn tại',
                'ma.required' => 'Mã cơ quan không được để trống',
                'ma.unique' => 'Mã cơ quan đã tồn tại'
            ]
        );
        $attributes = $request->all();
        if (isset($attributes['_token'])) {
            unset($attributes['_token']);
        }
        $this->CoSoDaoTaoService->addCoQuanChuQuan($attributes);
        $response = DB::table('co_quan_chu_quan')->get();
        return response()->json([
            'data' => $response,
            'message' => 'Thêm thành công'
        ]);
    }

    public function addQuyetDinh(Request $request)
    {
        $request->validate(
            [
                'ten' => 'required|unique:quyet_dinh_thanh_lap_csdt',
                'van_ban_url' => 'required',
                'ngay_ban_hanh' => 'required|date_format:d-m-Y',
                'ngay_hieu_luc' => 'required|date_format:d-m-Y|after_or_equal:ngay_ban_hanh',
                'ngay_het_han' => 'required|date_format:d-m-Y|after:ngay_hieu_luc',
                'loai_quyet_dinh' => 'required'
            ],
            [
                'ten.required' => 'Tên quyết định không được để trống',
                'ten.unique' => 'Quyết định đã tồn tại',
                'van_ban_url.required' => 'Đường dẫn văn bản không được để trống',
                
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
        $attributes = $request->all();
        if (isset($attributes['_token'])) {
            unset($attributes['_token']);
        }
        $this->CoSoDaoTaoService->addQuyetDinh($attributes);
        $response = DB::table('quyet_dinh_thanh_lap_csdt')->get();
        return response()->json([
            'data' => $response,
            'messageqd' => 'Thêm thành công'
        ]);
    }
}