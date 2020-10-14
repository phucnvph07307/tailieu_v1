<?php

use Illuminate\Database\Seeder;

class trinh_do_gv extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Tiến sỹ'
        ]);
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Thạc sỹ'
        ]);
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Đại học'
        ]);
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Cao đẳng'
        ]);
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Trung cấp'
        ]);
        DB::table('trinh_do_gv')->insert([
                'ten' => 'Trình độ khác'
        ]);
        
    }
}
