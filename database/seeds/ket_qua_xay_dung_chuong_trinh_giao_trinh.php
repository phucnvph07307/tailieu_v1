<?php

use Illuminate\Database\Seeder;

class ket_qua_xay_dung_chuong_trinh_giao_trinh extends Seeder
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
            DB::table('ket_qua_xay_dung_chuong_trinh_giao_trinh')->insert([
            	'co_so_dao_tao_ten' => $fake->lastName,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'XD_chuong_trinh_moi_CD' => rand(100,400),
                'XD_chuong_trinh_moi_TC' => rand(100,400),
                'XD_chuong_trinh_moi_SC' => rand(100,400),

                'XD_giao_trinh_moi_CD' => rand(100,400),
                'XD_giao_trinh_moi_TC' => rand(100,400),
                'XD_giao_trinh_moi_SC' => rand(100,400),

                'sua_chuong_trinh_CD' => rand(100,400),
                'sua_chuong_trinh_TC' => rand(100,400),
                'sua_chuong_trinh_SC' => rand(100,400),

                'sua_giao_trinh_CD' => rand(100,400),
                'sua_giao_trinh_TC' => rand(100,400),
                'sua_giao_trinh_SC' => rand(100,400)
            ]);
        }
    }
}
