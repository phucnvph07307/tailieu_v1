<?php

use Illuminate\Database\Seeder;

class co_quan_chu_quan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake  = Faker\Factory::create();
        $limit = 5;
        for ($i = 0; $i < $limit; $i++){
            DB::table('co_quan_chu_quan')->insert([
                'ten' => $fake->lastName,
                'ma' => $fake->ean8
            ]);
        }
    }
}
