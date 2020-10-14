<?php

namespace App\Services;

use App\Repositories\KetQuaTotNghiepGanVoiDoanhNghiepRepository;
use App\Repositories\SoLieuTuyenSinhInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Storage;
use Carbon\Carbon;
use App\Repositories\CoSoDaoTaoRepositoryInterface;
use App\Services\StoreUpdateNotificationService;

class KetQuaTotNghiepGanVoiDoanhNGhiepService extends AppService
{   

    protected $SoLieuTuyenSinhInterface;
    protected $CoSoDaoTaoRepository;
    protected $StoreUpdateNotificationService;
    use ExcelTraitService;

    public function __construct(
        SoLieuTuyenSinhInterface $soLieuTuyenSinhRepository,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao,
        StoreUpdateNotificationService $StoreUpdateNotificationService

    ) {
        parent::__construct();
        $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
    }


    public function getRepository()
    {
        return KetQuaTotNghiepGanVoiDoanhNghiepRepository::class;
    }
    public function getKetQuaTotNghiepGanVoiDoanhNghiep($params = [], $limit)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        return $this->repository->getKetQuaTotNghiepGanVoiDoanhNghiep($queryData, $limit);
    }

    public function getTenQuanHuyen()
    {
        return $this->repository->getTenQuanHuyen();
    }
    public function getXaPhuongTheoQuanHuyen($id)
    {
        return  $this->repository->getXaPhuongTheoQuanHuyen($id);
    }
    public function getCoSo()
    {
        return $this->repository->getCoSo();
    }
    public function getNganhNghe($ma_cap_nghe)
    {
        return $this->repository->getNganhNghe($ma_cap_nghe);
    }

    public function getNgheTheoCapBac($id, $cap_nghe)
    {
        return $this->repository->getNgheTheoCapBac($id, $cap_nghe);
    }

    public function getLoaiHinhCoSo()
    {
        return $this->repository->getLoaiHinhCoSo();
    }

    public function ChiTietKetQuaTotNghiepGanVoiDoanhNghiep($co_so_id, $params, $limit)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $data = $this->repository->ChiTietKetQuaTotNghiepGanVoiDoanhNghiep($co_so_id, $queryData, $limit);
        return $data;
    }
    public function findCoSoDaoTao($co_so_id)
    {
        return $this->repository->findCoSoDaoTao($co_so_id);
    }

    public function SuaKetQuaTotNghiepGanVoiDoanhNghiep($id)
    {
        $data = $this->repository->SuaKetQuaTotNghiepGanVoiDoanhNghiep($id);
        return $data;
    }

    public function PostKetQuaTotNghiepGanVoiDoanhNghiep($getdata)
    {
        unset($getdata['_token']);
        $dateTime = Carbon::now();
        $getdata['thoi_gian_cap_nhat'] = $dateTime->format('Y-m-d H:i:s');
        
        $data = $this->repository->PostKetQuaTotNghiepGanVoiDoanhNghiep($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu kết quả tốt nghiệp gắn với doanh nghiệp';
            $route = route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }


    public function getCheckTonTai($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token']);
        $route = route('xuatbc.them-ket-qua-tot-nghiep-voi-doanh-nghiep');
        if ($checkResult == 'tontai') {
            $message = 'Số liệu đã tồn tại !';
        }
        if (!isset($checkResult)) {
            $data = $this->PostKetQuaTotNghiepGanVoiDoanhNghiep($requestParams);
            $message = 'Thêm số liệu thành công';
            $route = route('xuatbc.ket-qua-tot-nghiep-voi-doanh-nghiep');
        }
        return ['route' => $route, 'message' => $message,];
    }
    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->CheckTonTai($dataCheckNew);
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

    public function updateData($id,$request)
    {
        $attributes = $request->all();
        $findata = $this->repository->findById($id);
        $getdata=(array)$findata;
        unset($attributes['_token']);
        $resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Cập nhật số liệu kết quả tốt nghiệp gắn với doanh nghiệp';
			$route = route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }


     // thanh 6/22/2020

     public function exportFillRow($worksheet, $row, $totnghiepvsdoanhnghiep){
        $worksheet->setCellValue('B'.$row, $totnghiepvsdoanhnghiep->ten_nganh_nghe.' - '.$totnghiepvsdoanhnghiep->nghe_id);
        $worksheet->setCellValue('C'.$row, $totnghiepvsdoanhnghiep->tong_HSSV_tot_nghiep);
        $worksheet->setCellValue('D'.$row, $totnghiepvsdoanhnghiep->nhap_hoc_dau_tot_nghiep_CD);
        $worksheet->setCellValue('E'.$row, $totnghiepvsdoanhnghiep->tot_nghiep_CD);
        $worksheet->setCellValue('F'.$row, $totnghiepvsdoanhnghiep->nhap_hoc_dau_tot_nghiep_TC);
        $worksheet->setCellValue('G'.$row, $totnghiepvsdoanhnghiep->tot_nghiep_TC);
        $worksheet->setCellValue('H'.$row, $totnghiepvsdoanhnghiep->nhap_hoc_dau_tot_nghiep_SC);
        $worksheet->setCellValue('I'.$row, $totnghiepvsdoanhnghiep->tot_nghiep_SC);
        $worksheet->setCellValue('J'.$row, $totnghiepvsdoanhnghiep->duoi_3_thang_tot_nghiep_nhap_hoc_dau);
        $worksheet->setCellValue('K'.$row, $totnghiepvsdoanhnghiep->duoi_3_thang_tot_nghiep);
        $worksheet->setCellValue('L'.$row, $totnghiepvsdoanhnghiep->ten_doanh_nghiep);
        $worksheet->setCellValue('M'.$row, $totnghiepvsdoanhnghiep->so_HSSV_duoc_tuyen_dung);
        $worksheet->setCellValue('N'.$row, $totnghiepvsdoanhnghiep->muc_luong_doanh_nghiep_tra);
    }

    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm15/bm15.xlsx');

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', "Trường: $co_so->ten - $id_coso");
        
        $worksheet->getStyle("A1")->getFont()->setBold(true);
    
        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);
        
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['A','B','C'];
        $this->lockedCellInExcel($worksheet,$arrayLock);

        $row=7;
        $sothuTu=0;
        foreach($co_so_nghe as $cs_n){
           $row ++;
           $sothuTu++;
           $worksheet->setCellValue('A'.$row,$sothuTu);
            $worksheet->setCellValue('B'.$row, $cs_n->ten_nganh_nghe.' - '.$cs_n->id);
            $worksheet->setCellValue("C{$row}", "=SUM(D{$row}:K{$row})");

        
        };

         $worksheet
        ->getStyle('N')
        ->getNumberFormat()
        ->setFormatCode('###,###,###');

        $file_xuat_name="File-nhap-tot-nghiep-doanh-nghiep ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }

    public function exportData($id_truong,$fromDate,$toDate){

        $spreadsheet = IOFactory::load('file_excel/bm15/bm15.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
    
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
    
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);
    
        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
    
        $co_so =  DB::table('co_so_dao_tao')->where('id', $id_truong)
        ->orderBy('loai_truong', 'asc')
        ->first();

        $worksheet
        ->getStyle('N')
        ->getNumberFormat()
        ->setFormatCode('###,###,###');
    
        $row=7;  
        $dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co = $this->repository->getTotNghiepDaoTaoDoanhNghiepTimeFromTo($id_truong,$fromDate,$toDate);
        $sothuTu=0;
        $worksheet->setCellValue('A1', $co_so->ten.' - '.$co_so->id);
        foreach($dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co as $dttn_dn){
        $row++;
        foreach($arrayAphabe as $apha){
            $worksheet->getStyle($apha.$row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        }
        $sothuTu++;
        // fill data
        $worksheet->setCellValue('A'.$row,$sothuTu);
        $this->exportFillRow($worksheet, $row , $dttn_dn);
        }
         
        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-tot-nghiep-doanh-nghiep.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }
    

    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();
        
        $truong = explode(' - ', $data[0][0]);
        $id_truong = trim(array_pop($truong));


        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N'];

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

        $dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co = $this->repository->getTotNghiepDaoTaoDoanhNghiepCsNamDot($id_truong,$year,$dot);

        $id_nghe_dttndn_gan_dn_da_co=[];
        for($i=0;$i < count($dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co); $i++){
            $id_nghe_dttndn_gan_dn_da_co[$dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co[$i]->nghe_id] = $dao_tao_totnghiep_gan_voi_doanh_nghiep_da_co[$i]->id;
        }
        $vitri=[];
        for($i = 7 ; $i < count($data); $i++){ 
            $key_aphabel=-1;
               $rowNumber = $i+1; 
               for($j=  2 ; $j <= 13 ; $j++){  
                     $key_aphabel++;
                     if($j != 11){
                        if( is_string($data[$i][$j]) || $data[$i][$j] < 0){
                        array_push($vitri,$arrayApha[$key_aphabel].$rowNumber);
                        }
                     }
                      
               }
        }

        if(count($vitri) > 0 ){
                $message='errorkitu';
                return $message;  
        }
        $arrayData=[];
        $insertData=[];
        $updateData=[];
        $soDongNgNhap=(count($data) - 7);

        if($soDongNgNhap == count($co_so_nghe)){
            if($vitri == null || $vitri == ''){
                for($i = 7; $i < count($data); $i++){ 

                    $nghe = explode(' - ', $data[$i][1]);
                    $id_nghe_nhap = array_pop($nghe);
                
                    if(in_array($id_nghe_nhap,$id_nghe_of_cs)){
                        $arrayData=[
                            'nam'=>$year,
                            'dot'=>$dot,
                            'nghe_id'=>$id_nghe_nhap,
                            'co_so_id'=>$id_truong,

                            'tong_HSSV_tot_nghiep'=>$data[$i][2],
                            'nhap_hoc_dau_tot_nghiep_CD'=>$data[$i][3],
                            'tot_nghiep_CD'=>$data[$i][4],
                            'nhap_hoc_dau_tot_nghiep_TC'=>$data[$i][5],
                            'tot_nghiep_TC'=>$data[$i][6],
                            'nhap_hoc_dau_tot_nghiep_SC'=>$data[$i][7],
                            'tot_nghiep_SC'=>$data[$i][8],

                            'duoi_3_thang_tot_nghiep_nhap_hoc_dau'=>$data[$i][9],
                            'duoi_3_thang_tot_nghiep'=>$data[$i][10],
                            'ten_doanh_nghiep'=>$data[$i][11],
                            'so_HSSV_duoc_tuyen_dung'=>$data[$i][12],
                            'muc_luong_doanh_nghiep_tra'=>$data[$i][13],
                        ];
                        if(array_key_exists($id_nghe_nhap,$id_nghe_dttndn_gan_dn_da_co)){
                            $updateData[$id_nghe_dttndn_gan_dn_da_co[$id_nghe_nhap]]=$arrayData;
                        }else{
                            $this->repository->createTotNghiepVoiDoanhNghiep($arrayData);
                        }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message; 
                    };

                } 
                // dd($updateData);  
                if (count($updateData) > 0) {
                foreach($updateData as $key => $value)
                    $this->repository->updateTotNghiepVoiDoanhNghiep($key,$value);
                }  
             

                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Kết quả tốt nghiệp gắn với doanh nghiệp';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.chi-tiet-ket-qua-tot-nghiep-voi-doanh-nghiep', ['co_so_id' => $id_truong]);
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

        $truong = explode(' - ', $data[0][0]);
        $id_truong = trim(array_pop($truong));


        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N'];

        $vitri=[];
        for($i = 7 ; $i < count($data); $i++){ 
            $key_aphabel=-1;
            $rowNumber = $i+1; 
            for($j=  2 ; $j <= 13 ; $j++){  
                    $key_aphabel++;
                    if($j != 11){
                        if( is_string($data[$i][$j]) || $data[$i][$j] < 0 ){
                        array_push($vitri,$arrayApha[$key_aphabel].$rowNumber);
                        }
                    }
            }
        }
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
        header('Content-Disposition: attachment; filename="Error-file-nhap-tot-nghiep-doanh-nghiep.xlsx"');
        $writer->save("php://output");
    } 

}
