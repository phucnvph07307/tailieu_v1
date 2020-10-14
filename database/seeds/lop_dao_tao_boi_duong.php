<?php

use Illuminate\Database\Seeder;

class lop_dao_tao_boi_duong extends Seeder
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
        $giao_vien = DB::table('giao_vien')->get();
        
        for ($i = 0; $i < $limit; $i++){
            DB::table('lop_dao_tao_boi_duong')->insert([
            	'ten_lop' => $fake->lastName,
                'giang_vien_id' => $giao_vien->toArray()[rand(0,count($giao_vien)-1)]->id,
                'nam' => $fake->year($max = 'now'),
                'thang' => $fake->month($max = 'now')
            ]);
    	}
    }
}
