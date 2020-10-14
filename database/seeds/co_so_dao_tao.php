<?php

use Illuminate\Database\Seeder;

class co_so_dao_tao extends Seeder
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
        $co_quan_chu_quan = DB::table('co_quan_chu_quan')->get();
        $loai_hinh_co_so = DB::table('loai_hinh_co_so')->get();
        $quyet_dinh_thanh_lap_csdt = DB::table('quyet_dinh_thanh_lap_csdt')->get();

        for ($i = 0; $i < $limit; $i++){
            DB::table('co_so_dao_tao')->insert([
                'ten' => $fake->state,
                'ma_don_vi' => $fake->buildingNumber,
                'co_quan_chu_quan_id' => $co_quan_chu_quan->toArray()[rand(0,count($co_quan_chu_quan)-1)]->id,
                'ma_loai_hinh_co_so' => $loai_hinh_co_so->toArray()[rand(0,count($loai_hinh_co_so)-1)]->id,
                'quyet_dinh_id' => $quyet_dinh_thanh_lap_csdt->toArray()[rand(0,count($quyet_dinh_thanh_lap_csdt)-1)]->id,
                'logo' => $fake->imageUrl($width = 640, $height = 480),
                'dien_thoai' => $fake->tollFreePhoneNumber,
                'fax' => $fake->e164PhoneNumber,
                'website' => $fake->domainName,
                'dia_chi' => $fake->address,
                'ten_quoc_te' => $fake->lastName,
                'ghi_chu' => $fake->text($maxNbChars = 200)
            ]);
    	}
	}
}