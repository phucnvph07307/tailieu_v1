<?php

namespace App\Http\Controllers;

use App\Services\TuVanHoTroService;
use Illuminate\Http\Request;

class TuVanHoTroController extends Controller
{
    private $tuVanHoTroService;
    public function __construct(TuVanHoTroService $tuVanHoTroService)
    {
        $this->tuVanHoTroService = $tuVanHoTroService;
    }

    public function danhsach(Request $request){


    }

    public function clientSendForm(){
        return view('ho_tro.client_ho_tro_form');
    }

    public function postClientSendForm(Request $request){
        $request->validate(
            [
                "ten_nguoi_gui" => "required|max:255",
                "email_nguoi_gui" => "required|email|max:255",
                "so_dien_thoai_nguoi_gui" => "required|numeric|digits_between:8,10",
                "tieu_de" => "required|max:255",
                "noi_dung" => "required"
            ],
            [
                "ten_nguoi_gui.required" => "Hãy nhập họ và tên",
                "ten_nguoi_gui.max" => "Độ dài vượt mức cho phép",

                "email_nguoi_gui.required" => "Hãy nhập email",
                "email_nguoi_gui.email" => "Không đúng định dạng email",
                "email_nguoi_gui.max" => "Độ dài vượt mức cho phép",

                "so_dien_thoai_nguoi_gui.required" => "Hãy nhập số điện thoại",
                "so_dien_thoai_nguoi_gui.numeric" => "Không đúng định dạng số điện thoại",
                "so_dien_thoai_nguoi_gui.digits_between" => "Độ dài nằm trong khoảng 8-10 chữ số",

                "tieu_de.required" => "Hãy nhập tiêu đề",
                "tieu_de.max" => "Độ dài vượt mức cho phép",

                "noi_dung.required" => "Hãy nhập nội dung"
            ]
        );

        $this->tuVanHoTroService->clientThemTuVanHoTro($request->except('_token'));
        return view('ho_tro.cam_on_phan_hoi');
    }

    public function chitiet($id){
        $model = $this->tuVanHoTroService->findOne($id);
        if($model){
            return view('ho_tro.chi-tiet', compact('model'));
        }

        return view('errors.404');
    }

    public function traloiyeucau($id, Request $request){
        $request->validate(
            [
                'tieu_de_phan_hoi' => "required|max:255",
                'noi_dung_phan_hoi' => "required"
            ],
            [
                'tieu_de_phan_hoi.required' => "Hãy nhập tiêu đề của phản hồi",
                'tieu_de_phan_hoi.max' => "Độ dài vượt quá quy định",
                'noi_dung_phan_hoi.required' => "Hãy nhập nội dung trả lời",
            ]
        );
        $model = $this->tuVanHoTroService->findOne($id);
        if(!$model){
            return view('errors.404');
        }

        $result = $this->tuVanHoTroService->traLoiYeuCau($id, $request->except("_token"));
        $flashMessage = $result == true ? "Gửi phản hồi thành công!" : "Đã có lỗi xảy ra, vui lòng kiểm tra lại!";
        return redirect()->route('tu_van_ho_tro.chi-tiet', ['id' => $id])->with('result_status', $flashMessage);
    }
}
