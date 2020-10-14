<?php

use Illuminate\Database\Seeder;

class lien_ket_qua_tuyen_sinh extends Seeder
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

        for ($i = 0; $i < $limit; $i++){
            DB::table('lien_ket_qua_tuyen_sinh')->insert([
            	'co_so_dao_tao_ten' => $fake->lastName,

                'chi_tieu_cao_dang' => rand(100,400),
                'thuc_tuyen_cao_dang' => rand(100,400),
                'so_HSSV_tot_nghiep_cao_dang' => rand(100,400),
                'don_vi_lien_ket_cao_dang' => rand(100,400),

                'chi_tieu_trung_cap' => rand(100,400),
                'thuc_tuyen_trung_cap' => rand(100,400),
                'so_HSSV_tot_trung_cap' => rand(100,400),
                'don_vi_lien_ket_trung_cap' => rand(100,400),
                'ghi_chu' => $fake->text($maxNbChars = 200)

            ]);
        }
    }
}
