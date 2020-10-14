<?php

namespace App\Services;

use App\Repositories\ChinhSachSinhVienRepository;
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

class ChinhSachSinhVienService extends AppService
{
    use ExcelTraitService;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;
    public function __construct(
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
    }

    public function getRepository()
    {
        return ChinhSachSinhVienRepository::class;
    }

    public function getChinhSachSinhVien($params = [], $limit)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['chinhsach'] = isset($params['chinhsach']) ? $params['chinhsach'] : 1;
        return $this->repository->getChinhSachSinhVien($queryData, $limit);
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
			$noidung = 'Cập nhật số liệu chính sách sinh viên';
			$route = route('xuatbc.tong-hop-chinh-sach-sinh-vien');
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

    public function postthemChinhSachSinhVien($getdata)
    {
        unset($getdata['_token']);
        $data = $this->repository->postthemChinhSachSinhVien($getdata);
        if($data){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($getdata['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới \số liệu chính sách sinh viên';
            $route = route('xuatbc.tong-hop-chinh-sach-sinh-vien');
            $this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);

        }
        return $data;
    }
    public function checktontaiChinhSachSinhVien($data, $requestParams)
    {
        $kqkiemtra = $this->getSoLieu($data);

        unset($requestParams['_token']);
        $route = route('xuatbc.them-chinh-sach-sinh-vien');

        if ($kqkiemtra == 'tontai') {
            $mess = 'Số liệu chính sách sinh viên đã tồn tại';
        }
        if (!isset($kqkiemtra)) {

            $data = $this->postthemChinhSachSinhVien($requestParams);
            $route = route('xuatbc.tong-hop-chinh-sach-sinh-vien');
            $mess = 'Thêm số liệu tuyển sinh thành công';
        }

        return ['route' => $route, 'mess' => $mess];
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

    public function getSoLieu($data)
    {
        $dataCheckNew = $this->constructConditionParams($data);

        return $this->repository->checktontaiChinhSachSinhVien($dataCheckNew);
    }

    public function getsuaChinhSachSinhVien($id)
    {
        return $this->repository->getsuaChinhSachSinhVien($id);
    }

    // thanh nv update 6/25/2020

    public function exportBieuMau($id_coso)
    {
        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/chinhsachsv/cs-sinhvien.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('B9', "Trường: $co_so->ten - $id_coso ");

        $loai_truong = $this->bacDaoTaoOfTruong($co_so->loai_truong);
        $worksheet->setCellValue('B8', $loai_truong);

        $worksheet->getStyle("B8")->getFont()->setBold(true);
        $worksheet->getStyle("A8:I8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A9:I9")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');

        $worksheet->getColumnDimension('B')->setAutoSize(true);
        //   tạo khóa khóa các dòng
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $chinh_sach = DB::table('chinh_sach')->orderby('id', 'asc')->get();
        $arrayAphabe = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        $rowNumber = 9;
        foreach ($chinh_sach as $cs) {
            $rowNumber++;
            $worksheet->setCellValue('B' . $rowNumber, $cs->ten);
            $worksheet->getStyle('B' . $rowNumber)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);

            foreach ($arrayAphabe as $apha) {
                $worksheet->getStyle($apha . $rowNumber)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }
        }

        $file_xuat_name="File-nhap-chinh-sach-sinh-vien ($co_so->ten).xlsx";
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.$file_xuat_name);
        $writer->save("php://output");
    }

    public function exportData($id_truong, $nam_muon_xuat, $dot_muon_xuat)
    {

        $arrayAphabe = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        $spreadsheet = IOFactory::load('file_excel/chinhsachsv/cs-sinhvien.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $co_so =  DB::table('co_so_dao_tao')->where('id', '=', $id_truong)->first();
        $worksheet->setCellValue('B9', 'Trường: ' . $co_so->ten . ' - ' . $id_truong);
        $loai_truong = $this->bacDaoTaoOfTruong($co_so->loai_truong);
        $worksheet->setCellValue('B8', $loai_truong);

        $worksheet->getStyle("A8:I8")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');
        $worksheet->getStyle("A9:I9")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('C7C7C7');

        $tong_hop_chinh_sach =  DB::table('tong_hop_chinh_sach_voi_hssv')->where('co_so_id', '=', $id_truong)
            ->where('nam', '=', $nam_muon_xuat)
            ->where('dot', '=', $dot_muon_xuat)
            ->orderBy('chinh_sach_id', 'asc')->get();

        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->getColumnDimension('F')->setAutoSize(true);
        $worksheet->getColumnDimension('G')->setAutoSize(true);
        $worksheet->getColumnDimension('H')->setAutoSize(true);

        $chinh_sach = DB::table('chinh_sach')->orderby('id', 'asc')->get();

        $rowNumber = 9;
        foreach ($chinh_sach as $cs) {
            $rowNumber++;
            $worksheet->setCellValue('B' . $rowNumber, $cs->ten);
        }

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(true);

        $dong = 9;
        for ($i = 0; $i < count($tong_hop_chinh_sach); $i++) {
            $dong++;
            $worksheet->setCellValue('C' . $dong, $tong_hop_chinh_sach[$i]->tong_so_hssv);
            $worksheet->setCellValue('D' . $dong, number_format($tong_hop_chinh_sach[$i]->kinh_phi));
            $worksheet->setCellValue('E' . $dong, $tong_hop_chinh_sach[$i]->so_hssv_TC);
            $worksheet->setCellValue('F' . $dong, number_format($tong_hop_chinh_sach[$i]->kinh_phi_TC));
            $worksheet->setCellValue('G' . $dong, $tong_hop_chinh_sach[$i]->so_hssv_CD);
            $worksheet->setCellValue('H' . $dong, number_format($tong_hop_chinh_sach[$i]->kinh_phi_CD));
            $worksheet->setCellValue('I' . $dong, $tong_hop_chinh_sach[$i]->ghi_chu);
        }

        for ($i = 7; $i <= 21; $i++) {
            foreach ($arrayAphabe as $apha) {
                $worksheet->getStyle($apha . $i)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }
        }
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
         header('Content-Disposition: attachment; filename="File-xuat-chinh-sach-sinh-vien.xlsx"');
         $writer->save("php://output");

    }

    public function importFile($fileRead, $duoiFile, $year, $dot)
    {
        $message = '';
        $spreadsheet = $this->createSpreadSheet($fileRead, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[8][1]);
        $id_truong = trim(array_pop($truong));

        $checkChinhSachDaCo =  DB::table('tong_hop_chinh_sach_voi_hssv')->where('co_so_id', '=', $id_truong)
            ->where('nam', '=', $year)
            ->where('dot', '=', $dot)
            ->get();

        $arrayApha = ['C', 'D', 'E', 'F', 'G', 'H'];

        $vitri = $this->checkError($data, $arrayApha, 9, 2, 7);
        if (count($vitri) > 0) {
            $message = 'errorkitu';
            return $message;
        }


        $chinh_sach_da_co_id = [];
        for ($i = 0; $i < count($checkChinhSachDaCo); $i++) {
            $chinh_sach_da_co_id[$checkChinhSachDaCo[$i]->chinh_sach_id] = $checkChinhSachDaCo[$i]->id;
        }

        $arrayToInsert = [];
        $updateData = [];
        $arrayData = [];
        if (count($data) == 21) {
            if ($vitri == null || $vitri == '') {
                $id_chinhsach = 0;
                $key_chinhs = -1;
                for ($i = 9; $i <= 20; $i++) {
                    $id_chinhsach++;
                    $key_chinhs++;
                    $arrayData = [
                        'chinh_sach_id' => $id_chinhsach,
                        'nam' => $year,
                        'dot' => $dot,
                        'co_so_id' => $id_truong,
                        'tong_so_hssv' => $data[$i][2],
                        'kinh_phi' => $data[$i][3],
                        'so_hssv_TC' => $data[$i][4],
                        'kinh_phi_TC' => $data[$i][5],
                        'so_hssv_CD' => $data[$i][6],
                        'kinh_phi_CD' => $data[$i][7],
                        'ghi_chu' => $data[$i][8],
                        'thoi_gian_nhap' => Carbon::now(),
                    ];

                    if (array_key_exists($id_chinhsach, $chinh_sach_da_co_id)) {
                        $updateData[$chinh_sach_da_co_id[$id_chinhsach]] = $arrayData;
                    } else {
                         $this->repository->createChinhSachSv($arrayData);
                    }
                }
                if (count($updateData) > 0) {
                    foreach ($updateData as $key => $value)
                        $this->repository->updateChinhSachSv($key, $value);
                    // DB::table('tong_hop_chinh_sach_voi_hssv')->where('id',$key)->update($value);
                }
           
                $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($id_truong);
                $bm = 'Chính sách sinh viên';
                $tencoso = $thongTinCoSo->ten;
                $route = route('xuatbc.tong-hop-chinh-sach-sinh-vien');
                $this->StoreUpdateNotificationService->addContentUpExecl($year,$dot,$id_truong,count($arrayToInsert),count($updateData),$bm,$route,$tencoso);
                $message = 'ok';
                return $message;
            }
        } else {
            $message = 'nhapKhongDungDong';
            return $message;
        }
    }


    public function importError($fileRead, $duoiFile, $path)
    {
        $fileReadStorage = storage_path('app/public/' . $path);

        $spreadsheet = $this->createSpreadSheet($fileReadStorage, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[8][1]);
        $id_truong = array_pop($truong);

        $arrayApha = ['C', 'D', 'E', 'F', 'G', 'H'];
        $vitri = $this->checkError($data, $arrayApha, 9, 2, 7);

        $spreadsheet2 = IOFactory::load($fileReadStorage);
        $worksheet = $spreadsheet2->getActiveSheet();
        Storage::delete($path);

        // background red o error
        $this->errorRebBackGroud($vitri, $worksheet);

        $writer = IOFactory::createWriter($spreadsheet2, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-chinh-sach-sinh-vien.xlsx"');
        $writer->save("php://output");
    }
}
