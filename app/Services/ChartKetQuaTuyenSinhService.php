<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\SoLieuTuyenSinhRepository;
use App\Repositories\LoaiHinhCoSoRepositoryInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Carbon\Carbon;
use Storage;
use App\Repositories\ChartKetQuaTuyenSinhRepository;


class ChartKetQuaTuyenSinhService extends AppService{
    public function getRepository()
    {
        return ChartKetQuaTuyenSinhRepository::class;
    }
    public function getKetQuaTuyenSinhChart($params){
        
        return $this->repository->getKetQuaTuyenSinhChart($params);
    }
}