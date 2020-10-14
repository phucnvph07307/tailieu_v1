<?php

use Illuminate\Database\Seeder;

class ket_qua_tuyen_sinh_gan_voi_doanh_nghiep extends Seeder
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
        $nganh_nghe = DB::table('nganh_nghe')->get();

        for ($i = 0; $i < $limit; $i++){
            DB::table('ket_qua_tuyen_sinh_gan_voi_doanh_nghiep')->insert([

            	'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                
                'ket_qua_CD' => rand(100,400),
                'ket_qua_TC' => rand(100,400),
                'ket_qua_SC' => rand(100,400),
                'ket_qua_duoi_3_thang' => rand(100,400),

                'ten_doanh_nghiep' => $fake->firstNameMale,
                'so_HSSV_duoc_cam_ket' => rand(100,400),
                'doanh_nghiep_xay_dung_chuong_trinh' => rand(100,400),
                'doanh_nghiep_tham_gia_giang_day' => rand(100,400),
                'doanh_nghiep_ho_tro_kinh_phi_dao_tao' => rand(100,400),
                'doanh_nghiep_dat_hang_dao_tao' => rand(100,400),
                'doanh_nghiep_tiep_nhan_HSSV_thuc_tap' => rand(100,400),
                'khac' => $fake->text($maxNbChars = 200)
            ]);
        }
    }
}
