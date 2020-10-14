<?php

use Illuminate\Database\Seeder;

class quy_mo_tuyen_sinh extends Seeder
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
        $giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao = DB::table('giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao')->get();
        for ($i = 0; $i < $limit; $i++){
            DB::table('quy_mo_tuyen_sinh')->insert([
            	'chung_nhan_id'=>$giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao->toArray()[rand(0,count($giay_chung_nhan_dang_ky_nghe_duoc_phep_dao_tao)-1)]->id,
                'ma_cap_loai' => rand(1,4),
                'so_ma' => $fake->ean8,
                'quy_mo_tuyen_sinh' => rand(20,60)
            ]);
        }
    }
}
