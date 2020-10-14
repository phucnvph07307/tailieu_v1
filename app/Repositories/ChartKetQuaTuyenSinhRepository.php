<?php


namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\TuyenSinh;
use Carbon\Carbon;

class ChartKetQuaTuyenSinhRepository extends BaseRepository
{
    public function getTable(){
		return 'tuyen_sinh';
	}

    public function getKetQuaTuyenSinhChart($params){
        
        $query = $this->table;
        if (isset($params['dot']) && $params['dot'] != 0) {
            $query->where('tuyen_sinh.dot', $params['dot']);
            }
        if (isset($params['nam']) && $params['nam'] != 0) {
                $query->where('tuyen_sinh.nam', $params['nam']);
            }
        if (isset($params['co_so_id']) && $params['co_so_id'] != 0) {
                $query->where('tuyen_sinh.co_so_id', $params['co_so_id']);
            }
        $data = (array)$query->first();

        if($data == []){
                $data = [
                    'so_luong_sv_Cao_dang'=> 0,
                    'so_luong_sv_Trung_cap'=> 0,
                    'so_luong_sv_So_cap'=> 0,
                    'so_luong_sv_he_khac'=> 0
                ];
            }
            else{
         
                $data['so_luong_sv_Cao_dang'] = isset($data['so_luong_sv_Cao_dang'])  ?  $data['so_luong_sv_Cao_dang'] : 0 ;
                $data['so_luong_sv_Trung_cap'] = isset($data['so_luong_sv_Trung_cap'])  ?  $data['so_luong_sv_Trung_cap'] : 0 ;
                $data['so_luong_sv_So_cap'] = isset($data['so_luong_sv_So_cap'])  ?  $data['so_luong_sv_So_cap'] : 0 ;
                $data['so_luong_sv_he_khac'] = isset($data['so_luong_sv_he_khac'])  ?  $data['so_luong_sv_he_khac'] : 0 ;
            }
        return $data;
    }

   
   

} 