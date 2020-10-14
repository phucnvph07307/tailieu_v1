<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
// use App\Services\TraitsExcelService;
use App\Repositories\DaoTaoNgheChoThanhNienReponsitory;
use App\Repositories\LoaiHinhCoSoRepositoryInterface;
use App\Services\StoreUpdateNotificationService;
use App\Repositories\SoLieuTuyenSinhInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Carbon\Carbon;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class DaoTaoNgheChoThanhNienService extends AppService
{
    protected $LoaiHinhCoSoRepositoryInterface;
    protected $DaoTaoNgheChoThanhNienReponsitory;
    protected $SoLieuTuyenSinhInterface;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;
    use ExcelTraitService;

    public function __construct(
        LoaiHinhCoSoRepositoryInterface $loaiHinhCoSoRepository,
        SoLieuTuyenSinhInterface $soLieuTuyenSinhRepository,
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->loaiHinhCoSoRepository = $loaiHinhCoSoRepository;
        $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
    }

    //Lay Repository Product
    public function getRepository()
    {
        return DaoTaoNgheChoThanhNienReponsitory::class;
    }

    public function getListLoaiHinh()
    {
        return $this->loaiHinhCoSoRepository->getAll();
    }

    public function index($params = [], $limit)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['devvn_xaphuongthitran'] = isset($params['devvn_xaphuongthitran']) ? $params['devvn_xaphuongthitran'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        $data = $this->repository->index($queryData, $limit);

        return $data;
    }
    // quảng - 15/6 lấy tên cở sở đào tạo
    public function getTenCoSoDaoTao()
    {
        return $this->repository->getTenCoSoDaoTao();
    }

     // quảng - 15/6 lấy  cơ sở theo loại hình
     public function getCoSoTuyenSinhTheoLoaiHinh($id)
     {
         $data = $this->repository->getCoSoTuyenSinhTheoLoaiHinh($id);
         return $data;
     }
     public function getTenQuanHuyen()
     {
         return  $this->repository->getTenQuanHuyen();
     }
     public function getXaPhuongTheoQuanHuyen($id)
     {
         return  $this->repository->getXaPhuongTheoQuanHuyen($id);
     }
     
     // quảng - 15/6 lấy tất cả ngành nghề theo từng cấp bậc
     public function getNganhNghe($ma_cap_nghe)
     {
         return  $this->repository->getNganhNghe($ma_cap_nghe);
     }

     // quảng - 15/6  lọc ngành nghề theo từng cấp bậc
     public function getNgheTheoCapBac($id, $cap_nghe)
     {
         return  $this->repository->getNgheTheoCapBac($id, $cap_nghe);
     }

     public function getThongTinCoSo($coSoId)
     {
         return $this->CoSoDaoTaoRepository->getThongTinCoSo($coSoId);
     }

     public function getChiTietDaoTaoNgheThanhNien($coSoId, $limit, $params)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        $data = $this->repository->getChiTietDaoTaoNgheThanhNien($coSoId, $limit, $queryData);
        return $data;
    // dd($data);
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function getNganhNgheThuocCoSo($id)
    {
        return $this->repository->getNganhNgheThuocCoSo($id);
    }
    public function store($getdata)
    {
        unset($getdata['_token']);      
        $data = $this->repository->store($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu đào tạo nghề cho thanh niên';
            $route = route('nhapbc.dao-tao-thanh-nien.show',['id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }

    public function getCheckDaoTaoThanhNien($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token']);
        $route = route('nhapbc.dao-tao-thanh-nien.create');
        $message = $checkResult == 'tontai' ?
            'Số liệu tuyển sinh đã tồn tại và được phê duyệt' :
            'Số liệu tuyển sinh đã tồn tại';
        
        if (!isset($checkResult)) {
            $data = $this->store($requestParams);
            $message = 'Thêm số liệu tuyển sinh thành công';
            $route = route('nhapbc.dao-tao-thanh-nien.show', [
                'id' => $requestParams['co_so_id'],
            ]);
        }

        return [
            'route' => $route,
            'message' => $message,
        ];
    }
    public function updateData($id, $request)
    {
        $attributes = $request->all();
        unset($attributes['_token']);
		$resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
			$noidung = 'Cập nhật số liệu đạo tạo nghề cho thanh niên';
			$route = route('nhapbc.dao-tao-thanh-nien.show',['id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->getCheckDaoTaoThanhNien($dataCheckNew);
    }

    protected function constructConditionParams($params)
    {
        $conditionData = [];
        foreach ($params as $item) {
            $conditionData[] = [
                $item['id'],
                '=',
                $item['value'],
            ];
        }

        return $conditionData;
    }

    // thanhnv import export 17/6/2020

    public function sumRowInExcel($worksheet,$row){
        $worksheet->setCellValue("D{$row}", "=SUM(E{$row}:F{$row})");
        $worksheet->setCellValue("G{$row}", "=SUM(H{$row}:J{$row})");
        $worksheet->setCellValue("J{$row}", "=SUM(K{$row}:L{$row})");
        $worksheet->setCellValue("M{$row}", "=SUM(N{$row}:O{$row})");
        $worksheet->setCellValue("P{$row}", "=SUM(Q{$row}:R{$row})");
        $worksheet->setCellValue("S{$row}", "=SUM(T{$row}:U{$row})");
        $worksheet->setCellValue("V{$row}", "=SUM(W{$row}:X{$row})");
        $worksheet->setCellValue("Y{$row}", "=SUM(Z{$row}:AA{$row})");
        $worksheet->setCellValue("AB{$row}", "=SUM(AC{$row}:AE{$row})");
    }

    public function exportFillRow($worksheet, $row, $tnien){
        $worksheet->setCellValue('B'.$row, $tnien->ten_nganh_nghe.' - '.$tnien->nghe_id);
        $worksheet->setCellValue('C'.$row, $tnien->thoi_gian_dao_tao);

        $worksheet->setCellValue('D'.$row, $tnien->tong_tuyen_sinh);
        $worksheet->setCellValue('E'.$row, $tnien->nu_tuyen_sinh);
        $worksheet->setCellValue('F'.$row, $tnien->ho_khau_HN_tuyen_sinh);

        $worksheet->setCellValue('G'.$row, $tnien->tong_tuyen_sinh_bo_doi_xuat_ngu);
        $worksheet->setCellValue('H'.$row, $tnien->tuyen_sinh_bo_doi_nu);
        $worksheet->setCellValue('I'.$row, $tnien->tuyen_sinh_bo_doi_ho_khau_HN);

        $worksheet->setCellValue('J'.$row, $tnien->tong_tuyen_sinh_Ca);
        $worksheet->setCellValue('K'.$row, $tnien->tuyen_sinh_ca_nu);
        $worksheet->setCellValue('L'.$row, $tnien->tuyen_sinh_ca_ho_khau_HN);

        $worksheet->setCellValue('M'.$row, $tnien->tong_tuyen_sinh_thanh_nien);
        $worksheet->setCellValue('N'.$row, $tnien->tuyen_sinh_thanh_nien_nu);
        $worksheet->setCellValue('O'.$row, $tnien->tuyen_sinh_thanh_nien_ho_khau_HN);

        $worksheet->setCellValue('P'.$row, $tnien->tong_tot_nghiep);
        $worksheet->setCellValue('Q'.$row, $tnien->tong_tot_nghiep_nu);
        $worksheet->setCellValue('R'.$row, $tnien->tong_tot_nghiep_ho_khau_HN);
        
        $worksheet->setCellValue('S'.$row, $tnien->tong_tot_nghiep_bo_doi);
        $worksheet->setCellValue('T'.$row, $tnien->tong_nghiep_bo_doi_nu);
        $worksheet->setCellValue('U'.$row, $tnien->tong_nghiep_bo_doi_ho_khau_HN);

        $worksheet->setCellValue('V'.$row, $tnien->tong_tot_nghiep_ca);
        $worksheet->setCellValue('W'.$row, $tnien->tot_nghiep_ca_nu);
        $worksheet->setCellValue('X'.$row, $tnien->tot_nghiep_ca_ho_khau_HN);
        
        $worksheet->setCellValue('Y'.$row, $tnien->tong_tot_nghiep_thanh_nien);
        $worksheet->setCellValue('Z'.$row, $tnien->tot_nghiep_thanh_nien_nu);
        $worksheet->setCellValue('AA'.$row, $tnien->tot_nghiep_thanh_nien_ho_khau_HN);

        $worksheet->setCellValue('AB'.$row, number_format($tnien->tong_kinh_phi));
        $worksheet->setCellValue('AC'.$row, number_format($tnien->ngan_sach_TW));
        $worksheet->setCellValue('AD'.$row, number_format($tnien->ngan_sach_TP));
        $worksheet->setCellValue('AE'.$row, number_format($tnien->ngan_sach_khac));

    }

    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm10/bm10.xlsx');

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('B7', $bacDaoTao);
        $worksheet->setCellValue('B8', "Trường: $co_so->ten - $id_coso");
        
        $worksheet->getStyle("B7")->getFont()->setBold(true);
        $worksheet->getStyle("B8")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A7:AE7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A8:AE8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);
        
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['D','G','J','M','P','S','V','Y','AB','B'];
        $this->lockedCellInExcel($worksheet,$arrayLock);

        $row=8;
        foreach($co_so_nghe as $cs_n){
            $row ++;
            $worksheet->setCellValue('B'.$row, $cs_n->ten_nganh_nghe.' - '.$cs_n->id);
            $this->sumRowInExcel($worksheet,$row);
        };

        $file_xuat_name="File-nhap-dao-tao-nghe-thanh-nien ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");


    }

    public function exportData($listCoSoId,$fromDate,$toDate){

        $spreadsheet = IOFactory::load('file_excel/bm10/bm10.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];

        if(in_array('all',$listCoSoId)){
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')
            ->orderBy('loai_truong', 'asc')
            ->get();
        }else{
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')->whereIn('id', $listCoSoId)
            ->orderBy('loai_truong', 'asc')
            ->get();
        }

        $row=6;  
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        foreach($listCoSoDaoTao as $co_s){
        $row++;
        
            $dao_tao_cho_thanh_nien = $this->repository->getThanhNienTimeFromTo($co_s->id,$fromDate,$toDate);
            
            if ($co_s->loai_truong !== $bacDaoTaoId) {
                $bacDaoTaoId = $co_s->loai_truong;

                $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);
                  $worksheet->setCellValue('B' . $row, $bacDaoTao);

                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                $lockRange = "A{$row}:AE{$row}";
                $worksheet->getStyle($lockRange)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('C7C7C7');

                $worksheet->getStyle($lockRange)
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_PROTECTED);
            $row++;
          }
          
            $worksheet->setCellValue("B{$row}",'Trường: '.$co_s->ten.' - '.$co_s->id);
            $worksheet->getStyle("B{$row}")->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
            // tô nâu nền trường
            $worksheet->getStyle("A{$row}:AE{$row}")
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('C7C7C7');
            $soThuTu=0;
            foreach($dao_tao_cho_thanh_nien as $dtthanhnien){
                $row++;
                $soThuTu++;
                // border cac o
                foreach($arrayAphabe as $apha){
                    $worksheet->getStyle($apha.$row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
                }
                $worksheet->setCellValue('A'.$row,$soThuTu);
                // fill data
                $this->exportFillRow($worksheet, $row , $dtthanhnien);
                }
                
         }

         $ngayBatDau = date("d-m-Y", strtotime($fromDate));
         $ngayDen = date("d-m-Y", strtotime($toDate));
 
         $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
         $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-dao-tao-nghe-thanh-nien.xlsx";
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename='.$file_xuat_name);
         $writer->save("php://output");
    }

    // public function checkError($data,$arrayApha){
    //     $vitri=[];
    //     for($i =7; $i < count($data); $i++){ 
    //         $key_aphabel=-1;
    //            $rowNumber = $i+1; 
    //            for($j=2;$j <= 30;$j++){  
    //                  $key_aphabel++;
    //                    if( (is_string($data[$i][$j])) || ($data[$i][$j] < 0) ){
    //                    array_push($vitri,$arrayApha[$key_aphabel].$rowNumber);
    //                 }
    //            }
    //        }
    //        return $vitri;
    // }


    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();
        
        $truong = explode(' - ', $data[7][1]);
        $id_truong = trim(array_pop($truong));
        
        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];
        $csCheck = DB::table('co_so_dao_tao')->find($id_truong);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_truong);

        if($csCheck == null){
            $message='noCorrectIdTruong';
            return $message;  
        }

        $id_nghe_of_cs =[];
        foreach($co_so_nghe as $csn){
          array_push($id_nghe_of_cs,$csn->id);
        }

        $thanh_nien_da_co = $this->repository->getThanhNienCsNamDot($id_truong,$year,$dot);

        $id_nghe_tn_da_co=[];
        for($i=0;$i < count($thanh_nien_da_co); $i++){
            $id_nghe_tn_da_co[$thanh_nien_da_co[$i]->nghe_id] = $thanh_nien_da_co[$i]->id;
        }
        
        $vitri  = $this->checkError($data,$arrayApha,7,2,30);

        if(count($vitri) > 0 ){
                  $message='errorkitu';
                  return $message;  
         }

         $arrayData=[];
         $insertData=[];
         $updateData=[];
         $soDongNgNhap=(count($data) - 8);

         if($soDongNgNhap == count($co_so_nghe)){
             if($vitri == null || $vitri == ''){
                 for($i = 8; $i < count($data); $i++){ 

                    $nghe = explode(' - ', $data[$i][1]);
                    $id_nghe_nhap = array_pop($nghe);
                       if(in_array($id_nghe_nhap,$id_nghe_of_cs)){
                 
                         $arrayData=[
                             'nam'=>$year,
                             'dot'=>$dot,
                             'nghe_id'=>$id_nghe_nhap,
                             'co_so_id'=>$id_truong,

                             'thoi_gian_dao_tao'=>$data[$i][2],
                             'tong_tuyen_sinh'=>$data[$i][3],
                             'nu_tuyen_sinh'=>$data[$i][4],
                             'ho_khau_HN_tuyen_sinh'=>$data[$i][5],
                             'tong_tuyen_sinh_bo_doi_xuat_ngu'=>$data[$i][6],
                             'tuyen_sinh_bo_doi_nu'=>$data[$i][7],

                             'tuyen_sinh_bo_doi_ho_khau_HN'=>$data[$i][8],
                             'tong_tuyen_sinh_Ca'=>$data[$i][9],
                             'tuyen_sinh_ca_nu'=>$data[$i][10],
                             'tuyen_sinh_ca_ho_khau_HN'=>$data[$i][11],
 
                             'tong_tuyen_sinh_thanh_nien'=>$data[$i][12],
                             'tuyen_sinh_thanh_nien_nu'=>$data[$i][13],
                             'tuyen_sinh_thanh_nien_ho_khau_HN'=>$data[$i][14],
                             'tong_tot_nghiep'=>$data[$i][15],
                             'tong_tot_nghiep_nu'=>$data[$i][16],
                             'tong_tot_nghiep_ho_khau_HN'=>$data[$i][17],
 
                             'tong_tot_nghiep_bo_doi'=>$data[$i][18],
                             'tong_nghiep_bo_doi_nu'=>$data[$i][19],
                             'tong_nghiep_bo_doi_ho_khau_HN'=>$data[$i][20],
                             'tong_tot_nghiep_ca'=>$data[$i][21],
                             'tot_nghiep_ca_nu'=>$data[$i][22],
 
                             'tot_nghiep_ca_ho_khau_HN'=>$data[$i][23],
                             'tong_tot_nghiep_thanh_nien'=>$data[$i][24],
 
         
                             'tot_nghiep_thanh_nien_nu'=>$data[$i][25],
                             'tot_nghiep_thanh_nien_ho_khau_HN'=>$data[$i][26],
                             'tong_kinh_phi'=>$data[$i][27],

                             'ngan_sach_TW'=>$data[$i][28],
                             'ngan_sach_TP'=>$data[$i][29],
                             'ngan_sach_khac'=>$data[$i][30],
 
                         ];
                           if(array_key_exists($id_nghe_nhap,$id_nghe_tn_da_co)){
                             $updateData[$id_nghe_tn_da_co[$id_nghe_nhap]]=$arrayData;
                           }else{
                            $this->repository->createNgheThanhNien($arrayData);
                           }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message; 
                    };
 
                 }   
                 if (count($updateData) > 0) {
                 foreach($updateData as $key => $value)
                 $this->repository->updateNgheThanhNien($key,$value);
                    //  DB::table('ket_qua_dao_tao_cho_thanh_nien')->where('id',$key)->update($value);
                 }  
 
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Đào tạo nghề cho thanh niên';
                $tencoso = $thongTinCoSo->ten;
                $route = route('nhapbc.dao-tao-thanh-nien.show',['id' => $id_truong]);
                $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($insertData),count($updateData),$bm,$route,$tencoso);
                $message='ok';
                return $message;  
             }
         }else if($soDongNgNhap != count($co_so_nghe)){
             $message='NgheUnsign';
             return $message; 
         }
        
    }

    public function importError($fileRead,$duoiFile){

        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);

        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[7][1]);
           $id_truong = trim(array_pop($truong));

        $co_so = DB::table('co_so_dao_tao')->where('id',$id_truong)->first();
        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE'];

        $vitri  = $this->checkError($data,$arrayApha,7,2,30);

        $spreadsheet2 = IOFactory::load('file_excel/bm10/bm10.xlsx');
        $worksheet = $spreadsheet2->getActiveSheet();

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);
        // ghi Bac truong va ten truong tren cung
        $worksheet->setCellValue('B7', $bacDaoTao);
        $worksheet->setCellValue('B8', "Trường: $co_so->ten - $co_so->id");
        $worksheet->getStyle("B7")->getFont()->setBold(true);
        $worksheet->getStyle("B8")->getFont()->setBold(true);

        $worksheet->getStyle("A7:AE7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A8:AE8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);

        $worksheet->getColumnDimension('C')->setAutoSize(true);

        //  khóa lại không cho sửa
        $spreadsheet2->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet2->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['D','G','J','M','P','S','V','Y','AB','B'];
        $this->lockedCellInExcel($worksheet,$arrayLock);

        $stt=8;
        for($i = 8; $i < count($data); $i++){  
            $stt++;
            $worksheet->setCellValue('B'.$stt,$data[$i][1]);

            $keyApha = -1;
             for($j=2; $j <= 30 ;$j++){
                $keyApha++;
                $worksheet->setCellValue($arrayApha[$keyApha].$stt,$data[$i][$j]);
             }
             $this->sumRowInExcel($worksheet,$stt);
            $arrayLock2 =['B'.$stt];
            $this->lockedCellInExcel($worksheet,$arrayLock2);

        }

        for($i = 0; $i < count($vitri);$i++){
            $worksheet->getStyle($vitri[$i])
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
            // $worksheet->getStyle($vitri[$i])->applyFromArray($styleArray);
            //  màu ô
            $worksheet->getStyle($vitri[$i])->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF0000');
        }  

        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx"); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-dao-tao-nghe-thanh-nien.xlsx"');
        $writer->save("php://output");
    } 

}

 ?>