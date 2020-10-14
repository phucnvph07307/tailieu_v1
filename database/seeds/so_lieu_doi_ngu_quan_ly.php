<?php

use Illuminate\Database\Seeder;

class so_lieu_doi_ngu_quan_ly extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Faker\Factory::create();
        $limit = 15;
        $co_so_dao_tao = DB::table('co_so_dao_tao')->get();
        for($i = 0; $i < $limit; $i++){

        	DB::table('so_lieu_doi_ngu_quan_ly')->insert([
        		'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'tong_so_can_bo' => rand(40,60),
                'so_luong_nu' => rand(10,20),
                'dan_toc_it_nguoi' => rand(20,30),
                'so_can_bo_quan_li_tham_gia_giang_day' => rand(10,30),
                'so_can_bo_da_boi_duong_nghiep_vu' => rand(10,30),
                'so_nha_giao_nhan_dan_nha_giao_uu_tu' => rand(10,30),
                'hieu_truong' => 1,
                'hieu_pho' => 1,
                'so_truong_khoa' => rand(3,10),
                'so_pho_khoa' => rand(3,10),
                'so_to_truong_chuyen_mon' => rand(3,10),
                'so_tien_sy' => rand(3,10),
                'so_thac_si' => rand(3,10),
                'so_dai_hoc' => rand(3,10),
                'so_cao_dang' => rand(3,10),
                'so_trung_cap' => rand(3,10),
                'so_khac' => rand(3,10),

        	]);
        	

        };
    }
}	
