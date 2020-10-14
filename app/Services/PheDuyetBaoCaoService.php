<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AppService;
use App\Repositories\PheDuyetBaoCaoRepositoryInterface;
use App\Models\TrangThai;
use Arr;

class PheDuyetBaoCaoService extends AppService
{
    protected $pheDuyetBaoCaoRepository;

    public function __construct(
        PheDuyetBaoCaoRepositoryInterface $pheDuyetBaoCaoRepository
    ) {
        $this->pheDuyetBaoCaoRepository = $pheDuyetBaoCaoRepository;
    }

    public function getRepository()
    {
        return $this->pheDuyetBaoCaoRepository;
    }

    public function getDanhSachBaoCao()
    {
        $params = [];
        if (!empty(auth()->user()->co_so_dao_tao_id)) {
            $params['co_so_dao_tao_id'] = auth()->user()->co_so_dao_tao_id;
        }

        $listBaoCao = $this->pheDuyetBaoCaoRepository->getDanhSachBaoCao($params);
        $listBaoCao->load([
            'pheDuyetBaoCao',
            'pheDuyetBaoCao.coSoDaoTao',
            'nguoiPheDuyetLan1',
            'nguoiPheDuyetLan2',
        ]);

        return $listBaoCao;
    }

    public function pheDuyetBaoCao($baoCao, $params = [])
    {
        return $this->pheDuyetBaoCaoRepository->updateBaoCao($baoCao->id, $params);
    }

    public function getListTrangThai($baoCao, $selects = ['*'])
    {
        $listTrangThaiId = $this->getListTrangThaiCoTheThayDoi($baoCao);

        return app(TrangThai::class)
            ->whereIn('id', $listTrangThaiId)
            ->select($selects)
            ->get();
    }

    public function getListTrangThaiCoTheThayDoi($baoCao)
    {
        $trangThai = config('common.phe_duyet.trang_thai');
        $authUser = auth()->user();
        $tblPheDuyet = $baoCao->pheDuyetBaoCao->getTable();
        $listTrangThaiId = [];

        switch ($baoCao->trang_thai) {
            case $trangThai['cho_phe_duyet']:
                if ($authUser->can('phe_duyet_1_' . $tblPheDuyet)) {
                    $listTrangThaiId = Arr::only($trangThai, [
                        'tu_choi',
                        'phe_duyet_lan_1',
                    ]);
                }

                if ($authUser->can('phe_duyet_2_' . $tblPheDuyet)) {
                    $listTrangThaiId = Arr::only($trangThai, [
                        'tu_choi',
                        'phe_duyet_lan_1',
                        'phe_duyet_lan_2',
                    ]);
                }


                break;

            case $trangThai['phe_duyet_lan_1']:
                if ($authUser->can('phe_duyet_2_' . $tblPheDuyet)) {
                    $listTrangThaiId = Arr::only($trangThai, [
                        'tu_choi',
                        'phe_duyet_lan_2',
                    ]);
                }

                break;
            case $trangThai['phe_duyet_lan_2']:
                if ($authUser->can('phe_duyet_2_' . $tblPheDuyet)) {
                    $listTrangThaiId = Arr::only($trangThai, [
                        'cho_phe_duyet',
                        'tu_choi',
                        'phe_duyet_lan_1',
                        'phe_duyet_lan_2',
                    ]);
                }

                break;
            default:
                $listTrangThaiId = Arr::only($trangThai, [
                    'cho_phe_duyet',
                ]);
                break;
        }

        return $listTrangThaiId;
    }
}
