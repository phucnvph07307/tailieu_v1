<?php

use Illuminate\Database\Seeder;

class sv_dang_quan_ly extends Seeder
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
            DB::table('sv_dang_quan_ly')->insert([
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,

                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'bao_cao_url' => $fake->url,

                'so_luong_sv_Cao_dang' => rand(100,400),
                'so_luong_sv_nu_Cao_dang' => rand(100,400),
                'so_luong_sv_dan_toc_Cao_dang' => rand(100,400),
                'so_luong_sv_ho_khau_HN_Cao_dang' => rand(100,400),

                'so_luong_sv_Trung_cap' => rand(100,400),
                'so_luong_sv_nu_Trung_cap' => rand(100,400),
                'so_luong_sv_dan_toc_Trung_cap' => rand(100,400),
                'so_luong_sv_ho_khau_HN_Trung_cap' => rand(100,400),

                'so_luong_sv_So_cap' => rand(100,400),
                'so_luong_sv_nu_So_cap' => rand(100,400),
                'so_luong_sv_dan_toc_So_cap' => rand(100,400),
                'so_luong_sv_ho_khau_HN_So_cap' => rand(100,400),

                'so_luong_sv_he_khac' => rand(100,400),
                'so_luong_sv_nu_khac' => rand(100,400),
                'so_luong_sv_dan_toc_khac' => rand(100,400),
                'so_luong_sv_ho_khau_HN_khac' => rand(100,400)
            ]);
    	}
    }
}
