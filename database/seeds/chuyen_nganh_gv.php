<?php

use Illuminate\Database\Seeder;

class chuyen_nganh_gv extends Seeder
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
        $nganh_nghe = DB::table('nganh_nghe')->get();

        for ($i = 0; $i < $limit; $i++){
            DB::table('chuyen_nganh_gv')->insert([
                'nghe_id' => $nganh_nghe->toArray()[rand(0,count($nganh_nghe)-1)]->id,
                'giao_vien_id' => $giao_vien->toArray()[rand(0,count($giao_vien)-1)]->id
            ]);
        }
    }
}
