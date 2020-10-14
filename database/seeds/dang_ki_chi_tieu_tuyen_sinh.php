<?php

use Illuminate\Database\Seeder;

class dang_ki_chi_tieu_tuyen_sinh extends Seeder
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
            DB::table('dang_ki_chi_tieu_tuyen_sinh')->insert([
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'co_so_dao_tao_ten' => $fake->lastName,
                'so_dang_ki_CD' => rand(100,1000),
                'so_dang_ki_TC' => rand(100,1000)
            ]);
        }
    }
}
