<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TuVanHoTroService;

class FeedbackController extends Controller
{

    private $tuVanHoTroService;
    public function __construct(TuVanHoTroService $tuVanHoTroService)
    {
        $this->tuVanHoTroService = $tuVanHoTroService;
    }


    public function nhantinbaoloi(){
        return view('feedback.nhan_tin_bao_loi_he_thong');
    }


    public function postClientSendForm(Request $request){
        $request->validate(
            [
                "tieu_de" => "required|max:255",
                "noi_dung" => "required"
            ],
            [
                "tieu_de.required" => "Hãy nhập tiêu đề",
                "tieu_de.max" => "Độ dài vượt mức cho phép",

                "noi_dung.required" => "Hãy nhập nội dung"
            ]
        );

        $this->tuVanHoTroService->AuthThemTuVanHoTro($request->except('_token'));
        return redirect()->route('feedback.nhan-tin-bao-loi-he-thong')->with('result_status', 'Gửi phản hồi thành công');
    }

    
    public function danhSachTinNhanPhanHoi(){
        $params = request()->all();
        if(isset(request()->page_size)){
            $limit = request()->page_size;
        }else{
            $limit = 20;
        }
        $data = $this->tuVanHoTroService->getAllListPhanHoi($params, $limit);
        $data->appends(request()->input())->links();
        return view('feedback.danh_sach_tin_nhan_phan_hoi',
        [
            'data' => $data,
            'params' => $params,
            'limit' => $limit
        ]
    );
    }

}
