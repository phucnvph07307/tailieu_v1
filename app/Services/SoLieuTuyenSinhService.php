<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Services\StoreUpdateNotificationService;
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
use Auth;
use Storage;
use App\Repositories\CoSoDaoTaoRepositoryInterface;


class SoLieuTuyenSinhService extends AppService
{
    protected $loaiHinhCoSoRepository;
    protected $soLieuTuyenSinhRepository;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;
    use ExcelTraitService;

    public function __construct(
        LoaiHinhCoSoRepositoryInterface $loaiHinhCoSoRepository,
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->loaiHinhCoSoRepository = $loaiHinhCoSoRepository;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
        // $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
    }

    //Lay Repository Product
    public function getRepository()
    {
        return SoLieuTuyenSinhRepository::class;
    }

    public function getListLoaiHinh()
    {
        return $this->loaiHinhCoSoRepository->getAll();
    }

    public function getSoLuongTuyenSinh($params = [], $limit)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['devvn_xaphuongthitran'] = isset($params['devvn_xaphuongthitran']) ? $params['devvn_xaphuongthitran'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        $data = $this->repository->getSoLuongTuyenSinh($queryData, $limit);

        return $data;
    }

    public function getChiTietSoLuongTuyenSinh($coSoId, $limit, $params)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $data = $this->repository->getChiTietSoLuongTuyenSinh($coSoId, $limit, $queryData);
        return $data;
    }
    public function getTenCoSoDaoTao()
    {
        return $this->repository->getTenCoSoDaoTao();
    }

    public function getmanganhnghe($id)
    {
        $data = $this->repository->getmanganhnghe($id);
        return $data;
    }

    public function postthemsolieutuyensinh($getdata)
    {
        unset($getdata['_token']);
        $dateTime = Carbon::now();
        $getdata['thoi_gian_cap_nhat'] = $dateTime->format('Y-m-d H:i:s');
        
        $data = $this->repository->postthemsolieutuyensinh($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu tuyển sinh';
            $route = route('chitietsolieutuyensinh',['co_so_id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }

    public function getsuasolieutuyensinh($id)
    {
        return  $this->repository->getsuasolieutuyensinh($id);
    }

    public function updateData($id, $request)
    {
        $attributes = $request->all();
        unset($attributes['_token']);
		$resurt = $this->repository->updateData($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
			$noidung = 'Cập nhật số liệu tuyển sinh';
			$route = route('chitietsolieutuyensinh',['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function getCheckTonTaiSoLieuTuyenSinh($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token']);
        $route = route('themsolieutuyensinh');
        $message = $checkResult == 'tontai' ?
            'Số liệu tuyển sinh đã tồn tại và được phê duyệt' :
            'Số liệu tuyển sinh đã tồn tại';
        
        if (!isset($checkResult)) {
            $data = $this->postthemsolieutuyensinh($requestParams);
            $message = 'Thêm số liệu tuyển sinh thành công';
            $route = route('chitietsolieutuyensinh', [
                'co_so_id' => $requestParams['co_so_id'],
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

        return $this->repository->getCheckTonTaiSoLieuTuyenSinh($dataCheckNew);
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

    public function getDataSeachCoSo($id)
    {
        $data = $this->repository->getDataSeachCoSo($id);
        $data->ketquatuyensinh = $data->so_luong_sv_Cao_dang + $data->so_luong_sv_Trung_cap + $data->so_luong_sv_So_cap + $data->so_luong_sv_he_khac;
        return $data;
    }

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

    public function getNganhNghe($ma_cap_nghe)
    {
        return  $this->repository->getNganhNghe($ma_cap_nghe);
    }

    public function getThongTinCoSo($coSoId)
    {
        return  $this->CoSoDaoTaoRepository->getThongTinCoSo($coSoId);
    }
    public function getNgheTheoCapBac($id, $cap_nghe)
    {
        return  $this->repository->getNgheTheoCapBac($id, $cap_nghe);
    }

    // thanhnv 6/25/2020 update to service

    public function exportFillRow($worksheet, $row, $tn_cs){
        $worksheet->setCellValue('B'.$row, $tn_cs->nghe_id);
        $worksheet->setCellValue('C'.$row, $tn_cs->ten_nganh_nghe);

        $worksheet->setCellValue('H'.$row, $tn_cs->tong_so_tuyen_sinh);
        $worksheet->setCellValue('I'.$row, $tn_cs->ke_hoach_tuyen_sinh_cao_dang);
        $worksheet->setCellValue('J'.$row, $tn_cs->ke_hoach_tuyen_sinh_trung_cap );
        $worksheet->setCellValue('K'.$row, $tn_cs->ke_hoach_tuyen_sinh_so_cap);
       
        $worksheet->setCellValue('L'.$row, $tn_cs->ke_hoach_tuyen_sinh_khac);
        $worksheet->setCellValue('M'.$row, $tn_cs->tong_so_tuyen_sinh_cac_trinh_do);
        $worksheet->setCellValue('N'.$row, $tn_cs->tong_so_nu);
        $worksheet->setCellValue('O'.$row, $tn_cs->tong_so_dan_toc);
        $worksheet->setCellValue('P'.$row, $tn_cs->tong_ho_khau_HN);

        $worksheet->setCellValue('Q'.$row, $tn_cs->so_luong_sv_Cao_dang);

        $worksheet->setCellValue('R'.$row, $tn_cs->so_luong_sv_nu_Cao_dang);
        $worksheet->setCellValue('S'.$row, $tn_cs->so_luong_sv_dan_toc_Cao_dang);
        $worksheet->setCellValue('T'.$row, $tn_cs->so_luong_sv_ho_khau_HN_Cao_dang);
        $worksheet->setCellValue('U'.$row, $tn_cs->so_tuyen_moi_Cao_dang);
        $worksheet->setCellValue('V'.$row, $tn_cs->so_lien_thong_Cao_dang);
        $worksheet->setCellValue('W'.$row, $tn_cs->so_luong_sv_Trung_cap);
        $worksheet->setCellValue('X'.$row, $tn_cs->so_luong_sv_nu_Trung_cap);
        $worksheet->setCellValue('Y'.$row, $tn_cs->so_luong_sv_dan_toc_Trung_cap);
        $worksheet->setCellValue('Z'.$row, $tn_cs->so_luong_sv_ho_khau_HN_Trung_cap);

        $worksheet->setCellValue('AA'.$row, $tn_cs->ho_khau_HN_THCS_Trung_cap);
        $worksheet->setCellValue('AB'.$row, $tn_cs->so_Tot_nghiep_THCS);
        $worksheet->setCellValue('AC'.$row, $tn_cs->so_Tot_nghiep_THPT);
        $worksheet->setCellValue('AD'.$row, $tn_cs->so_luong_sv_So_cap);

        $worksheet->setCellValue('AE'.$row, $tn_cs->so_luong_sv_nu_So_cap);
        $worksheet->setCellValue('AF'.$row, $tn_cs->so_luong_sv_dan_toc_So_cap);
        $worksheet->setCellValue('AG'.$row, $tn_cs->so_luong_sv_ho_khau_HN_So_cap);

        $worksheet->setCellValue('AH'.$row, $tn_cs->so_luong_sv_he_khac);
        $worksheet->setCellValue('AI'.$row, $tn_cs->so_luong_sv_nu_khac);
        $worksheet->setCellValue('AJ'.$row, $tn_cs->so_luong_sv_dan_toc_khac);
        $worksheet->setCellValue('AK'.$row, $tn_cs->so_luong_sv_ho_khau_HN_khac);
    }

    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/tuyensinh/form-export-data-tuyen-sinh.xls');
        $worksheet = $spreadsheet->getActiveSheet();
        
        $worksheet->setCellValue('C8', "Trường: $co_so->ten - $id_coso ");

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);
        $worksheet->setCellValue('C7', $bacDaoTao);

        $worksheet->getStyle('8')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        $worksheet->getStyle('7')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        $worksheet->getStyle('A')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
       

        $worksheet->getStyle("A7:AK7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A8:AK8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');

        $co_so_nghe = $this->repository->getmanganhnghe($id_coso);

        //  tạo khóa đê khóa các dòng
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $row=8;
        $soThuTu=0;
        foreach($co_so_nghe as $cs_n){
            $row ++;
            $soThuTu++;
            $worksheet->setCellValue('A'.$row, $soThuTu);

            $worksheet->setCellValue('B'.$row, $cs_n->id);
            $worksheet->setCellValue('C'.$row, $cs_n->ten_nganh_nghe);
            
            $keyDanhDau = $this->danhDauloaiHinhCoSo($co_so->ma_loai_hinh_co_so);
            $worksheet->setCellValue($keyDanhDau.$row, 'x');

            //  khóa dòng ko cho chọn
            $worksheet->getStyle('B'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('C'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('D'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('E'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('F'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('G'.$row)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
        };
        $file_xuat_name="File-nhap-so-lieu-tuyen-sinh ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }


    public function exportData($listCoSoId,$fromDate,$toDate){

        $spreadsheet =IOFactory::load('file_excel/tuyensinh/form-export-data-tuyen-sinh.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK'];
        if(in_array('all',$listCoSoId)){
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')
            ->orderBy('loai_truong', 'asc')
            ->get();
        }else{
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')->whereIn('id', $listCoSoId)
            ->orderBy('loai_truong', 'asc')
            ->get();
        }
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $row=6;  
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        foreach($listCoSoDaoTao as $co_s){
            $row++;
                $tuyen_sinh_time = $this->repository->getSvTuyenSinhTimeFromTo($co_s->id,$fromDate,$toDate);
                if ($co_s->loai_truong !== $bacDaoTaoId) {
                    $bacDaoTaoId = $co_s->loai_truong;
                    $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);
                    $worksheet->setCellValue('C' . $row, $bacDaoTao);

    
                    $worksheet->getStyle("C{$row}")->getFont()->setBold(true);
                    $lockRange = "A{$row}:AK{$row}";
                    $worksheet->getStyle($lockRange)
                        ->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('C7C7C7');
    
                    $worksheet->getStyle($lockRange)
                        ->getProtection()
                        ->setLocked(Protection::PROTECTION_PROTECTED);
                $row++;
              }
              
                $worksheet->setCellValue("C{$row}",'Trường: '.$co_s->ten.' - '.$co_s->id);
                $worksheet->getStyle("C{$row}")->getFont()->setBold(true);
                // tô nâu nền trường
                $worksheet->getStyle("A{$row}:AK{$row}")
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('C7C7C7');
                $soThuTu=0;
                foreach($tuyen_sinh_time as $ts){
                    $row++;
                    $soThuTu++;
                    // border cac o
                    foreach($arrayAphabe as $apha){
                        $worksheet->getStyle($apha.$row)
                        ->getBorders()
                        ->getAllBorders()
                        ->setBorderStyle(Border::BORDER_THIN);
                    }
                    $worksheet->setCellValue("A{$row}",$soThuTu);
                    $keyDanhDau = $this->danhDauloaiHinhCoSo($co_s->ma_loai_hinh_co_so);
                    $worksheet->setCellValue($keyDanhDau.$row, 'x');
                    // fill data
                    $this->exportFillRow($worksheet, $row , $ts);
                    }
             }

        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-so-lieu-tuyen-sinh.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }


    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();
        
        $truong = explode(' - ', $data[7][2]);
        $id_truong = trim(array_pop($truong));

        $arrayApha=['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK'];

        $csCheck = DB::table('co_so_dao_tao')->find($id_truong);

        $co_so_nghe = $this->repository->getmanganhnghe($id_truong);

        if($csCheck == null){
            $message='noCorrectIdTruong';
            return $message;  
        }

        $id_nghe_of_cs =[];
        foreach($co_so_nghe as $csn){
        array_push($id_nghe_of_cs,$csn->id);
        }

        // checkDaCoChua
        $tuyen_sinh_nam_dot_da_co = $this->repository->getTuyenSinhCsNamDot($id_truong,$year,$dot);

        $id_nghe_tuyen_sinh_gan_da_co=[];
        for($i=0;$i < count($tuyen_sinh_nam_dot_da_co); $i++){
            $id_nghe_tuyen_sinh_gan_da_co[$tuyen_sinh_nam_dot_da_co[$i]->nghe_id] = $tuyen_sinh_nam_dot_da_co[$i]->id;
        }
        
        $vitri=[];
        $vitri=$this->checkError($data, $arrayApha, 8 , 7, 36);

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
                    $id_nghe_nhap = $data[$i][1];
                    if(in_array($id_nghe_nhap,$id_nghe_of_cs)){
                        $arrayData=[
                            'nam'=>$year,
                            'dot'=>$dot,
                            'nghe_id'=>$data[$i][1],
                            'co_so_id'=>$id_truong,
                            'tong_so_tuyen_sinh'=>$data[$i][7],
                            'ke_hoach_tuyen_sinh_cao_dang'=>$data[$i][8],
                            'ke_hoach_tuyen_sinh_trung_cap'=>$data[$i][9],
                            'ke_hoach_tuyen_sinh_so_cap'=>$data[$i][10],
                            'ke_hoach_tuyen_sinh_khac'=>$data[$i][11],
    
                            'tong_so_tuyen_sinh_cac_trinh_do'=>$data[$i][12],
                            'tong_so_nu'=>$data[$i][13],
                            'tong_so_dan_toc'=>$data[$i][14],
                            'tong_ho_khau_HN'=>$data[$i][15],
    
                            'so_luong_sv_Cao_dang'=>$data[$i][16],
                            'so_luong_sv_nu_Cao_dang'=>$data[$i][17],
                            'so_luong_sv_dan_toc_Cao_dang'=>$data[$i][18],
                            'so_luong_sv_ho_khau_HN_Cao_dang'=>$data[$i][19],
                            'so_tuyen_moi_Cao_dang'=>$data[$i][20],
                            'so_lien_thong_Cao_dang'=>$data[$i][21],
    
                            'so_luong_sv_Trung_cap'=>$data[$i][22],
                            'so_luong_sv_nu_Trung_cap'=>$data[$i][23],
                            'so_luong_sv_dan_toc_Trung_cap'=>$data[$i][24],
                            'so_luong_sv_ho_khau_HN_Trung_cap'=>$data[$i][25],
                            'ho_khau_HN_THCS_Trung_cap'=>$data[$i][26],
    
                            'so_Tot_nghiep_THCS'=>$data[$i][27],
                            'so_Tot_nghiep_THPT'=>$data[$i][28],
    
        
                            'so_luong_sv_So_cap'=>$data[$i][29],
                            'so_luong_sv_nu_So_cap'=>$data[$i][30],
                            'so_luong_sv_dan_toc_So_cap'=>$data[$i][31],
                            'so_luong_sv_ho_khau_HN_So_cap'=>$data[$i][32],
                            'so_luong_sv_he_khac'=>$data[$i][33],
                            'so_luong_sv_nu_khac'=>$data[$i][34],
                            'so_luong_sv_dan_toc_khac'=>$data[$i][35],
                            'so_luong_sv_ho_khau_HN_khac'=>$data[$i][36],
                            'thoi_gian_cap_nhat'=>Carbon::now(),
    
                        ];
                        if(array_key_exists($id_nghe_nhap,$id_nghe_tuyen_sinh_gan_da_co)){
                            $updateData[$id_nghe_tuyen_sinh_gan_da_co[$id_nghe_nhap]]=$arrayData;
                        }else{
                            $this->repository->createTuyenSinh($arrayData);
                        }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message; 
                    };

                }   
                if (count($updateData) > 0) {
                foreach($updateData as $key => $value)
                  $this->repository->updateTuyenSinh($key,$value);
                }  

                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Tuyển sinh';
                $tencoso = $thongTinCoSo->ten;
                $route = route('chitietsolieutuyensinh',['co_so_id' => $id_truong]);
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
            
        $truong = explode(' - ', $data[7][2]);
        $id_truong = trim(array_pop($truong));

    
        $arrayApha=['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK'];
 
        $vitri=$this->checkError($data, $arrayApha, 8 , 7, 36);
    
        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);
        
        $this->errorRebBackGroud($vitri,$worksheet);
    
        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx"); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-so-lieu-tuyen-sinh.xlsx"');
        $writer->save("php://output");
    } 



    public function exportFollowSreach($params = [])
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['devvn_xaphuongthitran'] = isset($params['devvn_xaphuongthitran']) ? $params['devvn_xaphuongthitran'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        
        $data = $this->repository->getTuyenSinhExportSreach($queryData);

        $spreadsheet = IOFactory::load('file_excel/tuyensinh/form-export-data-tuyen-sinh.xls');
        $worksheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $soThuTu=0;
        $row=6;
        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK'];
        $cs_id_truong = 0;
        $bacDaoTaoId = 0;
        $ten_truong = 'TRƯỜNG CAO ĐẲNG';
        foreach($data as $ts){
            $row++;
            $soThuTu++;
            // border cac o
            if ($ts->id_co_so !== $cs_id_truong) {
                $cs_id_truong = $ts->id_co_so;
                $worksheet->setCellValue('B' . $row, $ts->ten);
                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                $lockRange = "A{$row}:AK{$row}";
                $worksheet->getStyle($lockRange)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('C7C7C7');

                $row++;
            }

            // if ($ts->loai_truong !== $bacDaoTaoId) {
            //     $bacDaoTaoId = $ts->loai_truong;
            //     $bacDaoTao = $this->bacDaoTaoOfTruong($ts->loai_truong);

            //     $worksheet->setCellValue('B' . $row, $bacDaoTao);
            //     $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
            //     $lockRange = "A{$row}:AK{$row}";
            //     $worksheet->getStyle($lockRange)
            //         ->getFill()
            //         ->setFillType(Fill::FILL_SOLID)
            //         ->getStartColor()->setARGB('C7C7C7');
            //     $row++;
            // }

             foreach($arrayAphabe as $apha){
                $worksheet->getStyle($apha.$row)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
            }
            $worksheet->setCellValue("A{$row}",$soThuTu);
            $keyDanhDau = $this->danhDauloaiHinhCoSo($ts->ma_loai_hinh_co_so);
            $worksheet->setCellValue($keyDanhDau.$row, 'x');
            // fill data
            $this->exportFillRow($worksheet, $row , $ts);
            }
            $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="File-xuat-theo-tim-kiem.xlsx"');
            $writer->save("php://output");

    }
    
}
 ?>
