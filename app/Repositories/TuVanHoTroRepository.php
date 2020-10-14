<?php

namespace App\Repositories;

use App\Models\YeuCauHoTro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class TuVanHoTroRepository extends BaseRepository implements TuVanHoTroRepositoryInterface
{
    public function __construct(
        YeuCauHoTro $yeuCauHoTro
    ) {
        parent::__construct();
        $this->model = $yeuCauHoTro;
    }

    public function getTable()
    {
        return 'yeu_cau_ho_tro';
    }


    public function clientThemTuVanHoTro($data)
    {
        return $this->model->create($data);
    }

    public function getAllListPhanHoi($params, $limit)
    {
        $query = $this->model;
        if (isset($params['key_words'])) {
            $query = $query->where('yeu_cau_ho_tro.ten_nguoi_gui',"like", '%'.$params['key_words'].'%')
            ->orWhere('yeu_cau_ho_tro.email_nguoi_gui',"like", '%'.$params['key_words'].'%')
            ->orWhere('yeu_cau_ho_tro.so_dien_thoai_nguoi_gui',"like", '%'.$params['key_words'].'%');       
        }
        if (isset($params['trang_thai']) && $params['trang_thai'] != 0) {
			$query = $query->where('yeu_cau_ho_tro.trang_thai', $params['trang_thai']);
		}
        return $query->orderBy('trang_thai', 'asc')->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function findOne($id)
    {
        $model = $this->model->find($id);
        return $model == null ? false : $model;
    }

    public function traLoiYeuCau($id, $data)
    {
        $model = $this->model->find($id);
        $model->phan_hoi_boi = Auth::id();
        $model->noi_dung_phan_hoi = $data['noi_dung_phan_hoi'];
        $model->trang_thai = config('common.trang_thai_ho_tro.da_phan_hoi');
        return $model->save();
    }

    public function adminUsers()
    {
        return DB::table('model_has_roles')->whereIn('role_id', [1, 31])->get();
    }
}
