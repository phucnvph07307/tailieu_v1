<?php

use Illuminate\Database\Seeder;

class loai_hinh_co_so extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	//Cơ sở công lập
        DB::table('loai_hinh_co_so')->insert([
        	'id' => '004',
        	'loai_hinh_co_so' => 'Cơ sở công lập'
        ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '005',
        // 	'loai_hinh_co_so' => 'Trường cao đẳng (công lập)'
        // ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '006',
        // 	'loai_hinh_co_so' => 'Trường trung cấp (công lập)'
        // ]);

        //Cơ sở tư thục
        DB::table('loai_hinh_co_so')->insert([
        	'id' => '009',
        	'loai_hinh_co_so' => 'Cơ sở tư thục'
        ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '010',
        // 	'loai_hinh_co_so' => 'Trường cao đẳng (tư thục)'
        // ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '011',
        // 	'loai_hinh_co_so' => 'Trường trung cấp (tư thục)'
        // ]);

        //Cở sở có vốn đầu tư nước ngoài
        DB::table('loai_hinh_co_so')->insert([
        	'id' => '014',
        	'loai_hinh_co_so' => 'Cơ sở có vốn đầu tư nước ngoài'
        ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '015',
        // 	'loai_hinh_co_so' => 'Trường cao đẳng (vốn đầu tư nước ngoài)'
        // ]);
        // DB::table('loai_hinh_co_so')->insert([
        // 	'id' => '016',
        // 	'loai_hinh_co_so' => 'Trường trung cấp (vốn đầu tư nước ngoài)'
        // ]);
    }
}
