<?php

use Illuminate\Database\Seeder;

class chi_nhanh_dao_tao extends Seeder
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
        $quyet_dinh_thanh_lap_csdt = DB::table('quyet_dinh_thanh_lap_csdt')->get();

        for ($i = 0; $i < $limit; $i++){
            DB::table('chi_nhanh_dao_tao')->insert([
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'dia_chi' => $fake->address,
                'chi_nhanh_chinh' => rand(0,1),
                'ma_chung_nhan_dang_ki_hoat_dong' => $fake->ean8,
                'da_duoc_cap' => rand(0,1),
                'trang_thai' => 1
            ]);
    	}
    }
}
