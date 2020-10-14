<?php

namespace App\Services;
use App\Repositories\HopTacQuocTeRepository;
use App\Repositories\SoLieuTuyenSinhInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use Storage;
use App\Services\StoreUpdateNotificationService;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class HopTacQuocTeService extends AppService
{
    protected $SoLieuTuyenSinhInterface;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;
    use ExcelTraitService;

    public function __construct(
        SoLieuTuyenSinhInterface $soLieuTuyenSinhRepository,
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
    }

    public function getRepository()
    {
        return HopTacQuocTeRepository::class;
    }


    public function getDanhSachKetQuaHopTacQuocTe($params){
        return $this->repository->getDanhSachKetQuaHopTacQuocTe($params);
    }


    public function checkTonTaiKhiThem($params){
        return $this->repository->checkTonTaiKhiThem($params);
    }

    public function chiTietTheoCoSo($co_so_id, $params){
        return $this->repository->chiTietTheoCoSo($co_so_id, $params);
    }


    // thanhnv  6/21/2020 export import bm13


    public function sumRowInExcel($worksheet,$row){
        $worksheet->setCellValue("C{$row}", "=SUM(D{$row}:F{$row})");
        $worksheet->setCellValue("G{$row}", "=SUM(H{$row}:I{$row})");
        $worksheet->setCellValue("L{$row}", "=SUM(M{$row}:N{$row})");

    }

    public function exportFillRow($worksheet, $row, $tnien){
        $worksheet->setCellValue('C'.$row, $tnien->tong_tuyen_sinh);
        $worksheet->setCellValue('D'.$row, $tnien->tong_tuyen_sinh_CD);
        $worksheet->setCellValue('E'.$row, $tnien->tong_tuyen_sinh_TC);
        $worksheet->setCellValue('F'.$row, $tnien->tong_tuyen_sinh_SC);
        $worksheet->setCellValue('G'.$row, $tnien->tong_so_hs_duoc_cap_bang);
        $worksheet->setCellValue('H'.$row, $tnien->so_hs_duoc_cac_don_vi_cap_bang);
        $worksheet->setCellValue('I'.$row, $tnien->so_hs_duoc_nha_truong_cap_bang);
        $worksheet->setCellValue('J'.$row, $tnien->so_hs_co_viec_lam_sau_khi_tot_nghiep);
        $worksheet->setCellValue('K'.$row, $tnien->so_luong_chuong_trinh_xay_dung_phat_trien);
        $worksheet->setCellValue('L'.$row, $tnien->tong_hop_tac_quoc_te_trong_dao_tao_boi_duong);
        $worksheet->setCellValue('M'.$row, $tnien->so_gv_duoc_dao_tao_boi_duong);
        $worksheet->setCellValue('N'.$row, $tnien->so_can_bo_quan_ly_duoc_dao_tao_boi_duong);
        $worksheet->setCellValue('O'.$row, $tnien->so_phong_hoc_duoc_dau_tu);
        $worksheet->setCellValue('P'.$row, $tnien->so_nha_xuong_duoc_dau_tu);
        $worksheet->setCellValue('Q'.$row, $tnien->tong_kinh_phi);
    }


    public function exportBieuMau($id_coso){
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm13/bm13.xlsx');

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('B5', $bacDaoTao);
        $worksheet->setCellValue('B6', "Trường: $co_so->ten - $id_coso");

        $worksheet->getStyle("B5")->getFont()->setBold(true);
        $worksheet->getStyle("B6")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A5:Q5")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock =['A','B','C','G','L'];
        $this->lockedCellInExcel($worksheet,$arrayLock);
        $this->sumRowInExcel($worksheet,6);

        // khóa thêm vài dòng ở sau
        // for($i=7 ;$i < 20 ; $i++){
        //     $arrayAphabe=['C'.$i,'D'.$i,'E'.$i,'F'.$i,'G'.$i,'H'.$i,'I'.$i,'J'.$i,'K'.$i,'L'.$i,'M'.$i,'N'.$i,'O'.$i,'P'.$i,'Q'.$i];
        //     $this->lockedCellInExcel($worksheet,$arrayAphabe);
        // }
        $file_xuat_name="File-nhap-hop-tac-quoc-te ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");

    }

    public function exportData($listCoSoId,$fromDate,$toDate){

        $spreadsheet = IOFactory::load('file_excel/bm13/bm13.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'];

        if(in_array('all',$listCoSoId)){
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')
            ->orderBy('loai_truong', 'asc')
            ->get();
        }else{
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')->whereIn('id', $listCoSoId)
            ->orderBy('loai_truong', 'asc')
            ->get();
        }

        $row=4;
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        foreach($listCoSoDaoTao as $co_s){
        $row++;

            $hop_tac_quoc_te_theo_cs = $this->repository->getHopTacQuocTeTimeFromTo($co_s->id,$fromDate,$toDate);

            if ($co_s->loai_truong !== $bacDaoTaoId) {
                $bacDaoTaoId = $co_s->loai_truong;

                $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);

                 $worksheet->setCellValue('B' . $row, $bacDaoTao);

                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
                $lockRange = "A{$row}:Q{$row}";
                $worksheet->getStyle($lockRange)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('C7C7C7');

                $worksheet->getStyle($lockRange)
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_PROTECTED);
            $row++;

            $soThuTu=0;
          }
          $soThuTu++;
            $worksheet->setCellValue("A{$row}", $soThuTu);
            $worksheet->setCellValue("B{$row}",'Trường: '.$co_s->ten.' - '.$co_s->id);
            $worksheet->getStyle("B{$row}")->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
            // tô nâu nền trường
            $worksheet->getStyle("A{$row}:Q{$row}")
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('C7C7C7');
            $soThuTu=0;
            foreach($hop_tac_quoc_te_theo_cs as $htqt){
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
                $this->exportFillRow($worksheet, $row , $htqt);
                }

         }
        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-hop-tac-quoc-te.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }

    public function importFile($fileRead, $duoiFile, $year, $dot){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[5][1]);
        $id_truong = trim(array_pop($truong));

        
        $arrayAphabe=['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'];
        $csCheck = DB::table('co_so_dao_tao')->find($id_truong);

        if($csCheck == null){
            $message='noCorrectIdTruong';
            return $message;
        }

        $hop_tac_quoc_te_da_co = $this->repository->getHopTacQuocTeCsNamDot($id_truong,$year,$dot);
        $vitri = $this->checkError($data, $arrayAphabe, 5, 2, 16);

        if(count($vitri) > 0 ){
                  $message='errorkitu';
                  return $message;
         }

         $arrayData=[];
         $insertData=[];
         $updateData=[];
        //  $data chay từ 0
        // count thì tính từ 1 lên cho = 6
         if(count($data) == 6){
             if($vitri == null || $vitri == ''){
                //  for($i = 8; $i < count($data); $i++){
                         $arrayData=[
                             'nam'=>$year,
                             'dot'=>$dot,
                             'co_so_id'=>$id_truong,

                             'tong_tuyen_sinh'=>$data[5][2],
                             'tong_tuyen_sinh_CD'=>$data[5][3],
                             'tong_tuyen_sinh_TC'=>$data[5][4],
                             'tong_tuyen_sinh_SC'=>$data[5][5],
                             'tong_so_hs_duoc_cap_bang'=>$data[5][6],
                             'so_hs_duoc_cac_don_vi_cap_bang'=>$data[5][7],

                             'so_hs_duoc_nha_truong_cap_bang'=>$data[5][8],
                             'so_hs_co_viec_lam_sau_khi_tot_nghiep'=>$data[5][9],
                             'so_luong_chuong_trinh_xay_dung_phat_trien'=>$data[5][10],
                             'tong_hop_tac_quoc_te_trong_dao_tao_boi_duong'=>$data[5][11],

                             'so_gv_duoc_dao_tao_boi_duong'=>$data[5][12],
                             'so_can_bo_quan_ly_duoc_dao_tao_boi_duong'=>$data[5][13],
                             'so_phong_hoc_duoc_dau_tu'=>$data[5][14],
                             'so_nha_xuong_duoc_dau_tu'=>$data[5][15],
                             'tong_kinh_phi'=>$data[5][16],

                         ];



                            if($hop_tac_quoc_te_da_co != null){
                                if($id_truong  == $hop_tac_quoc_te_da_co->co_so_id){
                                    $updateData[$hop_tac_quoc_te_da_co->id]=$arrayData;
                                }
                            }
                            else{
                                  $this->repository->createHopTacQuocTe($arrayData);
                           }
                //  }
                 if (count($updateData) > 0) {
                 foreach($updateData as $key => $value)
                    //  DB::table('ket_qua_hop_tac_quoc_te')->where('id',$key)->update($value);
                    $this->repository->updateHopTacQuocTe($key,$value);

                 }

                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Hợp tác quốc tế';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.chi-tiet-ds-hop-tac-qte',['co_so_id' => $id_truong]);
                $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($insertData),count($updateData),$bm,$route,$tencoso);


                  $message='ok';
                  return $message;
             }
         }else if(count($data) != 6){
             $message='chiDuocNhap1CoSo';
             return $message;
         }

    }


    public function importError($fileRead,$duoiFile,$path){
        $fileReadStorage= storage_path('app/public/'.$path);

        $spreadsheet = $this->createSpreadSheet($fileReadStorage,$duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $arrayAphabe=['C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q'];
        $vitri = $this->checkError($data, $arrayAphabe, 5, 2, 16);

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
        header('Content-Disposition: attachment; filename="Error-file-nhap-hop-tac-quoc-te.xlsx"');
        $writer->save("php://output");
    }

    public function store(array $data = [])
    {
        $returnData = $this->repository->createHopTacQuocTe($data);

        if($returnData){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu hợp tác quốc tế';
            $route = route('xuatbc.chi-tiet-ds-hop-tac-qte',['co_so_id' => $data['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($data['nam'],$data['dot'],$data['co_so_id'],$tieude,$noidung,$route);

        }
        return $returnData;
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
			$noidung = 'Cập nhật số liệu hợp tác quốc tế';
            $route = route('xuatbc.chi-tiet-ds-hop-tac-qte',['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

}
