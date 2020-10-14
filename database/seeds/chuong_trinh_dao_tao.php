<?php

use Illuminate\Database\Seeder;

class chuong_trinh_dao_tao extends Seeder
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
            DB::table('chuong_trinh_dao_tao')->insert([
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'thoi_gian_bao_cao' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'tong_so' => rand(150,200),
                'so_chuong_trinh_cao_dang' => rand(20,30),
                'so_chuong_trinh_trung_cap' => rand(20,30),
                'so_chuong_trinh_so_cap' => rand(20,30),
                'hinh_thuc' => rand(1,2),
                'loai_tai_nguyen' => rand(1,2),
                'kinh_phi' => $fake->randomFloat($nbMaxDecimals = 9, $min = 1000, $max = 222222)
            ]);
        }
    }
}
