<?php

use Illuminate\Database\Seeder;

class tong_hop_chinh_sach_voi_hssv extends Seeder
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
        $co_so_dao_tao = DB::table('co_so_dao_tao')->get();
        for ($i = 0; $i < $limit; $i++){
            DB::table('tong_hop_chinh_sach_voi_hssv')->insert([
                'co_so_id' => $co_so_dao_tao->toArray()[rand(0,count($co_so_dao_tao)-1)]->id,
                'thoi_gian_nhap' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'so_sv_mien_hoc_phi' => rand(100,400),
                'so_sv_giam_70' => rand(100,400),
                'so_sv_giam_50' => rand(100,400),
                'so_sv_thuoc_dien_ngheo' => rand(100,400),
                'so_sv_thuoc_dien_pho_thong_dan_toc' => rand(100,400),
                'so_nguoi_Kinh_thuoc_dien_ngheo' => rand(100,400),
                'so_sv_xuat_sac' => rand(100,400),
                'so_sv_gioi' => rand(100,400),
                'so_sv_kha' => rand(100,400),
                'chinh_sach_tin_dung' => rand(100,400),
                'tro_cap_xa_hoi' => rand(100,400),
                'chinh_sach_khac' => rand(100,400),
                'so_sv_mien_giam_hoc_phi_TC' => rand(100,400),
                'so_sv_giam_70_TC' => rand(100,400),
                'so_sv_giam_50_TC' => rand(100,400),
                'so_sv_thuoc_dien_ngheo_TC' => rand(100,400),
                'so_sv_thuoc_dien_pho_thong_dan_toc_TC' => rand(100,400),
                'so_nguoi_Kinh_thuoc_dien_ngheo_TC' => rand(100,400),
                'so_sv_xuat_sac_TC' => rand(100,400),
                'so_sv_gioi_TC' => rand(100,400),
                'so_sv_kha_TC' => rand(100,400),
                'chinh_sach_tin_dung_TC' => rand(100,400),
                'tro_cap_xa_hoi_TC' => rand(100,400),
                'chinh_sach_khac_TC' => rand(100,400)


            ]);
    	}
    }
}
