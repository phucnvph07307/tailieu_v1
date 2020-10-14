<?php

use Illuminate\Database\Seeder;

class sv_tot_nghiep extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Faker\Factory::create();
        $limit = 15;
        $co_so_dao_tao = DB::table('co_so_dao_tao')->get();
        $nganh_nghe = DB::table('nganh_nghe')->get();

        for ($i = 0; $i < $limit; $i++){
            DB::table('sv_tot_nghiep')->insert([
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,

                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                
                'Tong_SoNguoi_TN' => rand(100,400),
                'NU_SV_TN' => rand(100,400),
                'DanToc_ThieuSo_ItNguoi' => rand(100,400),
                'HoKhauHN' => rand(100,400),

                'SoSV_NhapHoc_DauKhoa_TrinhDoCD' => rand(100,400),
                'SoSV_Du_DieuKienThi_XetTN_TrinhDoCD' => rand(100,400),
                'SoSV_TN_TrinhDoCD' => rand(100,400),
                'SoLuong_Nu_SV_CD' => rand(100,400),
                'SoSV_HoKhauHN_CD' => rand(100,400),
                'SoLuong_HSSV_TN_Kha_Gioi_CD' => rand(100,400),

                'SoSV_NhapHoc_DauKhoa_TrinhDoTC' => rand(100,400),
                'SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC' => rand(100,400),
                'SoSV_TN_TrinhDoTC' => rand(100,400),
                'SoLuong_Nu_SV_TC' => rand(100,400),
                'SoSV_HoKhauHN_TC' => rand(100,400),
                'SoLuong_HSSV_TN_Kha_Gioi_TC' => rand(100,400),

                'SoSV_NhapHoc_DauKhoa_TrinhDoSC' => rand(100,400),
                'SoSV_Du_DieuKienThi_XetTN_TrinhDoSC' => rand(100,400),
                'SoSV_TN_TrinhDoSC' => rand(100,400),
                'SoLuong_Nu_SV_SC' => rand(100,400),
                'SoSV_HoKhauHN_SC' => rand(100,400),
                'SoLuong_HSSV_TN_Kha_Gioi_SC' => rand(100,400),

                'SoSV_NhapHoc_DauKhoa_NgheKhac' => rand(100,400),
                'SoSV_DuKienThi_XetTN_NgheKhac' => rand(100,400),
                'SoSV_TN_NgheKhac' => rand(100,400),
                'SoLuong_Nu_SV_NgheKhac' => rand(100,400),
                'DanToc_ThieuSo_ItNguoi_NgheKhac' => rand(100,400),
                'SoNguoi_HoKhauHN_NgheKhac' => rand(100,400),

                'SoNguoi_CoViecLamNgay_SauKhi_TN_CD' => rand(100,400),
                'CoViecLam_HoKhauHN_TrinhDoCD' => rand(100,400),
                'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC' => rand(100,400),
                'CoViecLam_HoKhauHN_TrinhDo_TC' => rand(100,400),
                'SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC' => rand(100,400),
                'SV_CoViecLamNgay_SauKhi_TN_TrinhDoTC' => rand(100,400),
                'SoLuong_HoKhauHN_TrinhDoSC' => rand(100,400),

                'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac' => rand(100,400),
                'SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac' => rand(100,400),

                'MucLuong_TB_CD' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),
                'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),

                'MucLuong_TB_TC' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),
                'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),

                'MucLuong_TB_SC' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),
                'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),

                'MucLuong_TB_NgheKhac' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222),
                'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222)
            ]);
    	}
    }
}
