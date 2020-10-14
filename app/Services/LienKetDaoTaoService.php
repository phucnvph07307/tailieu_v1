<?php

namespace App\Services;

use App\Repositories\LienKetDaoTaoRepository;
use App\Repositories\SoLieuTuyenSinhInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Storage;
use App\Services\StoreUpdateNotificationService;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class LienKetDaoTaoService extends AppService
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
        return LienKetDaoTaoRepository::class;
    }

    public function getTongHopLienKetDaoTao($params = [], $limit)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        return $this->repository->getTongHopLienKetDaoTao($queryData, $limit);
    }
    public function getTongHopLienKetDaoTaoTheoTrinhDo($params = [], $limit, $id)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        return $this->repository->getTongHopLienKetDaoTaoTheoTrinhDo($queryData, $limit, $id);
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

    public function chitietlienketdaotao($co_so_id, $params, $limit, $bac_nghe)
    {
        $queryData = [];
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : null;
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : null;
        $data = $this->repository->chitietlienketdaotao($co_so_id, $queryData, $limit, $bac_nghe);

        return $data;
    }

    public function findCoSoDaoTao($co_so_id)
    {
        return $this->repository->findCoSoDaoTao($co_so_id);
    }
    public function sualienketdaotao($id, $bac_nghe)
    {
        $data = $this->repository->sualienketdaotao($id, $bac_nghe);
        return $data;
    }

    public function updateData($id, $request,$bac_nghe)
    {
        $attributes = $request->all();
        unset($attributes['_token']);
        $resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
            if ($bac_nghe == 6) {
                $noidung = 'Cập nhật số liệu liên kết đào tạo cao đẳng';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);
            }
            if ($bac_nghe == 5) {
                $noidung = 'Cập nhật số liệu liên kết đào tạo trung cấp';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);

            } 
            if ($bac_nghe == 0) {
                $noidung = 'Cập nhật số liệu liên kết đào tạo ';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);
            }
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function postthemlienketdaotao($getdata,$id)
    {
        unset($getdata['_token']);
        $data = $this->repository->postthemlienketdaotao($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            if ($id == 6) {
                $noidung = 'Thêm mới số liệu liên kết đào tạo cao đẳng';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);
            }
            if ($id == 5) {
                $noidung = 'Thêm mới số liệu liên kết đào tạo trung cấp';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);

            } 
            if ($id == 0) {
                $noidung = 'Thêm mới số liệu liên kết đào tạo ';
                $route = route('xuatbc.chi-tiet-lien-ket-dao-tao', ['co_so_id' => $getdata['co_so_id'],'bac_nghe'=>$id]);
            }
           
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }

    public function getCheckTonTaiLienKetDaoTao($data, $requestParams, $id)
    {
        $checkResult = $this->getSoLieu($data);

        unset($requestParams['_token']);
        if ($id == 6) {
            $route = route('xuatbc.them-lien-ket-dao-tao-cao-dang');
        }
        if ($id == 5) {
            $route = route('xuatbc.them-lien-ket-dao-tao-trung-cap');
        } else {
            $route = route('xuatbc.them-lien-ket-dao-tao');
        }

        if ($checkResult == 'tontai') {
            $message = 'Liên kết đào tạo đã tồn tại';
        }

        if (!isset($checkResult)) {
            $data = $this->postthemlienketdaotao($requestParams,$id);
            if ($id == 6) {
                $route = route('xuatbc.tong-hop-lien-ket-dao-tao-cao-dang', ['id' => $id]);
            }
            if ($id == 5) {
                $route = route('xuatbc.tong-hop-lien-ket-dao-tao-trung-cap', ['id' => $id]);
            } else {
                $route = route('xuatbc.tong-hop-lien-ket-dao-tao');
            }
            $message = 'Thêm liên kết đào tạo thành công';
        }

        return ['route' => $route, 'message' => $message];
    }

    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->getCheckTonTaiLienKetDaoTao($dataCheckNew);
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

    // thanhnv import export  6/19/2020

    public function exportFillRow($worksheet, $row, $lt_dao_tao)
    {
        $worksheet->setCellValue('B' . $row, $lt_dao_tao->ten_nganh_nghe . ' - ' . $lt_dao_tao->nghe_id);
        $worksheet->setCellValue('C' . $row, $lt_dao_tao->chi_tieu);

        $worksheet->setCellValue('D' . $row, $lt_dao_tao->thuc_tuyen);
        $worksheet->setCellValue('E' . $row, $lt_dao_tao->so_HSSV_tot_nghiep);
        $worksheet->setCellValue('F' . $row, $lt_dao_tao->don_vi_lien_ket);

        $worksheet->setCellValue('G' . $row, $lt_dao_tao->ghi_chu);
    }

    public function writeTieuDe($worksheet, $row)
    {
        $arrayKeyApha = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $worksheet->mergeCells("A{$row}:A" . ($row + 3));
        $worksheet->mergeCells("B{$row}:B" . ($row + 3));
        $worksheet->mergeCells("C{$row}:C" . ($row + 3));
        $worksheet->mergeCells("D{$row}:D" . ($row + 3));
        $worksheet->mergeCells("E{$row}:E" . ($row + 3));
        $worksheet->mergeCells("F{$row}:F" . ($row + 3));
        $worksheet->mergeCells("G{$row}:G" . ($row + 3));

        $worksheet->getStyle("A{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("C{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("D{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("E{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("F{$row}")->getFont()->setBold(true);
        $worksheet->getStyle("G{$row}")->getFont()->setBold(true);

        $worksheet->getStyle("A{$row}:B{$row}")->getAlignment()->setHorizontal('center');
        $worksheet->getStyle("C{$row}:D{$row}")->getAlignment()->setHorizontal('center');
        $worksheet->getStyle("E{$row}:F{$row}")->getAlignment()->setHorizontal('center');
        $worksheet->getStyle("G{$row}")->getAlignment()->setHorizontal('center');

        $worksheet->getStyle("A{$row}:B{$row}")->getAlignment()->setVertical('center');
        $worksheet->getStyle("C{$row}:D{$row}")->getAlignment()->setVertical('center');
        $worksheet->getStyle("E{$row}:F{$row}")->getAlignment()->setVertical('center');
        $worksheet->getStyle("G{$row}")->getAlignment()->setVertical('center');

        foreach ($arrayKeyApha as $akey) {
            $worksheet->getStyle("A{$row}:A" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("B{$row}:B" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("C{$row}:C" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("D{$row}:D" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("E{$row}:E" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("F{$row}:F" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $worksheet->getStyle("G{$row}:G" . ($row + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        }
    }

    public function exportBieuMau($id_coso)
    {

        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/bm16/bm16.xlsx');

        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->setCellValue('A3', "1. Liên kết liên thông trình độ cao đẳng lên đại học");
        $worksheet->setCellValue('B9', "Trường: $co_so->ten - $id_coso");
        $worksheet->getStyle("B9")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A9:G9")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);


        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);
        $lien_ket_dao_tao_cs_Cao_dang = $this->repository->getLkDaoTaoCsCaoDang($id_coso);
        $lien_ket_dao_tao_cs_Trung_Cap = $this->repository->getLkDaoTaoCsTrungCap($id_coso);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $row = 9;
        $sothutuCaoDang = 0;
        foreach ($lien_ket_dao_tao_cs_Cao_dang as $cs_n_cao_dang) {
            $row++;
            $sothutuCaoDang++;
            $worksheet->setCellValue('A' . $row, $sothutuCaoDang);
            $worksheet->setCellValue('B' . $row, $cs_n_cao_dang->ten_nganh_nghe . ' - ' . $cs_n_cao_dang->id);

            $worksheet->getStyle('A' . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('B' . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        };

        $row++;
        $arrayLock = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
        $this->lockedCellInExcel($worksheet, $arrayLock);

        $arrayKeyApha = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $row++;
        $worksheet->setCellValue('A' . $row, '2. Liên kết đào tạo từ trung cấp lên đại học');
        $arrayLock = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
        $this->lockedCellInExcel($worksheet, $arrayLock);

        $worksheet->getStyle("A" . $row)->getFont()->setBold(true);
        $row = $row + 1;

        $arrayLock = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
        $this->lockedCellInExcel($worksheet, $arrayLock);

        $row++;
        $worksheet->setCellValue('A' . $row, 'TT');
        $worksheet->setCellValue('B' . $row, 'Tên cơ sở GDNN và tên nghề đào tạo');
        $worksheet->setCellValue('C' . $row, 'Chỉ tiêu được giao');
        $worksheet->setCellValue('D' . $row, 'Thực tuyển');
        $worksheet->setCellValue('E' . $row, "Số học sinh tốt nghiệp");
        $worksheet->setCellValue('F' . $row, "Đơn vị liên kết");
        $worksheet->setCellValue('G' . $row, "Ghi chú");

        $arrayLock = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
        $this->lockedCellInExcel($worksheet, $arrayLock);

        // vẽ tiêu đề cho trung cấp
        $this->writeTieuDe($worksheet, $row);
        $row = $row + 4;

        //  CỘNG 4 vì 3 thêm 1 của dòng tên trường
        $worksheet->setCellValue('B' . $row, "Trường: $co_so->ten - $id_coso");
        $worksheet->getStyle("B" . $row)->getFont()->setBold(true);
        $arrayLock2 = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
        $this->lockedCellInExcel($worksheet, $arrayLock2);
        // tô nâu nền trường
        $worksheet->getStyle("A{$row}:G{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');


        $sothutuTrungCap = 0;
        foreach ($lien_ket_dao_tao_cs_Trung_Cap as $cs_n_trung_cap) {
            $row++;
            $sothutuTrungCap++;
            $worksheet->setCellValue('A' . $row, $sothutuTrungCap);
            $worksheet->setCellValue('B' . $row, $cs_n_trung_cap->ten_nganh_nghe . ' - ' . $cs_n_trung_cap->id);

            $worksheet->getStyle('A' . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            $worksheet->getStyle('B' . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        };

        //  khóa 10 dòng dưới 
        for ($i = 0; $i < 10; $i++) {
            $row++;
            $arrayLock = ['A' . $row, 'B' . $row, 'C' . $row, 'D' . $row, 'E' . $row, 'F' . $row, 'G' . $row];
            $this->lockedCellInExcel($worksheet, $arrayLock);
        }


        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-nhap-lien-ket-dao-tao.xlsx"');
        $writer->save("php://output");
    }

    public function exportData($id_coso, $fromDate, $toDate)
    {

        $spreadsheet = IOFactory::load('file_excel/bm16/bm16.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);

        $arrayAphabe = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];


        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $bacDaoTao = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A3', "1. Liên kết liên thông trình độ cao đẳng lên đại học");
        $worksheet->setCellValue('B9', "Trường: $co_so->ten - $id_coso");
        $worksheet->getStyle("B9")->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A9:G9")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getColumnDimension('B')->setAutoSize(true);


        $co_so_nghe = $this->soLieuTuyenSinhRepository->getmanganhnghe($id_coso);
        $lien_ket_dao_tao_cs_Cao_dang = $this->repository->getLkDaoTaoCsTimeCaoDang($id_coso, $fromDate, $toDate);
        $lien_ket_dao_tao_cs_Trung_Cap = $this->repository->getLkDaoTaoCsTimeTrungCap($id_coso, $fromDate, $toDate);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);


        $row = 9;
        $sothutuCaoDang = 0;
        foreach ($lien_ket_dao_tao_cs_Cao_dang as $cs_n_cao_dang) {
            $row++;
            $sothutuCaoDang++;
            $worksheet->setCellValue('A' . $row, $sothutuCaoDang);
            $worksheet->setCellValue('B' . $row, $cs_n_cao_dang->ten_nganh_nghe . ' - ' . $cs_n_cao_dang->id);
            $worksheet->setCellValue('C' . $row, $cs_n_cao_dang->chi_tieu);
            $worksheet->setCellValue('D' . $row, $cs_n_cao_dang->thuc_tuyen);
            $worksheet->setCellValue('E' . $row, $cs_n_cao_dang->so_HSSV_tot_nghiep);
            $worksheet->setCellValue('F' . $row, $cs_n_cao_dang->don_vi_lien_ket);
            $worksheet->setCellValue('G' . $row, $cs_n_cao_dang->ghi_chu);

            foreach ($arrayAphabe as $arpha) {
                $worksheet->getStyle($arpha . $row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }
        };


        $arrayKeyApha = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $row = $row + 2;
        $worksheet->setCellValue('A' . $row, '2. Liên kết đào tạo từ trung cấp lên đại học');
        $worksheet->getStyle("A" . $row)->getFont()->setBold(true);
        $row = $row + 1;
        $row++;
        $worksheet->setCellValue('A' . $row, 'TT');
        $worksheet->setCellValue('B' . $row, 'Tên cơ sở GDNN và tên nghề đào tạo');
        $worksheet->setCellValue('C' . $row, 'Chỉ tiêu được giao');
        $worksheet->setCellValue('D' . $row, 'Thực tuyển');
        $worksheet->setCellValue('E' . $row, "Số học sinh tốt nghiệp");
        $worksheet->setCellValue('F' . $row, "Đơn vị liên kết");
        $worksheet->setCellValue('G' . $row, "Ghi chú");
        // vẽ tiêu đề cho trung cấp
        $this->writeTieuDe($worksheet, $row);
        $row = $row + 4;
        //  CỘNG 4 vì 3 thêm 1 của dòng tên trường
        $worksheet->setCellValue('B' . $row, "Trường: $co_so->ten - $id_coso");
        $worksheet->getStyle("B" . $row)->getFont()->setBold(true);
        // tô nâu nền trường
        $worksheet->getStyle("A{$row}:G{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');


        $sothutuTrungCap = 0;
        foreach ($lien_ket_dao_tao_cs_Trung_Cap as $cs_n_trung_cap) {
            $row++;
            $sothutuTrungCap++;
            $worksheet->setCellValue('A' . $row, $sothutuTrungCap);
            $worksheet->setCellValue('B' . $row, $cs_n_trung_cap->ten_nganh_nghe . ' - ' . $cs_n_trung_cap->id);
            $worksheet->setCellValue('C' . $row, $cs_n_trung_cap->chi_tieu);
            $worksheet->setCellValue('D' . $row, $cs_n_trung_cap->thuc_tuyen);
            $worksheet->setCellValue('E' . $row, $cs_n_trung_cap->so_HSSV_tot_nghiep);
            $worksheet->setCellValue('F' . $row, $cs_n_trung_cap->don_vi_lien_ket);
            $worksheet->setCellValue('G' . $row, $cs_n_trung_cap->ghi_chu);

            foreach ($arrayAphabe as $arpha) {
                $worksheet->getStyle($arpha . $row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }
        };
        $ngayBatDau = date("d-m-Y", strtotime($fromDate));
        $ngayDen = date("d-m-Y", strtotime($toDate));

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $file_xuat_name="[{$ngayBatDau} - {$ngayDen}] File-xuat-lien-ket-dao-tao.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }

    public function importFile($fileRead, $duoiFile, $year, $dot)
    {
        $message = '';
        $spreadsheet = $this->createSpreadSheet($fileRead, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $truong = explode(' - ', $data[8][1]);
        $id_truong = trim(array_pop($truong));


        $csCaodang =  $this->repository->getLkDaoTaoCsCaoDang($id_truong);
        $csTrungCap =  $this->repository->getLkDaoTaoCsTrungCap($id_truong);

        // đọc những phần nghề cao đẳng và trung cấp rồi cho vào arrayDuLieu
        $tongNgheCaoDang = count($csCaodang);
        $tongNgheTrungCap = count($csTrungCap);

        $loi = [];
        $arrayDuLieu = [];
        $rowDemDong = 9;
        $congCaoDang = 9 + $tongNgheCaoDang;
        if ($tongNgheCaoDang > 0) {
            for ($i = 9; $i < $congCaoDang; $i++) {
                $rowDemDong++;
                array_push($arrayDuLieu, $data[$i]);
                array_push($loi, $i + 1);
            }
        }

        $rowDemDong = $rowDemDong + 8;
        $congTrungCap = $rowDemDong + $tongNgheTrungCap;
        if ($tongNgheTrungCap > 0) {
            for ($j = $rowDemDong; $j < $congTrungCap; $j++) {
                $rowDemDong++;
                array_push($arrayDuLieu, $data[$j]);
                array_push($loi, $j + 1);
            }
        }


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


        $lk_dao_tao_da_co = $this->repository->getLkDaoTaoCsNamDot($id_truong, $year, $dot);
        $id_nghe_lkdt_da_co = [];
        for ($i = 0; $i < count($lk_dao_tao_da_co); $i++) {
            $id_nghe_lkdt_da_co[$lk_dao_tao_da_co[$i]->nghe_id] = $lk_dao_tao_da_co[$i]->id;
        }

        // check loi
        $arrayRunForError = ['C', 'D', 'E'];
        $vitri = [];
        for ($i = 0; $i < count($arrayDuLieu); $i++) {
            $key_aphabel = -1;
            $rowNumber = $i + 1;
            for ($j = 2; $j < 5; $j++) {
                // 5 vì bỏ CỘT F G
                $key_aphabel++;
                if ((is_string($arrayDuLieu[$i][$j])) || ($arrayDuLieu[$i][$j] < 0)) {
                    array_push($vitri, $arrayRunForError[$key_aphabel] . $loi[$i]);
                }
            }
        }


        if (count($vitri) > 0) {
            $message = 'errorkitu';
            return $message;
        }

        $arrayData = [];
        $insertData = [];
        $updateData = [];

        if (count($vitri) <= 0) {
            for ($i = 0; $i < count($arrayDuLieu); $i++) {
                $nghe = explode(' - ', $arrayDuLieu[$i][1]);
                $id_nghe_nhap = array_pop($nghe);
                if (in_array($id_nghe_nhap, $id_nghe_of_cs)) {
                    $arrayData = [
                        'nam' => $year,
                        'dot' => $dot,
                        'nghe_id' => $id_nghe_nhap,
                        'co_so_id' => $id_truong,
                        'chi_tieu' => $arrayDuLieu[$i][2],
                        'thuc_tuyen' => $arrayDuLieu[$i][3],
                        'so_HSSV_tot_nghiep' => $arrayDuLieu[$i][4],
                        'don_vi_lien_ket' => $arrayDuLieu[$i][5],
                        'ghi_chu' => $arrayDuLieu[$i][6],
                    ];
                    if (array_key_exists($id_nghe_nhap, $id_nghe_lkdt_da_co)) {
                        $updateData[$id_nghe_lkdt_da_co[$id_nghe_nhap]] = $arrayData;
                    } else {
                       $this->repository->createLienKetDaoTao($arrayData);
                    }
                } else if (in_array($id_nghe_nhap, $id_nghe_of_cs) == false) {
                    $message = 'ngheKoThuocTruong';
                    return $message;
                };
            }
            if (count($updateData) > 0) {
                foreach ($updateData as $key => $value) {
                    $this->repository->updateLienKetDaoTao($key, $value);
                }
            }
     
            $message = 'ok';
            return $message;
        }
    }


    public function importError($fileRead, $duoiFile, $path)
    {
        $fileReadStorage = storage_path('app/public/' . $path);

        $spreadsheet = $this->createSpreadSheet($fileReadStorage, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[8][1]);
        $id_truong = trim(array_pop($truong));


        $csCaodang =  $this->repository->getLkDaoTaoCsCaoDang($id_truong);
        $csTrungCap =  $this->repository->getLkDaoTaoCsTrungCap($id_truong);

        $tongNgheCaoDang = count($csCaodang);
        $tongNgheTrungCap = count($csTrungCap);

        $arrayApha = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $loi = [];
        $arrayDuLieu = [];


        $rowDemDong = 9;
        $congCaoDang = 9 + $tongNgheCaoDang;
        if ($tongNgheCaoDang > 0) {
            for ($i = 9; $i < $congCaoDang; $i++) {
                $rowDemDong++;
                array_push($arrayDuLieu, $data[$i]);
                array_push($loi, $i + 1);
            }
        }

        $rowDemDong = $rowDemDong + 8;
        $congTrungCap = $rowDemDong + $tongNgheTrungCap;
        if ($tongNgheTrungCap > 0) {
            for ($j = $rowDemDong; $j < $congTrungCap; $j++) {
                $rowDemDong++;
                array_push($arrayDuLieu, $data[$j]);
                array_push($loi, $j + 1);
            }
        }

        // check Error
        $arrayRunForError = ['C', 'D', 'E'];
        // 0 2 4
        $vitri = $this->checkError($arrayDuLieu, $arrayRunForError, 0, 2, 4);

        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);

        $this->errorRebBackGroud($vitri, $worksheet);

        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-lien-ket-dao-tao.xlsx"');
        $writer->save("php://output");
    }
}
