<?php


namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\TuyenSinh;
use Carbon\Carbon;

class ChartTongKetQuaTuyenSinhRepository extends BaseRepository
{
    public function getTable(){
		return 'tuyen_sinh';
	}

    public function getTongKetQuaTuyenSinhChart(){
        
        
        $data = $this->table
                ->select('nam', 
                DB::raw('SUM(so_luong_sv_Cao_dang) as so_luong_sv_Cao_dang'),
                DB::raw('SUM(so_luong_sv_Trung_cap) as so_luong_sv_Trung_cap'),
                DB::raw('SUM(so_luong_sv_So_cap) as so_luong_sv_So_cap'),
                DB::raw('SUM(so_luong_sv_he_khac) as so_luong_sv_he_khac'))
                ->groupBy('nam')
                ->orderBy('nam', 'desc')
                ->limit(4)
                ->get();
               
        if(count($data) == 0){
            for($i = 0 ; $i < count($data) ; $i++){
                $data[$i]->so_luong_sv_Cao_dang = 0;
                $data[$i]->so_luong_sv_Trung_cap = 0;
                $data[$i]->so_luong_sv_So_cap = 0;
                $data[$i]->so_luong_sv_he_khac = 0;
            }
            
        }
        else{
            
            for($i = 0 ; $i < count($data) ; $i++){
                $data[$i]->so_luong_sv_Cao_dang  = isset($data[$i]->so_luong_sv_Cao_dang ) ?  $data[$i]->so_luong_sv_Cao_dang  : 0 ;
                $data[$i]->so_luong_sv_Trung_cap = isset($data[$i]->so_luong_sv_Trung_cap) ?  $data[$i]->so_luong_sv_Trung_cap : 0 ;
                $data[$i]->so_luong_sv_So_cap    = isset($data[$i]->so_luong_sv_So_cap)    ?  $data[$i]->so_luong_sv_So_cap    : 0 ;
                $data[$i]->so_luong_sv_he_khac   = isset($data[$i]->so_luong_sv_he_khac )  ?  $data[$i]->so_luong_sv_he_khac   : 0 ; 
            }
        }   
               
              
        return  $data;

    }
}