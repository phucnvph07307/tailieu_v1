<?php

namespace App\Services;

use App\Services\AppService;
use App\Repositories\GiaoVienRepositoryInterface;
use App\Repositories\CoSoDaoTaoRepositoryInterface;
use App\Repositories\TrinhDoGiaoVienRepositoryInterface;
use App\Repositories\NganhNgheRepositoryInterface;
use App\Repositories\SoLieuTuyenSinhInterface;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

use Arr;
use DB;

class GiaoVienService extends AppService
{
    protected $giaoVienRepository;
    protected $csdtRepository;
    protected $trinhDoGVRepository;
    protected $nganhNgheRepository;
    protected $soLieuTuyenSinhRepository;

    use ExcelTraitService;



    public function __construct(
        GiaoVienRepositoryInterface $giaoVienRepository,
        CoSoDaoTaoRepositoryInterface $csdtRepository,
        TrinhDoGiaoVienRepositoryInterface $trinhDoGVRepository,
        NganhNgheRepositoryInterface $nganhNgheRepository,
        SoLieuTuyenSinhInterface $soLieuTuyenSinhRepository

    ) {
        $this->giaoVienRepository = $giaoVienRepository;
        $this->csdtRepository = $csdtRepository;
        $this->trinhDoGVRepository = $trinhDoGVRepository;
        $this->nganhNgheRepository = $nganhNgheRepository;
        $this->soLieuTuyenSinhRepository = $soLieuTuyenSinhRepository;
    }

    public function getFilterConfig()
    {
        $filterConfig = config('filters.quan_ly_giao_vien');
        $filterConfig['url'] = route('ql-giao-vien.index');

        $data = $this->giaoVienRepository->getFilterData()->toArray();

        $filterConfig['partials']['giao_vien_id']['options'] = Arr::pluck($data, 'ten', 'id');
        $filterConfig['partials']['trinh_do_id']['options'] = Arr::pluck($data, 'trinh_do', 'id_trinh_do');
        $filterConfig['partials']['co_so_id']['options'] = Arr::pluck($data, 'ten_co_so', 'id_co_so');
        $listTrinhDo = Arr::pluck($data, 'trinh_do_nghiep_vu_su_pham');
        $filterConfig['partials']['nghiep_vu_su_pham']['options'] = array_combine($listTrinhDo, $listTrinhDo);

        return $filterConfig;
    }

    public function getList($params = [], $limit = 10)
    {
        $result = $this->giaoVienRepository->getList($params, $limit);
        $result->each(function ($value, $key) {
            if (!empty($value->nghe_giang_day)) {
                $value->nghe_giang_day = str_replace(',', '<br>', $value->nghe_giang_day);
            }
        });

        return $result;
    }

    public function getListCoSo()
    {
        return $this->csdtRepository->getAll();
    }

    public function getListTrinhDo()
    {
        return $this->trinhDoGVRepository->getAll();
    }

    public function getListNganhNghe(array $listIds = [], array $selects = [])
    {
        $selects[] = DB::raw("CONCAT(ten_nganh_nghe, ' - ', id) AS ten_nganh_nghe");

        return $this->nganhNgheRepository->getListNganhNghe($listIds, $selects);
    }

    public function store(array $params)
    {
        $data = $this->getData($params);

        return $this->giaoVienRepository->createQuanLiGiaoVien($data);
    }

    public function updateGiaoVien($id, $params)
    {
        $data = $this->getData($params);

        return $this->giaoVienRepository->update($id, $data);
    }

    protected function getData($params)
    {
        $listNganhNghe = $this->getListNganhNghe($params['nganh_nghe'])->toArray();
        $nganhNghe = implode(',', Arr::pluck($listNganhNghe, 'ten_nganh_nghe'));

        $data = [];
        $data['ten'] = $params['ten_giao_vien'];
        $data['gioi_tinh'] = $params['gioi_tinh'];
        $data['mon_chung'] = $params['mon_chung'];
        $data['dan_toc_it_nguoi'] = $params['dan_toc_thieu_so'];
        $data['loai_hop_dong'] = $params['loai_hop_dong'];
        $data['co_so_id'] = $params['co_so_id'];
        $data['nghe_giang_day'] = $nganhNghe;

        if (!empty($params['chuc_danh'])) {
            $data['giao_su'] = $params['chuc_danh'] ==
                config('common.giao_vien.chuc_danh.giao_su') ? 1 : 0;

            $data['pho_giao_su'] = $params['chuc_danh'] ==
                config('common.giao_vien.chuc_danh.pho_giao_su') ? 1 : 0;
        }

        if (isset($params['nha_giao_nhan_dan'])) {
            $data['nha_giao_nhan_dan'] = 1;
        }

        if (isset($params['nha_giao_uu_tu'])) {
            $data['nha_giao_uu_tu'] = 1;
        }

        if (!empty($params['trinh_do_tien_sy'])) {
            $data['trinh_do_tien_sy'] = $params['trinh_do_tien_sy'];
        }

        if (!empty($params['trinh_do_thac_sy'])) {
            $data['trinh_do_thac_sy'] = $params['trinh_do_thac_sy'];
        }

        if (!empty($params['trinh_do_dai_hoc'])) {
            $data['trinh_do_dai_hoc'] = $params['trinh_do_dai_hoc'];
        }

        if (!empty($params['trinh_do_cao_dang'])) {
            $data['trinh_do_cao_dang'] = $params['trinh_do_cao_dang'];
        }

        if (!empty($params['trinh_do_trung_cap'])) {
            $data['trinh_do_trung_cap'] = $params['trinh_do_trung_cap'];
        }

        if (!empty($params['trinh_do_khac'])) {
            $data['trinh_do_khac'] = $params['trinh_do_khac'];
        }

        if (!empty($params['trinh_do_ngoai_ngu'])) {
            $data['trinh_do_ngoai_ngu'] = $params['trinh_do_ngoai_ngu'];
        }

        if (!empty($params['trinh_do_nghe'])) {
            $data['trinh_do_ky_nang_nghe'] = $params['trinh_do_nghe'];
        }

        if (!empty($params['nghiep_vu_su_pham'])) {
            $data['trinh_do_nghiep_vu_su_pham'] = $params['nghiep_vu_su_pham'];
        }

        if (!empty($params['trinh_do_tin_hoc'])) {
            $data['trinh_do_tin_hoc'] = $params['trinh_do_tin_hoc'];
        }

        return $data;
    }


    // thanhnv import export 6/17/2020 branch bm9



    public function checkErrorGiaoVien($data,$arrayApha){
        $vitri =[];
        for($i =15; $i < count($data); $i++){
            $key_aphabel=0;
                $rowNumber = $i+1;
                for($j=1;$j <= 35;$j++){
                        $key_aphabel++;
                        if($j != 1 && $j != 4 && $j !=5 && $j !=34 && $j !=35 && $j !=14 && $j !=15 && $j !=16 && $j !=17 && $j !=18 && $j !=19) {
                            if(is_string($data[$i][$j]) || ($data[$i][$j] < 0) || ($data[$i][$j] < 0 || $data[$i][$j] > 1 ) ){
                                  array_push($vitri,$arrayApha[$key_aphabel].$rowNumber);
                            }
                        }
                }
            }
             return $vitri;
        }



    public function exportFillRow($worksheet, $row, $gv)
    {

        $worksheet->setCellValue('B' . $row, $gv->ten);

        $gender = ($gv->gioi_tinh == 1) ? 'C' : 'D';
        $worksheet->setCellValue($gender . $row, 'x');

        $worksheet->setCellValue('E'.$row, $gv->mon_chung);
        $worksheet->setCellValue('F'.$row, $gv->nghe_giang_day);

        $worksheet->setCellValue('G' . $row, ($gv->dan_toc_it_nguoi == 1) ? 'x' : '');

        if ($gv->giao_su == 1) {
            $worksheet->setCellValue('H' . $row, 'x');
        } else if ($gv->pho_giao_su == 1) {
            $worksheet->setCellValue('I' . $row, 'x');
        }

        if ($gv->nha_giao_nhan_dan == 1) {
            $worksheet->setCellValue('J' . $row, 'x');
        } else if ($gv->nha_giao_uu_tu == 1) {
            $worksheet->setCellValue('K' . $row, 'x');
        }

        if ($gv->loai_hop_dong == 1) {
            $worksheet->setCellValue('L' . $row, 'x');
        } else {
            $worksheet->setCellValue('M' . $row, 'x');
        }

        $worksheet->setCellValue('N'.$row,'');

       //  trinh_do_chuyen_mon
    //    if($gv->trinh_do_id ==1){
           $worksheet->setCellValue('O'.$row, $gv->trinh_do_tien_sy);
        // }else if($gv->trinh_do_id==2){
           $worksheet->setCellValue('P'.$row, $gv->trinh_do_thac_sy);
        // }else if($gv->trinh_do_id==3){
           $worksheet->setCellValue('Q'.$row, $gv->trinh_do_dai_hoc);
        // }else if($gv->trinh_do_id==4){
           $worksheet->setCellValue('R'.$row, $gv->trinh_do_cao_dang);
        // }else if($gv->trinh_do_id==5){
           $worksheet->setCellValue('S'.$row, $gv->trinh_do_trung_cap);
        // }else if($gv->trinh_do_id==6){
           $worksheet->setCellValue('T'.$row, $gv->trinh_do_khac);
        // }

        //  TRINH DO NGOAI NGU
        if ($gv->trinh_do_ngoai_ngu == 1) {
            $worksheet->setCellValue('U' . $row, 'x');
        } else if ($gv->trinh_do_ngoai_ngu == 2) {
            $worksheet->setCellValue('V' . $row, 'x');
        } else if ($gv->trinh_do_ngoai_ngu == 3) {
            $worksheet->setCellValue('W' . $row, 'x');
        } else if ($gv->trinh_do_ngoai_ngu == 4) {
            $worksheet->setCellValue('X' . $row, 'x');
        } else if ($gv->trinh_do_ngoai_ngu == 5) {
            $worksheet->setCellValue('Y' . $row, 'x');
        } else if ($gv->trinh_do_ngoai_ngu == 6) {
            $worksheet->setCellValue('Z' . $row, 'x');
        }

        $tin_hoc = ($gv->trinh_do_tin_hoc == 1) ? 'AA' : 'AB';
        $worksheet->setCellValue($tin_hoc . $row, 'x');


        if ($gv->trinh_do_ky_nang_nghe == 1) {
            $worksheet->setCellValue('AC' . $row, 'x');
        } else if ($gv->trinh_do_ky_nang_nghe == 2) {
            $worksheet->setCellValue('AD' . $row, 'x');
        } else if ($gv->trinh_do_ky_nang_nghe == 3) {
            $worksheet->setCellValue('AE' . $row, 'x');
        }

        if ($gv->trinh_do_nghiep_vu_su_pham == 1) {
            $worksheet->setCellValue('AF' . $row, 'x');
        } else if ($gv->trinh_do_nghiep_vu_su_pham == 2) {
            $worksheet->setCellValue('AG' . $row, 'x');
        } else if ($gv->trinh_do_nghiep_vu_su_pham == 3) {
            $worksheet->setCellValue('AH' . $row, 'x');
        }

        $worksheet->setCellValue('AI' . $row, $gv->ten_lop_dao_tao);
        $worksheet->setCellValue('AJ' . $row, $gv->thoi_gian_dao_tao);
    }

    public function exportBieuMau($id_coso)
    {

        $co_so = DB::table('co_so_dao_tao')->where('id', $id_coso)->first();
        $spreadsheet = IOFactory::load('file_excel/quanligiaovien/bieu-mau-ds-ql-giao-vien.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('B4', "Trường: $co_so->ten - $id_coso ");

        $loai_hinh = '';
        $cap_quan_li = '';
        if ($co_so->ma_loai_hinh_co_so == 9) {
            $loai_hinh = 'Tư thục';
        } else if ($co_so->ma_loai_hinh_co_so == 4) {
            $cap_quan_li = 'Trung ương';
            $loai_hinh = 'Công lập';
        } else if ($co_so->ma_loai_hinh_co_so == 15) {
            $cap_quan_li = 'Địa phương';
            $loai_hinh = 'Công lập';
        } else if ($co_so->ma_loai_hinh_co_so == 14) {
            $loai_hinh = 'Đầu tư nước ngoài';
        }

        $worksheet->setCellValue('B5', "Loại hình: $loai_hinh ");
        $worksheet->setCellValue('B6', "Cấp quản lí: $cap_quan_li");

        $bac_truong = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet->setCellValue('B7', "Loại hình cơ sở: $bac_truong ");
        $worksheet->getColumnDimension('F')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);

        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-nhap-quan-li-giao-vien.xlsx"');
        $writer->save("php://output");
    }

    public function exportData($id_truong)
    {
        $spreadsheet = IOFactory::load('file_excel/quanligiaovien/bieu-mau-ds-ql-giao-vien.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();

        $co_so = DB::table('co_so_dao_tao')->where('id', $id_truong)->first();
        $spreadsheet->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet->getDefaultStyle()->getProtection()->setLocked(false);
        $worksheet->setCellValue('B4', "Trường: $co_so->ten - $id_truong ");

        $loai_hinh = '';
        $cap_quan_li = '';
        if ($co_so->ma_loai_hinh_co_so == 9) {
            $loai_hinh = 'Tư thục';
        } else if ($co_so->ma_loai_hinh_co_so == 4) {
            $cap_quan_li = 'Trung ương';
            $loai_hinh = 'Công lập';
        } else if ($co_so->ma_loai_hinh_co_so == 15) {
            $cap_quan_li = 'Địa phương';
            $loai_hinh = 'Công lập';
        } else if ($co_so->ma_loai_hinh_co_so == 14) {
            $loai_hinh = 'Đầu tư nước ngoài';
        }

        $worksheet->setCellValue('B5', "Loại hình: $loai_hinh ");
        $worksheet->setCellValue('B6', "Cấp quản lí: $cap_quan_li");

        $bac_truong = $this->bacDaoTaoOfTruong($co_so->loai_truong);

        $worksheet->setCellValue('B7', "Loại hình cơ sở: $bac_truong ");
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->getColumnDimension('F')->setAutoSize(true);

        $giao_vien = $this->giaoVienRepository->giaoVienTheoTruong($id_truong);

        $arrayAphabe = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ'];
        $row = 16;
        foreach ($giao_vien as $gv) {
            $row++;
            // border đen các ô
            foreach ($arrayAphabe as $apha) {
                $worksheet->getStyle($apha . $row)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }

            $this->exportFillRow($worksheet, $row, $gv);
            // // KHÓA CÁC DÒNG Ô
            foreach ($arrayAphabe as $apha) {
                $worksheet->getStyle($apha . $row)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
            }
        }
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="File-xuat-quan-li-giao-vien.xlsx"');
        $writer->save("php://output");
    }

    public function importFile($fileRead, $duoiFile)
    {
        $message = '';
        $spreadsheet = $this->createSpreadSheet($fileRead, $duoiFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $truong = explode(' - ', $data[3][1]);
         $id_truong = trim(array_pop($truong));
            
        $arrayApha=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ'];
        // vòng for này để check lỗi nếu có thì cho hết lỗi vào các array $error, $vitri
        $vitri=$this->checkErrorGiaoVien($data,$arrayApha);

        if(count($vitri) > 0){
        $message='exportError';
        return $message;
        }

        $arrayDataToInsert=[];
        $arrayData=[];

        if(count($data) != 100){
            if($vitri == null || $vitri == '') {
                for($i = 16; $i < count($data); $i++){
                $loai_hop_dong=null;
                    if($data[$i][11]==1){
                        $loai_hop_dong =1;
                    }else if($data[$i][12]==1){
                        $loai_hop_dong =2;
                    }else{
                        $loai_hop_dong =3;
                    }


                    $trinh_do_ngoai_ngu=null;
                    if($data[$i][20]==1){
                        $trinh_do_ngoai_ngu =1;
                    }else if($data[$i][21]==1){
                        $trinh_do_ngoai_ngu =2;
                    }else if($data[$i][22]==1){
                        $trinh_do_ngoai_ngu =3;
                    }else if($data[$i][23]==1){
                        $trinh_do_ngoai_ngu =4;
                    }else if($data[$i][24]==1){
                        $trinh_do_ngoai_ngu =5;
                    }else if($data[$i][25]==1){
                        $trinh_do_ngoai_ngu =6;
                    }

                    $trinh_do_tin_hoc = ($data[$i][26]==1) ? 1 : 2;

                    $trinh_do_nghe=null;
                    if($data[$i][28]==1){
                        $trinh_do_nghe =1;
                    }else if($data[$i][29]==1){
                        $trinh_do_nghe =2;
                    }else {
                        $trinh_do_nghe =3;
                    }

                    $trinh_nghe_vu_su_pham=null;
                    if($data[$i][31]==1){
                        $trinh_nghe_vu_su_pham =1;
                    }else if($data[$i][32]==1){
                        $trinh_nghe_vu_su_pham =2;
                    }else {
                        $trinh_nghe_vu_su_pham =3;
                    }

                    $gioi_tinh = ($data[$i][2]==1) ? 1 : 2;

                    $arrayData=[
                        'nghe_giang_day'=>$data[$i][5],
                        'co_so_id'=>$id_truong,
                        'ten'=>$data[$i][1],
                        'gioi_tinh'=>$gioi_tinh,
                        'mon_chung'=>$data[$i][4],
                        'dan_toc_it_nguoi'=>$data[$i][6],
                        'giao_su'=>$data[$i][7],
                        'pho_giao_su'=>$data[$i][8],
                        'nha_giao_nhan_dan'=>$data[$i][9],
                        'nha_giao_uu_tu'=>$data[$i][10],
                        'loai_hop_dong'=>$loai_hop_dong,

                        'trinh_do_tien_sy'=>$data[$i][14],
                        'trinh_do_thac_sy'=>$data[$i][15],
                        'trinh_do_dai_hoc'=>$data[$i][16],
                        'trinh_do_cao_dang'=>$data[$i][17],
                        'trinh_do_trung_cap'=>$data[$i][18],
                        'trinh_do_khac'=>$data[$i][19],

                        'trinh_do_ngoai_ngu'=>$trinh_do_ngoai_ngu,
                        'trinh_do_tin_hoc'=>$trinh_do_tin_hoc,
                        'trinh_do_ky_nang_nghe'=>$trinh_do_nghe,
                        'trinh_do_nghiep_vu_su_pham'=>$trinh_nghe_vu_su_pham,
                        'ten_lop_dao_tao'=>$data[$i][34],
                        'thoi_gian_dao_tao'=>$data[$i][35],
                    ];
                        array_push($arrayDataToInsert,$arrayData);
                }

                $this->giaoVienRepository->createQuanLiGiaoVien($arrayDataToInsert);
                $message='ok';
                return $message;
            }
        }
    }

    public function importError($fileRead, $duoiFile){
        $message='';
        $spreadsheet = $this->createSpreadSheet($fileRead,$duoiFile);
        $data =$spreadsheet->getActiveSheet()->toArray();

        $arrayApha=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ'];

        $vitri=$this->checkErrorGiaoVien($data,$arrayApha);

        $spreadsheet2 = \PhpOffice\PhpSpreadsheet\IOFactory::load('file_excel/quanligiaovien/bieu-mau-ds-ql-giao-vien.xlsx');
        $worksheet = $spreadsheet2->getActiveSheet();
        $worksheet->setCellValue('B4', $data[3][1]);
        $worksheet->setCellValue('B5', $data[4][1]);
        $worksheet->setCellValue('B6', $data[5][1]);
        $worksheet->setCellValue('B7', $data[6][1]);

        $stt=15;
        for($i = 15; $i < count($data); $i++){
            $stt++;
            for($j=1;$j < count($arrayApha); $j++){
            $worksheet->setCellValue($arrayApha[$j].$stt,$data[$i][$j]);
        }
        }
        //  khóa
        $spreadsheet2->getActiveSheet()->getProtection()->setSheet(true);
        $spreadsheet2->getDefaultStyle()->getProtection()->setLocked(false);
        $worksheet->getColumnDimension('F')->setAutoSize(true);

        for($i = 0; $i < count($vitri);$i++){
            // $worksheet->getStyle($vitri[$i])->applyFromArray($styleArray);
            //  màu ô
            $worksheet->getStyle($vitri[$i])->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF0000');
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet2, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Error-file-nhap-quan-li-giao-vien.xlsx"');
        $writer->save("php://output");
    }
}
