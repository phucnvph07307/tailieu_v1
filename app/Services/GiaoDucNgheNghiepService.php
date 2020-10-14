<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\GiaoDucNgheNghiepRepository;
use App\Repositories\LoaiHinhCoSoRepositoryInterface;
use App\Repositories\SoLieuTuyenSinhInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Carbon\Carbon;
use Storage;
use App\Services\StoreUpdateNotificationService;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class GiaoDucNgheNghiepService extends AppService
{
    use ExcelTraitService;
    protected $LoaiHinhCoSoRepositoryInterface;
    protected $soLieuTuyenSinhInterRepository;
    protected $CoSoDaoTaoRepository;

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

    public function getRepository()
    {
        return GiaoDucNgheNghiepRepository::class;
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
        $queryData['nghe_cap_2'] = isset($params['nghe_cap_2']) ? $params['nghe_cap_2'] : null;

        if (isset($params['nghe_cap_3'])){
            $queryData['nghe_cap_2']=null;
            $queryData['nghe_cap_3']=$params['nghe_cap_3'];
        }else{
            $queryData['nghe_cap_3']=null;
        }

        if (isset($params['nghe_cap_4'])){
            $queryData['nghe_cap_2']=null;
            $queryData['nghe_cap_3']=null;
            $queryData['nghe_cap_4']=$params['nghe_cap_4'];
        }else{
            $queryData['nghe_cap_4']=null;
        }
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

    public function edit($id)
    {
        return $this->repository->edit($id);
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
			$noidung = 'Cập nhật số liệu giáo dục nghề nghiệp';
			$route = route('xuatbc.quan-ly-giao-duc-nghe-nghiep');
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
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
            $noidung = 'Thêm mới số liệu giáo dục nghề nghiệp';
            $route = route('xuatbc.quan-ly-giao-duc-nghe-nghiep');
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }

    public function getCheckTonTaiGiaoDucNgheNghiep($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token']);
        $route = route('xuatbc.quan-ly-giao-duc-nghe-nghiep.create');
        $message = $checkResult == 'tontai' ?
            'Số liệu đã tồn tại và được phê duyệt' :
            'Số liệu đã tồn tại';
        
        if (!isset($checkResult)) {
            $data = $this->store($requestParams);
            $message = 'Thêm số liệu thành công';
            $route = route('xuatbc.quan-ly-giao-duc-nghe-nghiep');
        }

        return [
            'route' => $route,
            'message' => $message,
        ];
    }

    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->getCheckTonTaiGiaoDucNgheNghiep($dataCheckNew);
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

    // thanhnv 6/23/2020 


    public function exportFillRow($worksheet, $row, $tnien){
        $worksheet->setCellValue('M'.$row, $tnien->ten_nganh_nghe.' - '.$tnien->nghe_id);
        $worksheet->setCellValue('N'.$row, $tnien->ma_cap_2);
        $worksheet->setCellValue('O'.$row, $tnien->quy_mo_tuyen_sinh_TC);
        $worksheet->setCellValue('P'.$row, $tnien->quy_mo_tuyen_sinh_SC);
    }

    public function formatCenter($worksheet,$array,$row){
        foreach($array as $value){
            $worksheet->getStyle($value.$row)->getAlignment()->setHorizontal('center');
            $worksheet->getStyle("{$value}{$row}")->getAlignment()->setVertical('center');
            $worksheet->getStyle("{$value}{$row}")->getFont()->setBold(true);
        }
    }

    
    public function formartMargeing($worksheet,$array,$startGop,$row){
        foreach($array as $value){
            $worksheet->mergeCells("{$value}{$startGop}:{$value}{$row}");
        }
    }

    public function exportBieuMau($id_coso){

        $co_so = $this->repository->getOnlyOneCsJoinChuQuanVaDangKyGiay($id_coso);
        $co_so_loai = DB::table('co_so_dao_tao')->where('id',$id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm1/bm1.xlsx');
        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so_loai->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('B5', $bacDaoTao);
        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P'];

        $arrayCenter = ['B','C','D','E','F','G','H','I','J','K'];
        
        $worksheet->getStyle("B5")->getFont()->setBold(true);
        $worksheet->getStyle("B6")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A5:P5")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);
        
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['A','B','C','D','E','F','G','H','I','J','K','L','M'];
        $this->lockedCellInExcel($worksheet,$arrayLock);

        $loai_hinh ='';
        switch ($co_so_loai->ma_loai_hinh_co_so) {
            case 4:
                $loai_hinh = 'D';
                break;
            case 9:
                $loai_hinh = 'E';
                break;
            case 14:
                $loai_hinh = 'F';
                break;
            case 15:
                $loai_hinh = 'D';
                break;
        } 

        $row=5;
        $soThuTu=0;
        $loop=0;
        if($co_so != null){
            foreach($co_so_nghe as $cs_n){
                $soThuTu++;
                $row ++;
                $loop++;
                if ($loop==1){
                    $startGop=$row;
                    $worksheet->setCellValue("B{$row}",'Trường: '.$co_so->ten.' - '.$co_so->id);
                    $worksheet->setCellValue('G'.$row, $co_so->quyet_dinh);
                    $worksheet->setCellValue('H'.$row, $co_so->so_ngay_thang_nam_cap_dia_diem_dao_tao);
                    $worksheet->setCellValue("C{$row}",$co_so->ten_chu_quan);
                    $worksheet->setCellValue($loai_hinh.$row,'X');
                    
                    if($co_so->giay_chung_nhan_id == 1){
                        $worksheet->setCellValue('I'.$row,'X');
                    }else if($co_so->giay_chung_nhan_id == 2){
                        $worksheet->setCellValue('J'.$row,'X');
                    }else if($co_so->giay_chung_nhan_id == 3){
                        $worksheet->setCellValue('K'.$row,'X');
                    }
                    $this->formatCenter($worksheet,$arrayCenter,$row);
                }
                foreach($arrayAphabe as $apha){
                    $worksheet->getStyle($apha.$row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
                }
                $worksheet->setCellValue('M'.$row, $cs_n->ten_nganh_nghe.' - '.$cs_n->id);
                // stt
                $worksheet->setCellValue("L{$row}",$soThuTu);
            };

            $worksheet->getColumnDimension('B')->setAutoSize(true);
            $worksheet->getColumnDimension('M')->setAutoSize(true);
            $worksheet->getColumnDimension('C')->setAutoSize(true);
            
            if(count($co_so_nghe) > 0){
                $this->formartMargeing($worksheet,$arrayCenter,$startGop,$row);
            }
     }

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-nhap-giao-duc-nghe-nghiep.xlsx"');
        $writer->save("php://output");


    }

    public function exportData($listCoSoId,$fromDate,$toDate){
        $spreadsheet = IOFactory::load('file_excel/bm1/bm1.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P'];

        if(in_array('all',$listCoSoId)){
            $listCoSoDaoTao =  $this->repository->getAllCsJoinChuQuanVaDangKyGiay();
        }else{
            $listCoSoDaoTao = $this->repository->getSomeCsJoinChuQuanVaDangKyGiay($listCoSoId);
        }

        $row=4;  
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        $arrayCenter = ['B','C','D','E','F','G','H','I','J','K'];
        foreach($listCoSoDaoTao as $co_s){
            $row++;
            $thong_tin_dang_ky = $this->repository->getThongTinDangKyTimeFromTo($co_s->id,$fromDate,$toDate);

            if ($co_s->loai_truong !== $bacDaoTaoId) {
                $bacDaoTaoId = $co_s->loai_truong;

                $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);
                $worksheet->setCellValue('B'.$row, $bacDaoTao);
                $worksheet->getStyle("A{$row}:P{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                $row++;

            }

            $loai_hinh ='';
            switch ($co_s->ma_loai_hinh_co_so) {
                case 4:
                    $loai_hinh = 'D';
                    break;
                case 9:
                    $loai_hinh = 'E';
                    break;
                case 14:
                    $loai_hinh = 'F';
                    break;
                case 15:
                    $loai_hinh = 'D';
                    break;
            } 
            $worksheet->getStyle("B{$row}")->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
            // tô nâu nền trường
            $soThuTu=0;
            $loop=0;
            foreach($thong_tin_dang_ky as $ttdk){
                $soThuTu++;
                $row++;
                $loop++;
                if ($loop==1){
                    $startGop=$row;
                    $worksheet->setCellValue("B{$row}",'Trường: '.$co_s->ten.' - '.$co_s->id);
                    $worksheet->setCellValue('G'.$row, $co_s->quyet_dinh);
                    $worksheet->setCellValue('H'.$row, $co_s->so_ngay_thang_nam_cap_dia_diem_dao_tao);
                    $worksheet->setCellValue("C{$row}",$co_s->ten_chu_quan);
                    $worksheet->setCellValue($loai_hinh.$row,'X');
                      
                    if($co_s->giay_chung_nhan_id == 1){
                        $worksheet->setCellValue('I'.$row,'X');
                    }else if($co_s->giay_chung_nhan_id == 2){
                        $worksheet->setCellValue('J'.$row,'X');
                    }else if($co_s->giay_chung_nhan_id == 3){
                        $worksheet->setCellValue('K'.$row,'X');
                    }
                    $this->formatCenter($worksheet,$arrayCenter,$row);
                    
                }
                // border cac o
                foreach($arrayAphabe as $apha){
                    $worksheet->getStyle($apha.$row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
                }
                // stt
                $worksheet->setCellValue("L{$row}",$soThuTu);
                // fill data
                $this->exportFillRow($worksheet, $row , $ttdk);
            }
            if(count($thong_tin_dang_ky) > 0){
                  $this->formartMargeing($worksheet,$arrayCenter,$startGop,$row);
            }
          
         }
         $ngayBatDau = date("d-m-Y", strtotime($fromDate));
         $ngayDen = date("d-m-Y", strtotime($toDate));
 
         $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
         $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-giao-duc-nghe-nghiep.xlsx";
         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename='.$file_xuat_name);
         $writer->save("php://output");
    }

  

    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[5][1]);
        $id_truong = trim(array_pop($truong));


        $arrayApha=['N','O','P'];
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

        $thong_tin_dang_ky_da_co = $this->repository->getGiaoDucNgheNghiepCsNamDot($id_truong,$year,$dot);

        $id_nghe_ttdk_da_co=[];
        for($i=0;$i < count($thong_tin_dang_ky_da_co); $i++){
            $id_nghe_ttdk_da_co[$thong_tin_dang_ky_da_co[$i]->nghe_id] = $thong_tin_dang_ky_da_co[$i]->id;
        }
        
        $vitri  = $this->checkError($data,$arrayApha,6,13,15);

        if(count($vitri) > 0 ){
                  $message='errorkitu';
                  return $message;  
         }

         $arrayData=[];
         $insertData=[];
         $updateData=[];
         $soDongNgNhap=(count($data) - 5);
         if($soDongNgNhap == count($co_so_nghe)){
             if($vitri == null || $vitri == ''){
                 for($i = 6 ;$i < count($data); $i++){ 
                    $nghe = explode(' - ', $data[$i][12]);
                    $id_nghe_nhap = array_pop($nghe);
                       if(in_array($id_nghe_nhap,$id_nghe_of_cs)){
                         $arrayData=[
                             'nam'=>$year,
                             'dot'=>$dot,
                             'nghe_id'=>$id_nghe_nhap,
                             'co_so_id'=>$id_truong,
                             'ma_cap_2'=>$data[$i][13],
                             'quy_mo_tuyen_sinh_TC'=>$data[$i][14],
                             'quy_mo_tuyen_sinh_SC'=>$data[$i][15],
                         ];
                           if(array_key_exists($id_nghe_nhap,$id_nghe_ttdk_da_co)){
                             $updateData[$id_nghe_ttdk_da_co[$id_nghe_nhap]]=$arrayData;
                           }else{
                             array_push($insertData,$arrayData); 
                           }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message; 
                    };
 
                 }   
                 if (count($updateData) > 0) {
                 foreach($updateData as $key => $value)
                     DB::table('thong_tin_dang_ky')->where('id',$key)->update($value);
                 }  
 
                 if (count($insertData) > 0) {
                     DB::table('thong_tin_dang_ky')->insert($insertData);
                 }   
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Đào tạo giáo dục nghề nghiệp';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.quan-ly-giao-duc-nghe-nghiep');
                $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($insertData),count($updateData),$bm,$route,$tencoso);
                  $message='ok';
                  return $message;  
             }
         }else if($soDongNgNhap != count($co_so_nghe)){
             $message='NgheUnsign';
             return $message; 
         }
        
    }

    public function importError($fileRead,$duoiFile,$path){
        $fileReadStorage= storage_path('app/public/'.$path);
      
        $spreadsheet = $this->createSpreadSheet($fileReadStorage,$duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $arrayAphabe=['N','O','P'];
        $vitri = $this->checkError($data, $arrayAphabe, 6,13,15);

        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);

        for($i = 0; $i < count($vitri);$i++){
            $worksheet->getStyle($vitri[$i])
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
            //  màu ô
            $worksheet->getStyle($vitri[$i])->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF0000');
        }  

        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx"); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-giao-duc-nghe-nghiep.xlsx"');
        $writer->save("php://output");
    } 
}

 ?>