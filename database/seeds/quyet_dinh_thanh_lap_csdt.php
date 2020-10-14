<?php

use Illuminate\Database\Seeder;

class quyet_dinh_thanh_lap_csdt extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Faker\Factory::create();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++){
            DB::table('quyet_dinh_thanh_lap_csdt')->insert([
                'ten' => $fake->firstNameFemale,
                'van_ban_url' => $fake->url,
                'ngay_ban_hanh' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'ngay_hieu_luc' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'ngay_het_han' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'loai_quyet_dinh' => rand(1,4)
            ]);
        }
    }
}
