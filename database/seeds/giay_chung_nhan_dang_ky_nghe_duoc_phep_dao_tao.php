<?php

use Illuminate\Database\Seeder;

class giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao extends Seeder
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
            DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->insert([
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id
            ]);
        }
    }
}
