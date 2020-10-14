<?php

use Illuminate\Database\Seeder;

class nganh_nghe extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Cao đẳng
        DB::table('nganh_nghe')->insert([
        	'id' => '5210101',
        	'ten_nganh_nghe' => 'Kỹ thuật điêu khắc gỗ'
        ]);
        DB::table('nganh_nghe')->insert([
        	'id' => '5210102',
        	'ten_nganh_nghe' => 'Điêu khắc'
        ]);
        DB::table('nganh_nghe')->insert([
        	'id' => '5210103',
        	'ten_nganh_nghe' => 'Hội họa'
        ]);
        //Trung cấp
        DB::table('nganh_nghe')->insert([
        	'id' => '6210101',
        	'ten_nganh_nghe' => 'Kỹ thuật điêu khắc gỗ'
        ]);
        DB::table('nganh_nghe')->insert([
        	'id' => '6210102',
        	'ten_nganh_nghe' => 'Điêu khắc'
        ]);
        DB::table('nganh_nghe')->insert([
        	'id' => '6210103',
        	'ten_nganh_nghe' => 'Hội họa'
        ]);
    }
}
