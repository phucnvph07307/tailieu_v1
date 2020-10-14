<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\DaoTaoNgheVoiDoanhNghiepRepository;
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

class DaoTaoNgheVoiDoanhNghiepService extends AppService
{
    protected $LoaiHinhCoSoRepositoryInterface;
    protected $DaoTaoNgheChoThanhNienReponsitory;
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

    public function getRepository()
    {
        return DaoTaoNgheVoiDoanhNghiepRepository::class;
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

        if(isset($params['nghe_cap_3'])){
            $queryData['nghe_cap_2']=null;
            $queryData['nghe_cap_3']=$params['nghe_cap_3'];
        }else{
            $queryData['nghe_cap_3']=null;
        }

        if(isset($params['nghe_cap_4'])){
            $queryData['nghe_cap_2']=null;
            $queryData['nghe_cap_3']=null;
            $queryData['nghe_cap_4']=$params['nghe_cap_4'];
        }else{
            $queryData['nghe_cap_4']=null;
        }
        // dd($queryData);
        $data = $this->repository->index($queryData, $limit);

        return $data;
    }
    // quảng - 22/6 lấy tên cở sở đào tạo
    public function getTenCoSoDaoTao()
    {
        return $this->repository->getTenCoSoDaoTao();
    }

     // quảng - 22/6 lấy  cơ sở theo loại hình
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

     // quảng - 22/6 lấy tất cả ngành nghề theo từng cấp bậc
     public function getNganhNghe($ma_cap_nghe)
     {
         return  $this->repository->getNganhNghe($ma_cap_nghe);
     }

     // quảng - 22/6  lọc ngành nghề theo từng cấp bậc
     public function getNgheTheoCapBac($id, $cap_nghe)
     {
         return  $this->repository->getNgheTheoCapBac($id, $cap_nghe);
     }

     public function getThongTinCoSo($coSoId)
     {
        return $this->CoSoDaoTaoRepository->getThongTinCoSo($coSoId);
     }

     public function show($coSoId, $limit, $params)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $data = $this->repository->show($coSoId, $limit, $queryData);
        return $data;
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }
    public function updateData($id, $request)
    {
        $attributes = $request->all();
        unset($attributes['_token'],$attributes['files']);
        $resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
			$noidung = 'Cập nhật số liệu đạo tạo nghề với doanh nghiệp';
			$route = route('xuatbc.dao-tao-nghe-doanh-nghiep.show',['id' => $getdata['co_so_id']]);
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
            $noidung = 'Thêm mới số liệu đào tạo nghề với doanh nghiệp';
            $route = route('xuatbc.dao-tao-nghe-doanh-nghiep.show',['id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }

    public function getCheckTonTaiDaoTaoGanVoiDoanhNghiep($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token'],$requestParams['files']);
        $route = route('xuatbc.dao-tao-nghe-doanh-nghiep.create');
        $message = $checkResult == 'tontai' ?
            'Số liệu đã tồn tại và được phê duyệt' :
            'Số liệu đã tồn tại';

        if (!isset($checkResult)) {
            $data = $this->store($requestParams);
            $message = 'Thêm số liệu  thành công';
            $route = route('xuatbc.dao-tao-nghe-doanh-nghiep.show', [
                'id' => $requestParams['co_so_id'],
            ]);
        }

        return [
            'route' => $route,
            'message' => $message,
        ];
    }

    
    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->getCheckTonTaiDaoTaoGanVoiDoanhNghiep($dataCheckNew);
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

    // thanh 6/22/2020
    public function exportFillRow($worksheet, $row, $tnien){
        $worksheet->setCellValue('B'.$row, $tnien->ten_nganh_nghe.' - '.$tnien->nghe_id);
        $worksheet->setCellValue('C'.$row, $tnien->tong_so);
        $worksheet->setCellValue('D'.$row, $tnien->ket_qua_CD);
        $worksheet->setCellValue('E'.$row, $tnien->ket_qua_TC);
        $worksheet->setCellValue('F'.$row, $tnien->ket_qua_SC);
        $worksheet->setCellValue('G'.$row, $tnien->ket_qua_duoi_3_thang);
        $worksheet->setCellValue('H'.$row, $tnien->ten_doanh_nghiep);
        $worksheet->setCellValue('I'.$row, $tnien->so_HSSV_duoc_cam_ket);
        $worksheet->setCellValue('J'.$row, $tnien->doanh_nghiep_xay_dung_chuong_trinh);
        $worksheet->setCellValue('K'.$row, $tnien->doanh_nghiep_tham_gia_giang_day);
        $worksheet->setCellValue('L'.$row, $tnien->doanh_nghiep_bo_tro_trang_thiet_bi);
        $worksheet->setCellValue('M'.$row, $tnien->doanh_nghiep_ho_tro_kinh_phi_dao_tao);
        $worksheet->setCellValue('N'.$row, $tnien->doanh_nghiep_dat_hang_dao_tao);
        $worksheet->setCellValue('O'.$row, $tnien->doanh_nghiep_tiep_nhan_HSSV_thuc_tap);
        $worksheet->setCellValue('P'.$row, $tnien->khac);
    }

    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm14/bm14.xlsx');

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', "Trường: $co_so->ten - $id_coso");

        $worksheet->getStyle("A1")->getFont()->setBold(true);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['A','B','C'];
        $this->lockedCellInExcel($worksheet,$arrayLock);

        $row=7;
        $soThuTu=0;
        foreach($co_so_nghe as $cs_n){
            $soThuTu++;
            $row ++;
            $worksheet->setCellValue("A{$row}", $soThuTu);
            $worksheet->setCellValue('B'.$row, $cs_n->ten_nganh_nghe.' - '.$cs_n->id);
            $worksheet->setCellValue("C{$row}", "=SUM(D{$row}:G{$row})");
        };

        $file_xuat_name="File-nhap-dao-tao-tuyen-sinh-doanh-nghiep ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
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


        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N','O','P'];

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

        $dao_tao_tuyensinh_gan_voi_doanh_nghiep_da_co = $this->repository->getTuyenSinhDaoTaoDoanhNghiepCsNamDot($id_truong,$year,$dot);

        $id_nghe_dtts_gan_dn_da_co=[];
        for($i=0;$i < count($dao_tao_tuyensinh_gan_voi_doanh_nghiep_da_co); $i++){
            $id_nghe_dtts_gan_dn_da_co[$dao_tao_tuyensinh_gan_voi_doanh_nghiep_da_co[$i]->nghe_id] = $dao_tao_tuyensinh_gan_voi_doanh_nghiep_da_co[$i]->id;
        }

        $vitri=[];
        for($i = 7 ; $i < count($data); $i++){
            $key_aphabel=-1;
               $rowNumber = $i+1;
               for($j=  2 ; $j <= 15 ; $j++){
                     $key_aphabel++;
                     if($j != 15 && $j !=7 ){
                        if( is_string($data[$i][$j]) || $data[$i][$j] < 0 ){
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

                            'tong_so'=>$data[$i][2],
                            'ket_qua_CD'=>$data[$i][3],
                            'ket_qua_TC'=>$data[$i][4],
                            'ket_qua_SC'=>$data[$i][5],
                            'ket_qua_duoi_3_thang'=>$data[$i][6],
                            'ten_doanh_nghiep'=>$data[$i][7],
                            'so_HSSV_duoc_cam_ket'=>$data[$i][8],

                            'doanh_nghiep_xay_dung_chuong_trinh'=>$data[$i][9],
                            'doanh_nghiep_tham_gia_giang_day'=>$data[$i][10],
                            'doanh_nghiep_bo_tro_trang_thiet_bi'=>$data[$i][11],
                            'doanh_nghiep_ho_tro_kinh_phi_dao_tao'=>$data[$i][12],
                            'doanh_nghiep_dat_hang_dao_tao'=>$data[$i][13],
                            'doanh_nghiep_tiep_nhan_HSSV_thuc_tap'=>$data[$i][14],
                            'khac'=>$data[$i][15],

                        ];
                        if(array_key_exists($id_nghe_nhap,$id_nghe_dtts_gan_dn_da_co)){
                            $updateData[$id_nghe_dtts_gan_dn_da_co[$id_nghe_nhap]]=$arrayData;
                        }else{
                             $this->repository->createNgheVoiDoanhNghiep($arrayData);
                        }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message;
                    };

                }
                //    dd($updateData,$insertData);
                if (count($updateData) > 0) {
                foreach($updateData as $key => $value)
                    //  DB::table('ket_qua_tuyen_sinh_gan_voi_doanh_nghiep')->where('id',$key)->update($value);
                    $this->repository->updateNgheVoiDoanhNghiep($key,$value);
                }
         
                
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Đào tạo nghề với doanh nghiệp';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.dao-tao-nghe-doanh-nghiep.show',['id' => $id_truong]);
                $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($insertData),count($updateData),$bm,$route,$tencoso);
                $message='ok';
                return $message;
            }
        }else if($soDongNgNhap != count($co_so_nghe)){
            $message='NgheUnsign';
            return $message;
        }

}


    public function importError($fileRead,$duoiFile,$path)
    {
        $fileReadStorage= storage_path('app/public/'.$path);

        $spreadsheet = $this->createSpreadSheet($fileReadStorage,$duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[0][0]);
        $id_truong = trim(array_pop($truong));

        $arrayApha=['C','D','E','F','G','H','I','J','K','L','M','N','O','P'];

        $vitri=[];
        for($i = 7 ; $i < count($data); $i++){
            $key_aphabel=-1;
            $rowNumber = $i+1;
            for($j=  2 ; $j <= 15 ; $j++){
                    $key_aphabel++;
                    if($j != 15 && $j !=7 ){
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
        header('Content-Disposition: attachment; filename="Error-file-nhap-dao-tao-tuyen-sinh-doanh-nghiep.xlsx"');
        $writer->save("php://output");
    }

    public function exportData($listCoSoId,$fromDate,$toDate){

        $spreadsheet = IOFactory::load('file_excel/bm14/bm14.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);

        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P'];

        $co_so =  DB::table('co_so_dao_tao')->where('id', $listCoSoId)
        ->orderBy('loai_truong', 'asc')
        ->first();

        $row=7;
        $dao_tao_tuyensinh_doanhnghiep = $this->repository->getTuyenSinhDaoTaoDoanhNghiepTimeFromTo($listCoSoId,$fromDate,$toDate);
        $sothuTu=0;
        $worksheet->setCellValue('A1', $co_so->ten.' - '.$co_so->id);
        foreach($dao_tao_tuyensinh_doanhnghiep as $dtts_dn){
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
        $this->exportFillRow($worksheet, $row , $dtts_dn);
        }
        
        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-dao-tao-tuyen-sinh-doanh-nghiep.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }

}
