<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportReportController extends Controller
{
    public function doingucanboquanly()
    {
        return view('importreport.doi_ngu_can_bo_quan_ly');
    }
    public function chinhsachchosinhvien()
    {
        return view('importreport.thuc_hien_chinh_sach_cho_sinh_vien');
    }
    public function ketquatuyensinh()
    {
        return view('importreport.ket_qua_tuyen_sinh');
    }
    public function xaydungchuongtrinh()
    {
        return view('importreport.xay_dung_chuong_trinh_giao_trinh');
    }
    public function ketquatotnghiep()
    {
        return view('importreport.ket_qua_tot_nghiep');
    }
    public function daotaonguoikhuyetat()
    {
        return view('importreport.dao_tao_nghe_cho_nguoi_khuyet_tat');
    }
    public function daotaothanhnien()
    {
        return view('importreport.dao_tao_nghe_cho_thanh_nien');
    }
    public function ketquadaotaovoidoanhnghiep()
    {
        return view('importreport.ket_qua_tot_nghiep_dao_tao_gan_voi_doanh_nghiep');
    }
    public function lienketdaotao()
    {
        return view('importreport.lien_ket_dao_tao');
    }
    public function chitietlienketdaotao()
    {
        return view('lien-ket-dao-tao.chi-tiet-lien-ket-dao-tao');
    }
    public function themmoilienketdaotao()
    {
        return view('lien-ket-dao-tao.them-moi-lien-ket-dao-tao');
    }
    public function chinhsualienketdaotao()
    {
        return view('lien-ket-dao-tao.chinh-sua-lien-ket-dao-tao');
    }
    public function deadlinebaocao()
    {
        return view('importreport.thiet_lap_deadline_bao_cao_theo_dot');
    }
    public function tiendonopbaocao()
    {
        return view('importreport.kiem_soat_tien_do_nop_bao_cao');
    }
    public function pheduyetbaocao()
    {
        return view('importreport.phe_duyet_bao_cao');
    }
}