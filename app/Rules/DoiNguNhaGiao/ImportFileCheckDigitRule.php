<?php

namespace App\Rules\DoiNguNhaGiao;

use Illuminate\Contracts\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\CoSoDaoTao;
use App\Repositories\CoSoDaoTaoRepositoryInterface;
use App\Repositories\DoiNguNhaGiaoInterface;

class ImportFileCheckDigitRule implements Rule
{
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $nam = request()->get('nam');
        $dot = request()->get('dot');
        $csdtRepo = app()->make(CoSoDaoTaoRepositoryInterface::class);
        $doiNguNhaGiaoRepo = app()->make(DoiNguNhaGiaoInterface::class);

        $fileExtension = request()->file('file_import')->extension();
        $reader = strtolower($fileExtension) === 'xlsx' ?
            app()->make(Xlsx::class) : app()->make(Xls::class);

        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($value->getPathName());
        $worksheet = $spreadsheet->getActiveSheet();

        $coSoInfo = $worksheet->getCell('B11')->getValue();
        $coSoId = trim(explode('-', $coSoInfo)[1]);

        $coSo = $csdtRepo->find($coSoId);
        if ($coSo == null) {
            $this->message = 'Thông tin cơ sở đào tạo không hợp lệ.';
            return false;
        }

        $coSo->load([
            'nganhNghe:ten_nganh_nghe'
        ]);

        $checkTrangThai = $doiNguNhaGiaoRepo->checkImportable($coSoId, $nam, $dot);
        if (!$checkTrangThai) {
            $this->message = "Số liệu của đợt {$dot} năm {$nam} đã được phê duyệt.";
            return ;
        }

        $nganhNgheDuocCap = \Arr::pluck($coSo->nganhNghe->toArray(), 'ten_nganh_nghe');
        $nganhNgheTrongFile = [];
        $row = 12;
        while(true) {
            $rowData = $worksheet->rangeToArray("G{$row}:AK{$row}")[0];
            $nganhNghe = $worksheet->getCell("B{$row}")->getValue();
            if (empty($nganhNghe)) {
                break;
            }

            if (in_array($nganhNghe, config('common.loai_truong')) ||
                strpos($nganhNghe, 'Trường: ') === 0) {
                $this->message = 'File import chỉ được chứa thông tin của 1 trường duy nhất.';
                return false;
            }

            $filteredData = array_filter($rowData);
            $nganhNgheTrongFile[] = $nganhNghe;
            if (!in_array($nganhNghe, $nganhNgheDuocCap)) {
                $this->message = 'Thông tin ngành nghề không hợp lệ.';
                return false;
            }

            // Sử dụng regex để check row chỉ chứa các số
            if (!preg_match('/^\d*+$/', implode('', $filteredData))) {
                $this->message = 'Số liệu không hợp lệ.';
                return false;
            }

            $row++;
        }

        if (count($nganhNgheTrongFile) !== count($nganhNgheDuocCap)) {
            $this->message = 'Số lượng ngành nghề không hợp lệ.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
