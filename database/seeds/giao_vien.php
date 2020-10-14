<?php

use Illuminate\Database\Seeder;

class giao_vien extends Seeder
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
        $co_so_dao_tao = DB::table('co_so_dao_tao')->get();
        $trinh_do_gv = DB::table('trinh_do_gv')->get();
        for ($i = 0; $i < $limit; $i++){
            DB::table('giao_vien')->insert([
                'ten' => $fake->lastName,
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'gioi_tinh' => rand(0,1),
                'mon_chung' => $fake->colorName,
                'dan_toc_it_nguoi' => rand(0,1),
                'giao_su' => rand(0,1),
                'pho_giao_su' => rand(0,1),
                'nha_giao_nhan_dan' => rand(0,1),
                'nha_giao_uu_tu' => rand(0,1),
                'loai_hop_dong' => rand(1,3),
                'trinh_do_id' => $trinh_do_gv->toArray()[rand(0,count($trinh_do_gv)-1)]->id,
                'trinh_do_ngoai_ngu' => rand(1,6),
                'trinh_do_tin_hoc' => rand(1,2),
                'trinh_do_ky_nang_nghe' => rand(1,3),
                'trinh_do_nghiep_vu_su_pham' => rand(1,3)
            ]);
        }
    }
}
