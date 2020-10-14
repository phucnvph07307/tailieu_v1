<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Services\XayDungChuongTrinhGiaoTrinhService;

use App\Http\Requests\XayDungChuongTrinhGiaoTrinh\StoreXayDungChuongTrinhGiaoTrinhRequest;
use App\Http\Requests\XayDungChuongTrinhGiaoTrinh\UpdateXayDungChuongTrinhGiaoTrinhRequest;

class XayDungChuongTrinhGiaoTrinhController extends Controller
{
    protected $XayDungChuongTrinhGiaoTrinhService;

    public function __construct(
        XayDungChuongTrinhGiaoTrinhService $XayDungChuongTrinhGiaoTrinhService)
    {
        $this->XayDungChuongTrinhGiaoTrinhService = $XayDungChuongTrinhGiaoTrinhService;
    }

    //phucnv BM:12
    /* Danh sách Tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function index(Request $request)
    {
        $params = $request->all();
        if(!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->XayDungChuongTrinhGiaoTrinhService->getDanhSachXayDungChuongTrinhGiaoTrinh($params);
        $params['get_nganh_nghe'] = $this->XayDungChuongTrinhGiaoTrinhService->getNganhNghe();
        $params['get_co_so'] = $this->XayDungChuongTrinhGiaoTrinhService->getCoSoDaoTao();
        $data->withPath("?dot=$request->dot&nam=$request->nam&co_so_id=$request->co_so_id&nghe_id=$request->nghe_id&page_size=$request->page_size");

        if($data->count() < 1){
            return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.index',
            compact('data','params','route_name'),
            ['thongbao'=>'Không tìm thấy kết quả !']);
        }
        return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.index',
        compact('data','params','route_name'),
        ['thongbao'=>'']);
    }

    /* Danh sách chi tiết tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function show($co_so_id, Request $request)
    {
        $check_co_so = $this->XayDungChuongTrinhGiaoTrinhService->checkTonTai($co_so_id);
        if (!$check_co_so) {
            return redirect()->route('xuatbc.ds-xd-giao-trinh');
        }

        $params = $request->all();
        if(!isset($params['page_size'])) $params['page_size'] = config('common.paginate_size.default');
        $route_name = Route::current()->action['as'];

        $data = $this->XayDungChuongTrinhGiaoTrinhService->chiTietTheoCoSo($co_so_id,$params);
        $params['get_nganh_nghe_theo_co_so'] = $this->XayDungChuongTrinhGiaoTrinhService->getNganhNgheTheoCoSo($co_so_id);
        $thongtincoso = $this->XayDungChuongTrinhGiaoTrinhService->getSingleCsdt($co_so_id);
        $data->withPath("?nghe_id=$request->nghe_id&dot=$request->dot&nam=$request->nam&page_size=$request->page_size");

        if($data->count() < 1){
            return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.show',
            compact('data','params','route_name','thongtincoso'),
            ['thongbao'=>'Không tìm thấy kết quả !']);
        }
        return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.show',
        compact('data','params','route_name','thongtincoso'),['thongbao'=>'']);
    }

    /* Màn hình thêm tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function create()
    {
        $params['get_co_so'] = $this->XayDungChuongTrinhGiaoTrinhService->getCoSoDaoTao();
        return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.create',
        compact('params'));
    }

    /* Lưu dữ liệu màn hình thêm tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function store(StoreXayDungChuongTrinhGiaoTrinhRequest $request)
    {
        $params = $request->all();
        $kq = $this->XayDungChuongTrinhGiaoTrinhService->checkTonTaiKhiThem($params);
        if($kq){
            return redirect()->route('xuatbc.create-ds-xd-giao-trinh')->with(['edit'=> $kq->id])->withInput();
        }

        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $this->XayDungChuongTrinhGiaoTrinhService->store($request->except('_token'));
        return redirect()->route('xuatbc.ds-xd-giao-trinh')->with(['success'=> 'thêm thành công']);
    }

    /* Màn hình sửa tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function edit($id)
    {
        $data = $this->XayDungChuongTrinhGiaoTrinhService->findById($id);
        if (empty($data)) {
            return redirect()->route('xuatbc.ds-xd-giao-trinh');
        }

        $params['ten_nghe'] = $this->XayDungChuongTrinhGiaoTrinhService->findNganhNgheById($data->nghe_id)->ten_nganh_nghe;
        $params['co_so_dao_tao'] = $this->XayDungChuongTrinhGiaoTrinhService->getCoSoDaoTao();
        return view('tong-hop-ket-qua-xay-dung-chuong-trinh-giao-trinh.edit',compact('params','data'));
    }


    /* Cập nhật dữ liệu màn hình sửa tổng hợp xây dựng chương trình giáo trình.
     * @author: phucnv
     * @created_at 2020-06-19
     */
    public function update(UpdateXayDungChuongTrinhGiaoTrinhRequest $request, $id)
    {
        $data = $this->XayDungChuongTrinhGiaoTrinhService->findById($id);
        if (empty($data)) {
           return redirect()->route('xuatbc.ds-xd-giao-trinh');
        }

        $dateTime = Carbon::now();
        $request->request->set('thoi_gian_cap_nhat', $dateTime->format('Y-m-d H:i:s'));
        $this->XayDungChuongTrinhGiaoTrinhService->updateData($id,$request);
        return redirect()->route('xuatbc.show-ds-xd-giao-trinh',['co_so_id' => $data->co_so_id])->with(['success'=>'Cập nhật thành công !']);
    }

    //phucnv end BM:12
}
