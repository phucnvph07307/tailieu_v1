<?php

namespace App\Services;

use App\Repositories\DoiNguNhaGiaoInterface;
use App\Repositories\DoiNguNhaGiaoRepository;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Repositories\CoSoDaoTaoRepositoryInterface;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;
use DB;
use App\Services\StoreUpdateNotificationService;

class DoiNguNhaGiaoService extends AppService
{
    protected $csdtRepository;
    protected $doiNguNhaGiaoRepo;
    protected $StoreUpdateNotificationService;

    public function __construct(
        CoSoDaoTaoRepositoryInterface $csdtRepository,
        DoiNguNhaGiaoInterface $doiNguNhaGiaoRepo,
        StoreUpdateNotificationService $StoreUpdateNotificationService
    ) {
        parent::__construct();
        $this->csdtRepository = $csdtRepository;
        $this->doiNguNhaGiaoRepo = $doiNguNhaGiaoRepo;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
    }

    public function getRepository()
    {
        return DoiNguNhaGiaoRepository::class;
    }

    public function getDanhSachDoiNguNhaGiao($params)
    {
        return $this->repository->getDanhSachDoiNguNhaGiao($params);
    }

    public function getNganhNgheTheoCoSo($co_so_id)
    {
        return $this->repository->getNganhNgheTheoCoSo($co_so_id);
    }

    public function chiTietTheoCoSo($co_so_id, $params)
    {
        return $this->repository->chiTietTheoCoSo($co_so_id, $params);
    }

    public function checkTonTaiKhiThem($params)
    {
        return $this->repository->checkTonTaiKhiThem($params);
    }

    public function getAllByCoSo($coSoId, $params)
    {
        return $this->csdtRepository->getDoiNguNhaGiaoTheoCoSo($coSoId, $params);
    }

    public function exportFillRow($worksheet, $row, $doiNguNhaGiao, $loaiHinhCol)
    {
        // Với data fake, nganhNghe có thể bị null
        $worksheet->setCellValue('B' . $row, $doiNguNhaGiao->nganhNghe->ten_nganh_nghe);

        $worksheet->setCellValue($loaiHinhCol . $row, 'x');
        $worksheet->setCellValue('G' . $row, $doiNguNhaGiao->tong_so_can_bo);
        $worksheet->setCellValue('H' . $row, $doiNguNhaGiao->so_luong_nu);
        $worksheet->setCellValue('I' . $row, $doiNguNhaGiao->dan_toc_it_nguoi);
        $worksheet->setCellValue('J' . $row, $doiNguNhaGiao->giao_su);
        $worksheet->setCellValue('K' . $row, $doiNguNhaGiao->pho_giao_su);
        $worksheet->setCellValue('L' . $row, $doiNguNhaGiao->NGND_NSND_NNND_TTND);
        $worksheet->setCellValue('M' . $row, $doiNguNhaGiao->NGUT_NSUT_NNUT_TTUT);
        $worksheet->setCellValue('N' . $row, $doiNguNhaGiao->nha_giao_giang_day_mon_hoc_chung);
        $worksheet->setCellValue('O' . $row, $doiNguNhaGiao->bien_che);
        $worksheet->setCellValue('P' . $row, $doiNguNhaGiao->hop_dong_1_nam_tro_len);
        $worksheet->setCellValue('Q' . $row, $doiNguNhaGiao->so_tien_sy);
        $worksheet->setCellValue('R' . $row, $doiNguNhaGiao->so_thac_si);
        $worksheet->setCellValue('S' . $row, $doiNguNhaGiao->so_dai_hoc);
        $worksheet->setCellValue('T' . $row, $doiNguNhaGiao->so_cao_dang);
        $worksheet->setCellValue('U' . $row, $doiNguNhaGiao->so_trung_cap);
        $worksheet->setCellValue('V' . $row, $doiNguNhaGiao->so_khac);
        $worksheet->setCellValue('W' . $row, $doiNguNhaGiao->bac1);
        $worksheet->setCellValue('X' . $row, $doiNguNhaGiao->bac2);
        $worksheet->setCellValue('Y' . $row, $doiNguNhaGiao->bac3);
        $worksheet->setCellValue('Z' . $row, $doiNguNhaGiao->bac4);
        $worksheet->setCellValue('AA' . $row, $doiNguNhaGiao->bac5);
        $worksheet->setCellValue('AB' . $row, $doiNguNhaGiao->bac6);
        $worksheet->setCellValue('AC' . $row, $doiNguNhaGiao->trinh_do_tin_hoc_co_ban);
        $worksheet->setCellValue('AD' . $row, $doiNguNhaGiao->trinh_do_tin_hoc_nang_cao);
        $worksheet->setCellValue('AE' . $row, $doiNguNhaGiao->chung_chi_KNN_quoc_gia_bac_1);
        $worksheet->setCellValue('AF' . $row, $doiNguNhaGiao->chung_chi_KNN_quoc_gia_bac_2);
        $worksheet->setCellValue('AG' . $row, $doiNguNhaGiao->chung_chi_KNN_quoc_gia_bac_3);
        $worksheet->setCellValue('AH' . $row, $doiNguNhaGiao->chung_chi_su_pham_day_trinh_do_CD);
        $worksheet->setCellValue('AI' . $row, $doiNguNhaGiao->chung_chi_su_pham_day_trinh_do_TC);
        $worksheet->setCellValue('AJ' . $row, $doiNguNhaGiao->chung_chi_su_pham_day_trinh_do_SC);
        $worksheet->setCellValue('AK' . $row, $doiNguNhaGiao->so_nha_giao_tham_gia_dao_tao);
    }

    public function export($listCoSoId, $nam = null, $dot = null)
    {
        $fillData = true;
        if ($nam === null && $dot === null) {
            $fillData = false;
        }

        $listCoSo = $this->csdtRepository->getListById($listCoSoId);
        $loadRelation = [
            'nganhNghe',
        ];

        if ($nam !== null && $dot !== null) {
            $loadRelation['soLieuDoiNguNhaGiao'] = function ($query) use ($nam, $dot) {
                $query->where('nam', $nam)
                    ->where('dot', $dot);
            };
        }

        $listCoSo->load($loadRelation);
        $spreadsheet = IOFactory::load('file_excel/so_luong_can_bo_nha_giao/bieu_mau_6.xlsx');
        $this->renderSheetContent($spreadsheet, $listCoSo, $fillData);

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="file-form-nhap.xlsx"');
        $writer->save("php://output");
    }

    protected function renderSheetContent($spreadsheet, $listCoSo, $fillData = false)
    {
        $worksheet = $spreadsheet->getActiveSheet();

        //  tạo khóa đê khóa các dòng
        $worksheet->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $row = 9;
        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
        $bacDaoTaoId = 0;
        foreach ($listCoSo as $coSo) {
            $row++;
            if ($coSo->bac_dao_tao !== $bacDaoTaoId) {
                $bacDaoTaoId = $coSo->bac_dao_tao;
                switch ($coSo->bac_dao_tao) {
                    case 4:
                        $bacDaoTao = 'TRƯỜNG SƠ CẤP';
                        break;
                    case 5:
                        $bacDaoTao = 'TRƯỜNG TRUNG CẤP';
                        break;
                    case 6:
                        $bacDaoTao = 'TRƯỜNG CAO ĐẲNG';
                        break;
                }

                $worksheet->setCellValue('B' . $row, $bacDaoTao);
                $worksheet->getStyle("B{$row}")->getFont()->setBold(true);
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
            $worksheet->setCellValue('B' . $row, "Trường: {$coSo->ten} - {$coSo->id}");
            $worksheet->getStyle("B{$row}")->getFont()->setBold(true);

            $lockRange = "A{$row}:AK{$row}";
            $worksheet->getStyle($lockRange)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setARGB('C7C7C7');

            $worksheet->getStyle($lockRange)
                ->getProtection()
                ->setLocked(Protection::PROTECTION_PROTECTED);

            $loaiHinhCol = $this->getLoaiHinhCol($coSo->ma_loai_hinh_co_so);
            foreach ($coSo->nganhNghe as $nghe) {
                $row++;
                $worksheet->setCellValue($loaiHinhCol . $row, 'x');
                $worksheet->setCellValue('B' . $row, $nghe->ten_nganh_nghe);

                if ($fillData) {
                    $soLieuNhaGiao = $coSo->soLieuDoiNguNhaGiao->where('nghe_id', $nghe->id);
                    if ($soLieuNhaGiao->count() !== 0) {
                        $this->exportFillRow($worksheet, $row, $soLieuNhaGiao->first(), $loaiHinhCol);
                    }
                }
            };
        }

        $worksheet->getStyle('A10:F' . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
        $worksheet->getStyle('A10:AK' . $row)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }

    protected function getLoaiHinhCol(int $loaiHinhCoSoId)
    {
        $loaiHinhCol = 'C';
        switch ($loaiHinhCoSoId) {
            case 4:
                $loaiHinhCol = 'C';
                break;
            case 9:
                $loaiHinhCol = 'E';
                break;
            case 14:
                $loaiHinhCol = 'F';
                break;
            case 15:
                $loaiHinhCol = 'D';
                break;
        }

        return $loaiHinhCol;
    }

    public function import($nam, $dot, $path, $fileExtension = 'xlsx')
    {
        $reader = strtolower($fileExtension) === 'xlsx' ?
            app()->make(Xlsx::class) : app()->make(Xls::class);

        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load(public_path('storage/' . $path));
        $worksheet = $spreadsheet->getActiveSheet();

        // Đọc cell B11 để lấy id cơ sở
        $coSoCellData = $worksheet->getCell('B11')->getValue();
        // $coSoId = trim(explode('-', $coSoCellData)[1]);

        // thanhnv fix bug loi 153
        $truongAll = explode(' - ', $coSoCellData);
        $coSoId = trim(array_pop($truongAll));

        $coSo = $this->csdtRepository->find($coSoId);
        $coSo->load([
            'nganhNghe'
        ]);

        $selects = [
            'nganh_nghe.ten_nganh_nghe',
            DB::raw('so_lieu_doi_ngu_nha_giao.id AS so_lieu_id'),
        ];

        $soLieuTheoNganhNghe = $this->repository
            ->getSoLieuTheoDot($coSoId, $nam, $dot, $selects)
            ->pluck('ten_nganh_nghe', 'so_lieu_id')
            ->toArray();

        $row = 11;
        $insertData = [];
        $updateData = [];

        $keys = [
            'tong_so_can_bo',
            'so_luong_nu',
            'dan_toc_it_nguoi',
            'giao_su',
            'pho_giao_su',
            'NGND_NSND_NNND_TTND',
            'NGUT_NSUT_NNUT_TTUT',
            'nha_giao_giang_day_mon_hoc_chung',
            'bien_che',
            'hop_dong_1_nam_tro_len',
            'so_tien_sy',
            'so_thac_si',
            'so_dai_hoc',
            'so_cao_dang',
            'so_trung_cap',
            'so_khac',
            'bac1',
            'bac2',
            'bac3',
            'bac4',
            'bac5',
            'bac6',
            'trinh_do_tin_hoc_co_ban',
            'trinh_do_tin_hoc_nang_cao',
            'chung_chi_KNN_quoc_gia_bac_1',
            'chung_chi_KNN_quoc_gia_bac_2',
            'chung_chi_KNN_quoc_gia_bac_3',
            'chung_chi_su_pham_day_trinh_do_CD',
            'chung_chi_su_pham_day_trinh_do_TC',
            'chung_chi_su_pham_day_trinh_do_SC',
            'so_nha_giao_tham_gia_dao_tao',
        ];

        while (true) {
            $row++;
            $nganhNghe = $worksheet->getCell('B' . $row)->getValue();

            if (empty($nganhNghe)) {
                break;
            }

            /*
            * Các trường sẽ import file riêng biệt nên cột B chỉ chứa tên cơ sở & tên nghề
            * nên các nghề được import sẽ chỉ đọc từ cell B12.
            */
            $rowData = $worksheet->rangeToArray("G{$row}:AK{$row}")[0];

            // Import range: G12:AK{$row}
            $flipArrSoLieu = array_flip($soLieuTheoNganhNghe);
            if (in_array($nganhNghe, $soLieuTheoNganhNghe)) {
                $updateData[$flipArrSoLieu[$nganhNghe]] = array_combine($keys, $rowData);
            } else {
                $data = array_combine($keys, $rowData);
                $nghe = $coSo->nganhNghe->where('ten_nganh_nghe', trim($nganhNghe));
                if ($nghe === null) {
                    continue;
                }
                $data['nghe_id'] = $nghe->first()->id;
                $data['nam'] = $nam;
                $data['dot'] = $dot;
                $insertData[] = $data;
            }
        }

        if (count($updateData) > 0) {
            foreach ($updateData as $key => $data) {
                $this->repository->update($key, $data);
            }
        }

        if (count($insertData) > 0) {
            $this->repository->insert($insertData);
        }

        $thongTinCoSo = $this->csdtRepository->getThongTinCoSo($id_truong);
        $bm = 'Đội ngũ nhà giáo';
        $tencoso = $thongTinCoSo->ten;
        $route = route('xuatbc.chi-tiet-theo-co-so',['co_so_id' => $getdata['co_so_id']]);
        $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($insertData),count($updateData),$bm,$route,$tencoso);


        return true;
    }

    public function getAllCoSoDaoTao(){
        return $this->csdtRepository->getAll();
    }

    public function updateData($id, $request)
    {
        $attributes = $request->all();
        unset($attributes['_token']);
        $resurt = $this->repository->update($id, $attributes);
        $dataFindId = $this->repository->findById($id);
        $getdata = (array)$dataFindId;
        $thongTinCoSo = $this->csdtRepository->getThongTinCoSo($getdata['co_so_id']);
        if($resurt){         
            $tieude = 'Cập nhật ( '.$thongTinCoSo->ten.' )';
			$noidung = 'Cập nhật số liệu đội ngũ quản lý nhà giáo';
			$route = route('xuatbc.chi-tiet-theo-co-so',['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function store($getdata)
    {
        $returnData = $this->doiNguNhaGiaoRepo->insert($getdata);
        if($returnData){
            $thongTinCoSo = $this->csdtRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu đội ngũ quản lý nhà giáo';
            $route = route('xuatbc.chi-tiet-theo-co-so',['co_so_id' => $getdata['co_so_id']]);
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $returnData;
    }
}