<?php


namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\Models\SoLieuCanBoQuanLy;
use Carbon\Carbon;


class ChartDoiNguCanBoQuanLyRepository extends BaseRepository{
    public function getTable(){
        return 'so_lieu_can_bo_quan_ly';
    }

    public function getSoLieuCanBoQuanLyChart(){
        
        $data = $this->table
        ->select('nam', 
        DB::raw('SUM(tong_so_quan_ly) as tong_so_quan_ly'),)
        ->groupBy('nam')
        ->orderBy('nam', 'desc')
        ->limit(4)
        ->get();
       // check null
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
        return $data;
        
        
    }

}
