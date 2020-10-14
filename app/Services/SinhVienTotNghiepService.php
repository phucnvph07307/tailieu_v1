<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\SinhVienTotNghiepRepository;
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
use Storage;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class SinhVienTotNghiepService extends AppService
{
    protected $loaiHinhCoSoRepository;
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
        return SinhVienTotNghiepRepository::class;
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
    public function getTenCoSoDaoTao()
    {
        return $this->repository->getTenCoSoDaoTao();
    }
    public function getmanganhnghe($id)
    {
        $data = $this->repository->getmanganhnghe($id);
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
    public function getNgheTheoCapBac($id, $cap_nghe)
    {
        return  $this->repository->getNgheTheoCapBac($id, $cap_nghe);
    }
    public function getThongTinCoSo($coSoId)
    {
        return $this->CoSoDaoTaoRepository->getThongTinCoSo($coSoId);
    }
    public function getChiTietTongHopTotNghiep($coSoId, $limit, $params)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $data = $this->repository->getChiTietTongHopTotNghiep($coSoId, $limit, $queryData);
        return $data;
    // dd($data);
    }
    public function getSuaSoLieuTotNghiep($id)
    {
        return $this->repository->getSuaSoLieuTotNghiep($id);
    }

    public function postThemSoLieuTotNghiep($getdata)
    {
        unset($getdata['_token']);
        $dateTime = Carbon::now();
        $getdata['thoi_gian_cap_nhat'] = $dateTime->format('Y-m-d H:i:s');
        
        $data = $this->repository->postThemSoLieuTotNghiep($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu sinh viên tốt nghiệp';
            $route = route('chitietsolieutuyensinh',['co_so_id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
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
            $noidung = 'Cập nhật số liệu tốt nghiệp';
			$route = route('chitietsolieutuyensinh',['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function getCheckTonTaiSoLieuTotNghiep($data, $requestParams)
    {
        $checkResult = $this->getSoLieu($data);
        unset($requestParams['_token']);
        $route = route('xuatbc.them-tong-hop');
        $message = $checkResult == 'tontai' ?
            'Số liệu tốt nghiệp đã tồn tại và được phê duyệt' :
            'Số liệu tốt nghiệp đã tồn tại';
        
        if (!isset($checkResult)) {
            $data = $this->postThemSoLieuTotNghiep($requestParams);
            $message = 'Thêm số liệu tốt nghiệp thành công';
            $route = route('xuatbc.chi-tiet-tong-hop', [
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

        return $this->repository->getCheckTonTaiSoLieuTotNghiep($dataCheckNew);
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

    // thanhnv update change to service 6/25/2020

    
    public function exportFillRow($worksheet, $row, $tn_cs){
        $worksheet->setCellValue('B'.$row, $tn_cs->nghe_id);
        $worksheet->setCellValue('C'.$row, $tn_cs->ten_nganh_nghe);

        $worksheet->setCellValue('H'.$row, $tn_cs->Tong_SoNguoi_TN);
        $worksheet->setCellValue('I'.$row, $tn_cs->NU_SV_TN);
        $worksheet->setCellValue('J'.$row, $tn_cs->DanToc_ThieuSo_ItNguoi);
        $worksheet->setCellValue('K'.$row, $tn_cs->HoKhauHN);
       
        $worksheet->setCellValue('L'.$row, $tn_cs->SoSV_NhapHoc_DauKhoa_TrinhDoCD);
        $worksheet->setCellValue('M'.$row, $tn_cs->SoSV_Du_DieuKienThi_XetTN_TrinhDoCD);
        $worksheet->setCellValue('N'.$row, $tn_cs->SoSV_TN_TrinhDoCD);
        $worksheet->setCellValue('O'.$row, $tn_cs->SoLuong_Nu_SV_CD);
        $worksheet->setCellValue('P'.$row, $tn_cs->DanToc_ThieuSo_ItNguoi_CD);
        
        $worksheet->setCellValue('Q'.$row, $tn_cs->SoSV_HoKhauHN_CD);
        $worksheet->setCellValue('R'.$row, $tn_cs->SoLuong_HSSV_TN_Kha_Gioi_CD);
        $worksheet->setCellValue('S'.$row, $tn_cs->SoSV_NhapHoc_DauKhoa_TrinhDoTC);
        $worksheet->setCellValue('T'.$row, $tn_cs->SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC);
        $worksheet->setCellValue('U'.$row, $tn_cs->SoSV_TN_TrinhDoTC);
        $worksheet->setCellValue('V'.$row, $tn_cs->SoLuong_Nu_SV_TC);
        $worksheet->setCellValue('W'.$row, $tn_cs->DanToc_ThieuSo_ItNguoi_TC);
        $worksheet->setCellValue('X'.$row, $tn_cs->SoSV_HoKhauHN_TC);
        
        $worksheet->setCellValue('Y'.$row, $tn_cs->HoKhau_HN_Thuoc_DoiTuong_TN_TC);

        $worksheet->setCellValue('Z'.$row, $tn_cs->SoLuong_HSSV_TN_Kha_Gioi_TC);
        $worksheet->setCellValue('AA'.$row, $tn_cs->SoSV_NhapHoc_DauKhoa_TrinhDoSC);
        $worksheet->setCellValue('AB'.$row, $tn_cs->SoSV_Du_DieuKienThi_XetTN_TrinhDoSC);
        $worksheet->setCellValue('AC'.$row, $tn_cs->SoSV_TN_TrinhDoSC);

        $worksheet->setCellValue('AD'.$row, $tn_cs->SoLuong_Nu_SV_SC);
        $worksheet->setCellValue('AE'.$row, $tn_cs->DanToc_ThieuSo_ItNguoi_SC);
        $worksheet->setCellValue('AF'.$row, $tn_cs->SoSV_HoKhauHN_SC);

        $worksheet->setCellValue('AG'.$row, $tn_cs->SoSV_NhapHoc_DauKhoa_NgheKhac);
        $worksheet->setCellValue('AH'.$row, $tn_cs->SoSV_DuKienThi_XetTN_NgheKhac);
        $worksheet->setCellValue('AI'.$row, $tn_cs->SoSV_TN_NgheKhac);

        $worksheet->setCellValue('AJ'.$row, $tn_cs->SoLuong_Nu_SV_NgheKhac);
        $worksheet->setCellValue('AK'.$row, $tn_cs->DanToc_ThieuSo_ItNguoi_NgheKhac);
        $worksheet->setCellValue('AL'.$row, $tn_cs->SoNguoi_HoKhauHN_NgheKhac);

        $worksheet->setCellValue('AM'.$row, $tn_cs->SoNguoi_CoViecLamNgay_SauKhi_TN_CD);
        $worksheet->setCellValue('AN'.$row, $tn_cs->CoViecLam_HoKhauHN_TrinhDoCD);
        $worksheet->setCellValue('AO'.$row, $tn_cs->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC);
        $worksheet->setCellValue('AP'.$row, $tn_cs->CoViecLam_HoKhauHN_TrinhDo_TC);
        $worksheet->setCellValue('AQ'.$row, $tn_cs->SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC);
        $worksheet->setCellValue('AR'.$row, $tn_cs->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC);
        $worksheet->setCellValue('AS'.$row, $tn_cs->SoLuong_HoKhauHN_TrinhDoSC);
    
        $worksheet->setCellValue('AT'.$row, $tn_cs->SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac);
        $worksheet->setCellValue('AU'.$row, $tn_cs->SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac);

        $worksheet->setCellValue('AV'.$row, $tn_cs->MucLuong_TB_CD);
        $worksheet->setCellValue('AW'.$row, $tn_cs->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD);
        $worksheet->setCellValue('AX'.$row, $tn_cs->MucLuong_TB_TC);
        $worksheet->setCellValue('AY'.$row, $tn_cs->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC);
        $worksheet->setCellValue('AZ'.$row, $tn_cs->MucLuong_TB_SC);
        $worksheet->setCellValue('BA'.$row, $tn_cs->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC);
        $worksheet->setCellValue('BB'.$row, $tn_cs->MucLuong_TB_NgheKhac);
        $worksheet->setCellValue('BC'.$row, $tn_cs->MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac);
    }

    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id',$id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/totnghiep/bieu-mau-tot-nghiep.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
        
        $worksheet->setCellValue('C9', "Trường: $co_so->ten - $id_coso ");
     
        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);
        $worksheet->setCellValue('C8', $bacDaoTao);

        $worksheet->getStyle("C9")->getFont()->setBold(true);
        $worksheet->getStyle("C8")->getFont()->setBold(true);

        $worksheet->getStyle('8')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        $worksheet->getStyle('9')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
       

        $worksheet->getStyle("A9:BC9")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A8:BC8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);

        //  tạo khóa đê khóa các dòng
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);
        $worksheet->getStyle('C8')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        $worksheet->getStyle('C9')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);

        $row=9;
        $soThuTu=0;
        foreach($co_so_nghe as $cs_n){
            $soThuTu++;
            $row ++;
            $worksheet->setCellValue('A'.$row,$soThuTu);
            $worksheet->setCellValue('B'.$row, $cs_n->id);
            $worksheet->setCellValue('C'.$row, $cs_n->ten_nganh_nghe);
            
            $keyDanhDau = $this->danhDauloaiHinhCoSo($co_so->ma_loai_hinh_co_so);
            $worksheet->setCellValue($keyDanhDau.$row, 'x');

            //  khóa dòng ko cho chọn
            $worksheet->getStyle('B'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('C'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('D'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('E'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('F'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('G'.$row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        };

        $file_xuat_name = "File-nhap-sinh-vien-tot-nghiep ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }


    public function exportData($listCoSoId,$fromDate,$toDate){

        $spreadsheet = IOFactory::load('file_excel/totnghiep/bieu-mau-tot-nghiep.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC'];
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

        $row=7;  
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        foreach($listCoSoDaoTao as $co_s){
            $row++;
                $tot_nghiep_time = $this->repository->getSvTotNghiepTimeFromTo($co_s->id,$fromDate,$toDate);
                if ($co_s->loai_truong !== $bacDaoTaoId) {
                    $bacDaoTaoId = $co_s->loai_truong;
                    $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);
                    $worksheet->setCellValue('B' . $row, $bacDaoTao);

    
                    $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                    $lockRange = "A{$row}:BC{$row}";
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
                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                // tô nâu nền trường
                $worksheet->getStyle("A{$row}:BC{$row}")
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('C7C7C7');
                $soThuTu=0;
                foreach($tot_nghiep_time as $tn){
                    $row++;
                     $soThuTu++;
                    // border cac o
                    foreach($arrayAphabe as $apha){
                        $worksheet->getStyle($apha.$row)
                        ->getBorders()
                        ->getAllBorders()
                        ->setBorderStyle(Border::BORDER_THIN);
                    }
                    $keyDanhDau = $this->danhDauloaiHinhCoSo($co_s->ma_loai_hinh_co_so);
                    $worksheet->setCellValue($keyDanhDau.$row, 'x');

                     $worksheet->setCellValue('A'.$row,$soThuTu);
                    // fill data
                    $this->exportFillRow($worksheet, $row , $tn);
                    }
                    
             }
    
        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-sinh-vien-tot-nghiep.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    
    }

    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();
        
        $truong = explode(' - ', $data[8][2]);
        $id_truong = trim(array_pop($truong));

        $arrayApha=['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC'];

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

        // checkDaCoChua
        $tot_nghiep_nam_dot_da_co = $this->repository->getTotNghiepCsNamDot($id_truong,$year,$dot);

        $id_nghe_tot_nghiep_gan_da_co=[];
        for($i=0;$i < count($tot_nghiep_nam_dot_da_co); $i++){
            $id_nghe_tot_nghiep_gan_da_co[$tot_nghiep_nam_dot_da_co[$i]->nghe_id] = $tot_nghiep_nam_dot_da_co[$i]->id;
        }
        
        $vitri=[];
        $vitri=$this->checkError($data, $arrayApha, 9 , 7, 54);

        if(count($vitri) > 0 ){
                $message='errorkitu';
                return $message;  
        }

        $arrayData=[];
        $insertData=[];
        $updateData=[];
        $soDongNgNhap=(count($data) - 9);
        if($soDongNgNhap == count($co_so_nghe)){
            if($vitri == null || $vitri == ''){
                for($i = 9; $i < count($data); $i++){ 
                    $id_nghe_nhap = $data[$i][1];
                    if(in_array($id_nghe_nhap,$id_nghe_of_cs)){
                        $arrayData=[
                            'nam'=>$year,
                            'dot'=>$dot,
                            'nghe_id'=>$data[$i][1],
                            'co_so_id'=>$id_truong,

                            'Tong_SoNguoi_TN'=>$data[$i][7],
                            'NU_SV_TN'=>$data[$i][8],
                            'DanToc_ThieuSo_ItNguoi'=>$data[$i][9],
                            'HoKhauHN'=>$data[$i][10],

                            'SoSV_NhapHoc_DauKhoa_TrinhDoCD'=>$data[$i][11],
                            'SoSV_Du_DieuKienThi_XetTN_TrinhDoCD'=>$data[$i][12],
                            'SoSV_TN_TrinhDoCD'=>$data[$i][13],
                            'SoLuong_Nu_SV_CD'=>$data[$i][14],
                            'DanToc_ThieuSo_ItNguoi_CD'=>$data[$i][15],
                            'SoSV_HoKhauHN_CD'=>$data[$i][16],
                            'SoLuong_HSSV_TN_Kha_Gioi_CD'=>$data[$i][17],

                            'SoSV_NhapHoc_DauKhoa_TrinhDoTC'=>$data[$i][18],
                            'SoSV_Du_DieuKienTHhi_XetTN_TrinhDoTC'=>$data[$i][19],
                            'SoSV_TN_TrinhDoTC'=>$data[$i][20],
                            'SoLuong_Nu_SV_TC'=>$data[$i][21],
                            'DanToc_ThieuSo_ItNguoi_TC'=>$data[$i][22],
                            'SoSV_HoKhauHN_TC'=>$data[$i][23],
                            'HoKhau_HN_Thuoc_DoiTuong_TN_TC'=>$data[$i][24],
                            'SoLuong_HSSV_TN_Kha_Gioi_TC'=>$data[$i][25],

                            'SoSV_NhapHoc_DauKhoa_TrinhDoSC'=>$data[$i][26],
                            'SoSV_Du_DieuKienThi_XetTN_TrinhDoSC'=>$data[$i][27],
                            'SoSV_TN_TrinhDoSC'=>$data[$i][28],
                            'SoLuong_Nu_SV_SC'=>$data[$i][29],
                            'DanToc_ThieuSo_ItNguoi_SC'=>$data[$i][30],
                            'SoSV_HoKhauHN_SC'=>$data[$i][31],

                            'SoSV_NhapHoc_DauKhoa_NgheKhac'=>$data[$i][32],
                            'SoSV_DuKienThi_XetTN_NgheKhac'=>$data[$i][33],
                            'SoSV_TN_NgheKhac'=>$data[$i][34],
                            'SoLuong_Nu_SV_NgheKhac'=>$data[$i][35],
                            'DanToc_ThieuSo_ItNguoi_NgheKhac'=>$data[$i][36],
                            'SoNguoi_HoKhauHN_NgheKhac'=>$data[$i][37],

                            'SoNguoi_CoViecLamNgay_SauKhi_TN_CD'=>$data[$i][38],
                            'CoViecLam_HoKhauHN_TrinhDoCD'=>$data[$i][39],

                            'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoTC'=>$data[$i][40],
                            'CoViecLam_HoKhauHN_TrinhDo_TC'=>$data[$i][41],
                            'SV_CoViecLam_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC'=>$data[$i][42],

                            'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_TrinhDoSC'=>$data[$i][43],
                            'SoLuong_HoKhauHN_TrinhDoSC'=>$data[$i][44],

                            'SoNguoiHoc_CoViecLamNgay_SauKhi_TN_DaoTao_NgheKhac'=>$data[$i][45],
                            'SoNguoi_HoKhauHN_TrinhDo_DaoTao_NgheKhac'=>$data[$i][46],

                            'MucLuong_TB_CD'=>$data[$i][47],
                            'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoCD'=>$data[$i][48],
                            'MucLuong_TB_TC'=>$data[$i][49],
                            'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoTC'=>$data[$i][50],
                            'MucLuong_TB_SC'=>$data[$i][51],
                            'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoSC'=>$data[$i][52],
                            'MucLuong_TB_NgheKhac'=>$data[$i][53],
                            'MucLuong_TB_HoKhauHN_TrinhDoTC_ThuocDT_TN_THCS_TrinhDoNgheKhac'=>$data[$i][54],
                        ];
                        if(array_key_exists($id_nghe_nhap,$id_nghe_tot_nghiep_gan_da_co)){
                            $updateData[$id_nghe_tot_nghiep_gan_da_co[$id_nghe_nhap]]=$arrayData;
                        }else{
                            $this->repository->createTotNghiep($arrayData);
                        }
                    }else if(in_array($id_nghe_nhap,$id_nghe_of_cs) == false){
                        $message='ngheKoThuocTruong';
                        return $message; 
                    };

                }   
                if (count($updateData) > 0) {
                foreach($updateData as $key => $value)
                   $this->repository->updateTotNghiep($key,$value);
                    // DB::table('sv_tot_nghiep')->where('id',$key)->update($value);
                }  
         
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Tốt nghiệp';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.chi-tiet-tong-hop',['id' => $id_truong]);
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
            
        $truong = explode(' - ', $data[8][2]);
        $id_truong = trim(array_pop($truong));

    
        $arrayApha=['H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC'];
 
        $vitri=$this->checkError($data, $arrayApha, 9 , 7, 54);
    
        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);
        
        $this->errorRebBackGroud($vitri,$worksheet);
    
        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx"); 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-sinh-vien-tot-nghiep.xlsx"');
        $writer->save("php://output");
    } 

}

 ?>