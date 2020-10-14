<?php

use Illuminate\Database\Seeder;

class ket_qua_dao_tao_nghe extends Seeder
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
        for ($i = 0; $i < $limit; $i++){
            DB::table('ket_qua_dao_tao_nghe')->insert([
            	'co_so_dao_tao_ten' => $fake->lastName,
                'thoi_gian_cap_nhat' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'nam' => $fake->year($max = 'now'),
                'dot' => rand(1,10),
                'thoi_gian_dao_tao' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'tuyen_sinh_nu' => rand(100,400),
                'tuyen_sinh_ho_khau_HN' => rand(100,400),
                'tuyen_sinh_bo_doi_xuat_ngu_nu' => rand(100,400),
                'tuyen_sinh_bo_doi_xuat_ngu_ho_khau_HN' => rand(100,400),
                'tuyen_sinh_CA_nu' => rand(100,400),
                'tuyen_sinh_CA_ho_khau_HN' => rand(100,400),
                'tuyen_sinh_thanh_nien_tinh_nguyen_nu' => rand(100,400),
                'tuyen_sinh_thanh_nien_ho_khau_HN' => rand(100,400),

                'tot_nghiep_nu' => rand(100,400),
                'tot_nghiep_ho_khau_HN' => rand(100,400),
                'tot_nghiep_bo_doi_xuat_ngu_nu' => rand(100,400),
                'tot_nghiep_bo_doi_xuat_ngu_ho_khau_HN' => rand(100,400),
                'tot_nghiep_CA_nu' => rand(100,400),
                'tot_nghiep_CA_ho_khau_HN' => rand(100,400),
                'tot_nghiep_thanh_nien_tinh_nguyen_nu' => rand(100,400),
                'tot_nghiep_thanh_nien_tinh_nguyen_ho_khau_HN' => rand(100,400),
                'ngan_sach_TW' => rand(100,400),
                'ngan_sach_TP' => rand(100,400),
                'ngan_sach_khac' => rand(100,400)

            ]);
        }
    }
}
