<?php
namespace App\Services;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\AppService;
use App\Repositories\XayDungChuongTrinhGiaoTrinhReponsitory;
use App\Repositories\NganhNgheRepository;
use App\Repositories\CoSoDaoTaoRepository;
use App\Repositories\ChiTieuTuyenSinhRepository;
use App\Services\StoreUpdateNotificationService;
use App\Repositories\CoSoDaoTaoRepositoryInterface;

class XayDungChuongTrinhGiaoTrinhService extends AppService
{

    protected $nganhngheRepository;
    protected $csdtRepository;
    protected $StoreUpdateNotificationService;
    protected $CoSoDaoTaoRepository;

    public function __construct(
        NganhNgheRepository $nganhngheRepository,
        CoSoDaoTaoRepository $csdtRepository,
        StoreUpdateNotificationService $StoreUpdateNotificationService,
        CoSoDaoTaoRepositoryInterface $coSoDaoTao
    ) {
        parent::__construct();
        $this->nganhngheRepository = $nganhngheRepository;
        $this->csdtRepository = $csdtRepository;
        $this->StoreUpdateNotificationService = $StoreUpdateNotificationService;
        $this ->CoSoDaoTaoRepository = $coSoDaoTao;
    }

    public function getRepository()
    {
        return XayDungChuongTrinhGiaoTrinhReponsitory::class;
    }

    public function getDanhSachXayDungChuongTrinhGiaoTrinh($params)
    {
        $queryData = [];
        $queryData['dot'] = isset($params['dot']) ? $params['dot'] : (Carbon::now()->month < 6 ? 1 : 2);
        $queryData['nam'] = isset($params['nam']) ? $params['nam'] : Carbon::now()->year;
        $queryData['loai_hinh'] = isset($params['loai_hinh']) ? $params['loai_hinh'] : null;
        $queryData['co_so_id'] = isset($params['co_so_id']) ? $params['co_so_id'] : null;
        $queryData['devvn_quanhuyen'] = isset($params['devvn_quanhuyen']) ? $params['devvn_quanhuyen'] : null;
        $queryData['nganh_nghe'] = isset($params['nganh_nghe']) ? $params['nganh_nghe'] : null;
        $queryData['page_size'] = 20;
        return $this->repository->getDanhSachXayDungChuongTrinhGiaoTrinh($queryData);
    }

    public function getNganhNghe()
    {
        return $this->nganhngheRepository->getAll();
    }

    public function getCoSoDaoTao()
    {
        return $this->csdtRepository->getAll();
    }

    public function checkTonTaiKhiThem($params){
        return $this->repository->checkTonTaiKhiThem($params);
    }

    public function findNganhNgheById($id)
    {
        return $this->nganhngheRepository->findById($id);
    }

    public function checkTonTai($id)
    {
        return $this->csdtRepository->checkTonTai($id);
    }

    public function chiTietTheoCoSo($co_so_id, $params)
    {
        return $this->repository->chiTietTheoCoSo($co_so_id, $params);
    }

    public function getSingleCsdt($id)
    {
        return $this->csdtRepository->getSingleCsdt($id);
    }


    public function getNganhNgheTheoCoSo($co_so_id)
    {
        return $this->nganhngheRepository->getNganhNgheTheoCoSo($co_so_id);
    }

    public function store(array $data = [])
    {
        $returnData = $this->repository->store($data);
        if($returnData){
            $thongTinCoSo = $this->CoSoDaoTaoRepository->getThongTinCoSo($data['co_so_id']);
            $tieude = 'Thêm mới ( '.$thongTinCoSo->ten.' )';
            $noidung = 'Thêm mới số liệu xây dựng giáo trình';
            $route = route('xuatbc.show-ds-xd-giao-trinh',['co_so_id' => $data['co_so_id']]);
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
			$noidung = 'Cập nhật số liệu xây dựng giáo trình';
            $route = route('xuatbc.show-ds-xd-giao-trinh',['co_so_id' => $getdata['co_so_id']]);
			$this->StoreUpdateNotificationService->addContentUp($getdata['nam'],$getdata['dot'],$getdata['co_so_id'],$tieude,$noidung,$route);
        }
        return $resurt;
    }

}
