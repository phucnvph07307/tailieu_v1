<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\ChiTieuTuyenSinhRepository;
use App\Repositories\SoLieuTuyenSinhInterface;
use App\Repositories\ChiTieuTuyenSinhRepositoryInterface;
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
use Carbon\Carbon;

class ChiTieuTuyenSinhService extends AppService
{
    protected $SoLieuTuyenSinhInterface;
    protected $chiTieuTuyenSinhRepository;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;
    use ExcelTraitService;

    public function __construct(
        SoLieuTuyenSinhInterface $soLieuTuyenSinhRepository,
        ChiTieuTuyenSinhRepositoryInterface $chiTieuTuyenSinhRepository,
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
        $this->chiTieuTuyenSinhRepository = $chiTieuTuyenSinhRepository;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this->CoSoDaoTaoRepository = $coSoDaoTao;
    }

    public function getRepository()
    {
        return ChiTieuTuyenSinhRepository::class;
    }

    public function getDanhSachChiTieuTuyenSinh($params)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['nghe_id'] = isset($params['nghe_id']) ? $params['nghe_id'] : null;
        $queryData['page_size'] = isset($params['page_size']) ? $params['page_size'] : null;
        return $this->repository->getDanhSachChiTieuTuyenSinh($queryData);
    }

    public function checkTonTaiKhiThem($params)
    {
        return $this->repository->checkTonTaiKhiThem($params);
    }

    public function getNganhNgheTheoCoSo($co_so_id)
    {
        return $this->repository->getNganhNgheTheoCoSo($co_so_id);
    }

    public function chiTietTheoCoSo($co_so_id, $params)
    {
        return $this->repository->chiTietTheoCoSo($co_so_id, $params);
    }


    public function exportBieuMau($id_coso)
    {
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm8/bm8.xlsx');

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('C7', $bacDaoTao);
        $worksheet->setCellValue('C8', "Trường: $co_so->ten - $id_coso");

        $worksheet->getStyle("C7")->getFont()->setBold(true);
        $worksheet->getStyle("C8")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A7:J7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A8:J8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $arrayLock = ['A', 'C', 'B'];
        $this->lockedCellInExcel($worksheet, $arrayLock);

        $keyDanhdau =  $this->danhDauloaiHinhCoSo($co_so->ma_loai_hinh_co_so);

        $row = 8;
        $soThuTu = 0;
        foreach ($co_so_nghe as $cs_n) {
            $row++;
            $soThuTu++;
            $worksheet->setCellValue('A' . $row, $soThuTu);

            $worksheet->setCellValue($keyDanhdau . $row, 'X');

            $worksheet->setCellValue('C' . $row, $cs_n->ten_nganh_nghe);
            $worksheet->setCellValue('B' . $row, $cs_n->id);
            $worksheet->setCellValue("H{$row}", "=SUM(I{$row}:J{$row})");

            // KHÓA
            $arrayLock = ['A' . $row, 'C' . $row, 'B' . $row, 'H' . $row, 'D' . $row, 'F' . $row, 'G' . $row, 'E' . $row,];
            $this->lockedCellInExcel($worksheet, $arrayLock);
        };

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-nhap-chi-tieu-tuyen-sinh.xlsx"');
        $writer->save("php://output");
    }


    public function exportData($listCoSoId, $fromDate, $toDate)
    {

        $spreadsheet = IOFactory::load('file_excel/bm8/bm8.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        if (in_array('all', $listCoSoId)) {
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')
                ->orderBy('loai_truong', 'asc')
                ->get();
        } else {
            $listCoSoDaoTao =  DB::table('co_so_dao_tao')->whereIn('id', $listCoSoId)
                ->orderBy('loai_truong', 'asc')
                ->get();
        }


        $row = 6;
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;

        foreach ($listCoSoDaoTao as $co_s) {
            $row++;
            $soThuTu = 0;
            $keyDanhdau =  $this->danhDauloaiHinhCoSo($co_s->ma_loai_hinh_co_so);

            $dang_ki_chi_tieu = $this->repository->getDangKiChiTieuTuyenSinhTimeFromTo($co_s->id, $fromDate, $toDate);

            if ($co_s->loai_truong !== $bacDaoTaoId) {

                $bacDaoTaoId = $co_s->loai_truong;

                $bacDaoTao = $this->bacDaoTaoOfTruong($co_s->loai_truong);

                $worksheet->setCellValue('C' . $row, $bacDaoTao);

                $worksheet->getStyle("C{$row}")->getFont()->setBold(true);
                $lockRange = "A{$row}:J{$row}";
                $worksheet->getStyle($lockRange)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('C7C7C7');

                $worksheet->getStyle($lockRange)
                    ->getProtection()
                    ->setLocked(Protection::PROTECTION_PROTECTED);
                $row++;
            }
            $worksheet->setCellValue("C{$row}", 'Trường: ' . $co_s->ten . ' - ' . $co_s->id);
            $worksheet->getStyle("C{$row}")->getFont()->setBold(true);
            // tô nâu nền trường
            $worksheet->getStyle("A{$row}:J{$row}")
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('C7C7C7');

            foreach ($arrayAphabe as $apha) {
                $worksheet->getStyle($apha . $row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }


            foreach ($dang_ki_chi_tieu as $dkct) {
                $soThuTu++;
                $row++;
                // border cac o
                foreach ($arrayAphabe as $apha) {
                    $worksheet->getStyle($apha . $row)
                        ->getBorders()
                        ->getAllBorders()
                        ->setBorderStyle(Border::BORDER_THIN);
                }
                $worksheet->setCellValue('A' . $row, $soThuTu);

                $worksheet->setCellValue('C' . $row, $dkct->ten_nganh_nghe);
                $worksheet->setCellValue('B' . $row, $dkct->nghe_id);

                $worksheet->setCellValue($keyDanhdau . $row, 'X');
                // fill data
                $worksheet->setCellValue('H' . $row, $dkct->tong);
                $worksheet->setCellValue('I' . $row, $dkct->so_dang_ki_CD);
                $worksheet->setCellValue('J' . $row, $dkct->so_dang_ki_TC);
            }
        }

        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name = "[{$ngayBatDau} - {$ngayDen}] File-xuat-chi-tieu-tuyen-sinh.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $file_xuat_name);
        $writer->save("php://output");
    }



    public function importError($fileRead, $duoiFile, $path)
    {
        $fileReadStorage = storage_path('app/public/' . $path);

        $spreadsheet = $this->createSpreadSheet($fileReadStorage, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe = ['I', 'J'];

        $vitri =   $this->checkError($data, $arrayAphabe, 8, 8, 9);

        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);

        for ($i = 0; $i < count($vitri); $i++) {
            $worksheet->getStyle($vitri[$i])
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
            //  màu ô
            $worksheet->getStyle($vitri[$i])->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFFF0000');
        }

        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-chi-tieu-tuyen-sinh.xlsx"');
        $writer->save("php://output");
    }


    public function importFile($fileRead, $duoiFile, $year, $dot)
    {
        $message = '';
        $spreadsheet = $this->createSpreadSheet($fileRead, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[7][2]);
        $id_truong = trim(array_pop($truong));

        $arrayAphabe = ['I', 'J'];

        $csCheck = DB::table('co_so_dao_tao')->find($id_truong);

        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_truong);

        if ($csCheck == null) {
            $message = 'noCorrectIdTruong';
            return $message;
        }

        $id_nghe_of_cs = [];
        foreach ($co_so_nghe as $csn) {
            array_push($id_nghe_of_cs, $csn->id);
        }

        $dang_ki_chi_tieu_da_co = $this->repository->getDangKiChiTieuTuyenSinhCsNamDot($id_truong, $year, $dot);

        $id_nghe_dkct_da_co = [];
        for ($i = 0; $i < count($dang_ki_chi_tieu_da_co); $i++) {
            $id_nghe_dkct_da_co[$dang_ki_chi_tieu_da_co[$i]->nghe_id] = $dang_ki_chi_tieu_da_co[$i]->id;
        }

        $vitri =   $this->checkError($data, $arrayAphabe, 8, 8, 9);

        if (count($vitri) > 0) {
            $message = 'errorkitu';
            return $message;
        }

        $arrayData = [];
        $insertData = [];
        $updateData = [];
        $soDongNgNhap = (count($data) - 8);

        if ($soDongNgNhap == count($co_so_nghe)) {
            if ($vitri == null || $vitri == '') {
                for ($i = 8; $i < count($data); $i++) {
                    $nghe = explode(' - ', $data[$i][1]);
                    $id_nghe_nhap = array_pop($nghe);
                    if (in_array($id_nghe_nhap, $id_nghe_of_cs)) {

                        $arrayData = [
                            'nam' => $year,
                            'dot' => $dot,
                            'nghe_id' => $id_nghe_nhap,
                            'co_so_id' => $id_truong,

                            'tong' => $data[$i][7],
                            'so_dang_ki_CD' => $data[$i][8],
                            'so_dang_ki_TC' => $data[$i][9],
                        ];
                        if (array_key_exists($id_nghe_nhap, $id_nghe_dkct_da_co)) {
                            $updateData[$id_nghe_dkct_da_co[$id_nghe_nhap]] = $arrayData;
                        } else {
                            $this->repository->createChiTieuTuyenSinh($arrayData);

                        }
                    } else if (in_array($id_nghe_nhap, $id_nghe_of_cs) == false) {
                        $message = 'ngheKoThuocTruong';
                        return $message;
                    };
                }
                if (count($updateData) > 0) {
                    foreach ($updateData as $key => $value)
                        $this->repository->updateChiTieuTuyenSinh($key, $value);
                    //  DB::table('dang_ki_chi_tieu_tuyen_sinh')->where('id',$key)->update($value);
                }
                
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Chỉ tiêu tuyển sinh';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh', ['co_so_id' => $id_truong]);
                $this->StoreUpdateNotificationService->addContentUpExecl($year, $dot, $id_truong, count($insertData), count($updateData), $bm, $route, $tencoso);

                $message = 'ok';
                return $message;
            }
        } else if ($soDongNgNhap != count($co_so_nghe)) {
            $message = 'NgheUnsign';
            return $message;
        }
    }

    public function updateData($id, $request)
    {
        $attributes = $request->all();
        unset($attributes['_token']);
        $resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array) $dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if ($resurt) {
            $tieude = 'Cập nhật ( ' . $thongTinCoSo->ten . ' )';
            $noidung = 'Cập nhật số liệu đội ngũ quản lý nhà giáo';
            $route = route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh', ['co_so_id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'], $getdata['dot'], $getdata['co_so_id'], $tieude, $noidung, $route);
        }
        return $resurt;
    }

    public function store($data)
    {
        $returnData = $this->chiTieuTuyenSinhRepository->store($data);
        if ($returnData) {
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($data['co_so_id']);
            $tieude = 'Thêm mới ( ' . $thongTinCoSo->ten . ' )';
            $noidung = 'Thêm mới số liệu chỉ tiêu tuyển sinh';
            $route = route('xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh', ['co_so_id' => $data['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($data['nam'], $data['dot'], $data['co_so_id'], $tieude, $noidung, $route);
        }
        return $returnData;
    }
}
