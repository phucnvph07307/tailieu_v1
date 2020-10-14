<?php

use Illuminate\Database\Seeder;

class ket_qua_tot_nghiep_gan_voi_doanh_nghiep extends Seeder
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
            DB::table('ket_qua_tot_nghiep_gan_voi_doanh_nghiep')->insert([

            	'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'ten_doanh_nghiep' => $fake->firstNameMale,

                'nhap_hoc_dau_tot_nghiep_CD' => rand(100,400),
                'tot_nghiep_CD' => rand(100,400),

                'nhap_hoc_dau_tot_nghiep_TC' => rand(100,400),
                'tot_nghiep_TC' => rand(100,400),   

                'nhap_hoc_dau_tot_nghiep_SC' => rand(100,400),
                'tot_nghiep_SC' => rand(100,400),

                'duoi_3_thang_tot_nghiep_nhap_hoc_dau' => rand(100,400),
                'duoi_3_thang_tot_nghiep' => rand(100,400),
                'kq_viec_lam_sau_tot_nghiep' => rand(100,400),
                'muc_luong_doanh_nghiep_tra' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222)
            ]);
        }
    }
}
