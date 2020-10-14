<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class chuc_nang_phan_quyen extends Seeder
{
    /** Start CườngNC - Tạo Chức Năng Của Quyền - 18/06/2020
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Permission::create(['name' => 'danh_sach_tai_khoan']);
        // Permission::create(['name' => 'them_tai_khoan']);
        // Permission::create(['name' => 'sua_tai_khoan']);
        // Permission::create(['name' => 'vo_hieu_hoa_tai_khoan']);

        // Permission::create(['name' => 'danh_sach_quyen']);
        // Permission::create(['name' => 'them_quyen']);
        // Permission::create(['name' => 'sua_quyen']);

        Permission::create(['name' => 'phe_duyet_1_co_so_dao_tao']);
        Permission::create(['name' => 'phe_duyet_2_co_so_dao_tao']);
        // Permission::create(['name' => 'danh_sach_co_so_dao_tao']);
        // Permission::create(['name' => 'them_moi_co_so_dao_tao']);
        // Permission::create(['name' => 'xem_chi_tiet_co_so_dao_tao']);
        // Permission::create(['name' => 'cap_nhat_co_so_dao_tao']);

        Permission::create(['name' => 'phe_duyet_1_dia_diem_dao_tao']);
        Permission::create(['name' => 'phe_duyet_2_dia_diem_dao_tao']);
        // Permission::create(['name' => 'danh_dia_diem_dao_tao']);
        // Permission::create(['name' => 'them_moi_dia_diem_dao_tao']);
        // Permission::create(['name' => 'cap_nhat_dia_diem_dao_tao']);
        // Permission::create(['name' => 'xoa_dia_diem_dao_tao']);

        Permission::create(['name' => 'phe_duyet_1_nganh_nghe']);
        Permission::create(['name' => 'phe_duyet_2_nganh_nghe']);
        // Permission::create(['name' => 'danh_sach_nganh_nghe']);
        // Permission::create(['name' => 'them_moi_nganh_nghe']);
        // Permission::create(['name' => 'xem_chi_tiet_nganh_nghe']);
        // Permission::create(['name' => 'cap_nhat_nganh_nghe']);
        // Permission::create(['name' => 'xoa_nganh_nghe']);

        Permission::create(['name' => 'phe_duyet_1_quan_ly_giao_vien']);
        Permission::create(['name' => 'phe_duyet_2_quan_ly_giao_vien']);
        // Permission::create(['name' => 'danh_sach_quan_ly_giao_vien']);
        // Permission::create(['name' => 'them_moi_quan_ly_giao_vien']);
        // Permission::create(['name' => 'cap_nhat_quan_ly_giao_vien']);

        Permission::create(['name' => 'phe_duyet_1_doi_ngu_quan_ly_nha_giao']);
        Permission::create(['name' => 'phe_duyet_2_doi_ngu_quan_ly_nha_giao']);
        // Permission::create(['name' => 'danh_sach_doi_ngu_nha_giao']);
        // Permission::create(['name' => 'them_moi_danh_sach_doi_ngu_nha_giao']);
        // Permission::create(['name' => 'chi_tiet_danh_sach_doi_ngu_nha_giao']);
        // Permission::create(['name' => 'cap_nhat_danh_sach_doi_ngu_nha_giao']);

        Permission::create(['name' => 'phe_duyet_1_doi_ngu_qua_ly']);
        Permission::create(['name' => 'phe_duyet_2_doi_ngu_qua_ly']);
        // Permission::create(['name' => 'danh_sach_doi_ngu_quan_ly']);
        // Permission::create(['name' => 'them_moi_danh_sach_doi_ngu_quan_ly']);
        // Permission::create(['name' => 'cap_nhat_danh_sach_doi_ngu_quan_ly']);
        // Permission::create(['name' => 'xem_chi_tiet_danh_sach_doi_ngu_quan_ly']);
        
        Permission::create(['name' => 'phe_duyet_1_thuc_hien_chinh_sach_cho_sv']);
        Permission::create(['name' => 'phe_duyet_2_thuc_hien_chinh_sach_cho_sv']);
        // Permission::create(['name' => 'danh_sach_thuc_hien_chinh_sach_cho_sv']);
        // Permission::create(['name' => 'them_moi_tong_hop_thuc_hien_chinh_sach_cho_sv']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_thuc_hien_chinh_sach_cho_sv']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_ket_qua_tuyen_sinh']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_ket_qua_tuyen_sinh']);
        // Permission::create(['name' => 'danh_sach_tong_hop_ket_qua_tuyen_sinh']);
        // Permission::create(['name' => 'them_moi_tong_hop_ket_qua_tuyen_sinh']);
        // Permission::create(['name' => 'xem_chi_tiet_tong_hop_ket_qua_tuyen_sinh']);
        // Permission::create(['name' => 'sua_chi_tiet_tong_hop_ket_qua_tuyen_sinh']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_ket_qua_tot_nghiep']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_ket_qua_tot_nghiep']);
        // Permission::create(['name' => 'danh_sach_tong_hop_ket_qua_tot_nghiep']);
        // Permission::create(['name' => 'them_moi_tong_hop_ket_qua_tot_nghiep']);
        // Permission::create(['name' => 'xem_chi_tiet_tong_hop_ket_qua_tot_nghiep']);
        // Permission::create(['name' => 'cap_nhat_chi_tiet_tong_hop_ket_qua_tot_nghiep']);
        
        Permission::create(['name' => 'phe_duyet_1_tong_hop_dang_ky_chi_tieu_tuyen_sinh']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_dang_ky_chi_tieu_tuyen_sinh']);
        // Permission::create(['name' => 'danh_sach_tong_hop_dang_ky_chi_tieu_tuyen_sinh']);
        // Permission::create(['name' => 'them_moi_tong_hop_danh_ký_chi_tieu_tuyen_sinh']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_danh_ký_chi_tieu_tuyen_sinh']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_danh_ký_chi_tieu_tuyen_sinh']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_xay_dung_chuong_trinh_giao_trinh']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_xay_dung_chuong_trinh_giao_trinh']);
        // Permission::create(['name' => 'danh_sach_tong_hop_xay_dung_chuong_trinh_giao_trinh']);
        // Permission::create(['name' => 'them_moi_tong_hop_xay_dung_chuong_trinh_giao_trinh']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_xay_dung_chuong_trinh_giao_trinh']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_xay_dung_chuong_trinh_giao_trinh']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);
        // Permission::create(['name' => 'danh_sach_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);
        // Permission::create(['name' => 'them_moi_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_dao_tao_nghe_cho_nguoi_khuyet_tat']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_nghe_cho_thanh_nien']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_nghe_cho_thanh_nien']);
        // Permission::create(['name' => 'danh_sach_tong_hop_nghe_cho_thanh_nien']);
        // Permission::create(['name' => 'them_moi_tong_hop_nghe_cho_thanh_nien']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_nghe_cho_thanh_nien']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_nghe_cho_thanh_nien']);

        Permission::create(['name' => 'phe_duyet_1_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);
        Permission::create(['name' => 'phe_duyet_2_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);
        // Permission::create(['name' => 'danh_sach_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);
        // Permission::create(['name' => 'them_moi_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);
        // Permission::create(['name' => 'chi_tiet_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);
        // Permission::create(['name' => 'cap_nhat_ket_qua_hoc_sinh_tot_nghiep_dao_tao_nghe_voi_doanh_nghiep']);

        Permission::create(['name' => 'phe_duyet_1_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);
        Permission::create(['name' => 'phe_duyet_2_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);
        // Permission::create(['name' => 'danh_sach_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);
        // Permission::create(['name' => 'them_moi_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);
        // Permission::create(['name' => 'chi_tiet_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);
        // Permission::create(['name' => 'cap_nhat_ket_qua_tuyen_sinh_dao_tao_nghe_gan_voi_doanh_nghiep']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_lien_ket_lien_thong_trinh_do']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_lien_ket_lien_thong_trinh_do']);
        // Permission::create(['name' => 'danh_sach_tong_hop_lien_ket_lien_thong_trinh_do']);
        // Permission::create(['name' => 'them_moi_tong_hop_lien_ket_lien_thong_trinh_do']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_lien_ket_lien_thong_trinh_do']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_lien_ket_lien_thong_trinh_do']);

        Permission::create(['name' => 'phe_duyet_1_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);
        Permission::create(['name' => 'phe_duyet_2_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);
        // Permission::create(['name' => 'danh_sach_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);
        // Permission::create(['name' => 'them_moi_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);
        // Permission::create(['name' => 'chi_tiet_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);
        // Permission::create(['name' => 'cap_nhat_lien_ket_dao_tao_trinh_do_cao_dang_len_dai_hoc']);

        Permission::create(['name' => 'phe_duyet_1_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);
        Permission::create(['name' => 'phe_duyet_2_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);
        // Permission::create(['name' => 'danh_sach_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);
        // Permission::create(['name' => 'them_moi_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);
        // Permission::create(['name' => 'chi_tiet_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);
        // Permission::create(['name' => 'cap_nhat_lien_ket_dao_tao_trinh_do_trung_cap_len_dai_hoc']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_giao_duc_nghe_nghiep']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_giao_duc_nghe_nghiep']);
        // Permission::create(['name' => 'danh_sach_tong_hop_giao_duc_nghe_nghiep']);
        // Permission::create(['name' => 'them_moi_tong_hop_giao_duc_nghe_nghiep']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_giao_duc_nghe_nghiep']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_giao_duc_nghe_nghiep']);

        Permission::create(['name' => 'phe_duyet_1_tong_hop_hop_tac_quoc_te']);
        Permission::create(['name' => 'phe_duyet_2_tong_hop_hop_tac_quoc_te']);
        // Permission::create(['name' => 'danh_sach_tong_hop_hop_tac_quoc_te']);
        // Permission::create(['name' => 'them_moi_tong_hop_hop_tac_quoc_te']);
        // Permission::create(['name' => 'chi_tiet_tong_hop_hop_tac_quoc_te']);
        // Permission::create(['name' => 'cap_nhat_tong_hop_hop_tac_quoc_te']);

        // Permission::create(['name' => 'danh_sach_phe_duyet']);
        // Permission::create(['name' => 'chi_tiet_danh_sach_phe_duyet']);
        // Permission::create(['name' => 'thay_doi_trang_thai_danh_sach_phe_duyet']);

        Permission::create(['name' => 'phe_duyet_1_sinh_vien_dang_theo_hoc']);
        Permission::create(['name' => 'phe_duyet_2_sinh_vien_dang_theo_hoc']);
        // Permission::create(['name' => 'danh_sach_sinh_vien_dang_theo_hoc']);
        
    }
}