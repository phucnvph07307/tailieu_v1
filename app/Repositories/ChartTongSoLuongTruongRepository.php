<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use App\CoSoDaoTao;

use Carbon\Carbon;

class ChartTongSoLuongTruongRepository extends BaseRepository
{
    protected $model;

    public function __construct(CoSoDaoTao $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable(){
        
        return 'co_so_dao_tao';
    }
    

    public function getTongSoLuongTruongChart(){
        $cao_dang = 1;
        $trung_cap = 2;
        $he_khac = 3;
        $query['cao_dang'] = $this->model
        ->where('loai_truong','like', $cao_dang .'%')->count();

        $query['trung_cap'] = $this->model
        ->where('loai_truong','like', $trung_cap .'%')->count();

        $query['he_khac'] = $this->model
        ->where('loai_truong','like', $he_khac .'%')->count();
        
       
        

        return $query;
    }
}