<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\HopTacQuocTeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\KetQuaHopTacQuocTe;

class HopTacQuocTeRepository extends BaseRepository implements HopTacQuocTeRepositoryInterface
{
    protected $model;

	public function __construct(KetQuaHopTacQuocTe $model)
	{
		parent::__construct();
		$this->model = $model;
	}

    public function getTable()
    {
        return 'ket_qua_hop_tac_quoc_te';
    }

    /* Danh sách kết quả hợp tác quốc tế.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function getDanhSachKetQuaHopTacQuocTe($params)
    {
        $queryBuilder = $this->table
        ->leftjoin('co_so_dao_tao', 'ket_qua_hop_tac_quoc_te.co_so_id', '=', 'co_so_dao_tao.id')
        ->leftjoin('trang_thai', 'ket_qua_hop_tac_quoc_te.trang_thai', '=', 'trang_thai.id')
        ->select('ket_qua_hop_tac_quoc_te.*', DB::raw('co_so_dao_tao.ten as ten'), DB::raw('trang_thai.ten_trang_thai as ten_trang_thai'));

        if(isset($params['co_so_id']) && $params['co_so_id'] != null){
            $queryBuilder->where('ket_qua_hop_tac_quoc_te.co_so_id', $params['co_so_id']);
        }
        if(isset($params['nam']) && $params['nam'] != null){
            $queryBuilder->where('ket_qua_hop_tac_quoc_te.nam', $params['nam']);
        }

        if(isset($params['dot']) && $params['dot'] != null){
            $queryBuilder->where('ket_qua_hop_tac_quoc_te.dot', $params['dot']);
        }

        return $queryBuilder->orderBy('nam', 'desc')->orderBy('dot', 'desc')->paginate($params['page_size']);
    }

    /* Kiểm tra sự tồn tại của bản ghi đã có 4 trường co_so_id, nam, dot.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function checkTonTaiKhiThem($params){
        $kq = $this->table
        ->where('ket_qua_hop_tac_quoc_te.co_so_id', $params['co_so_id'])
        ->where('ket_qua_hop_tac_quoc_te.nam', $params['nam'])
        ->where('ket_qua_hop_tac_quoc_te.dot', $params['dot'])
        ->select('ket_qua_hop_tac_quoc_te.*')
        ->first();

        return $kq;
    }

    /* Danh sách chi tiết hợp tác quốc tế theo cơ sở đào tạo.
     * @author: phucnv
     * @created_at 2020-06-15
     */
    public function chiTietTheoCoSo($co_so_id, $params){
        $queryBuilder = $this->table
        ->leftjoin('co_so_dao_tao','ket_qua_hop_tac_quoc_te.co_so_id','=','co_so_dao_tao.id')
        ->select('ket_qua_hop_tac_quoc_te.*',
        DB::raw('co_so_dao_tao.ten as ten_co_so'))
        ->where('ket_qua_hop_tac_quoc_te.co_so_id', $co_so_id);

        if(isset($params['nam']) && $params['nam'] != null){
            $queryBuilder->where('ket_qua_hop_tac_quoc_te.nam', $params['nam']);
        }
        if(isset($params['dot']) && $params['dot'] != null){
            $queryBuilder->where('ket_qua_hop_tac_quoc_te.dot', $params['dot']);
        }

        return $queryBuilder->orderByDesc('nam')->orderByDesc('dot')->paginate($params['page_size']);
    }


    public function getHopTacQuocTeCsNamDot($id_truong, $year,$dot)
	{
		$data =  DB::table('ket_qua_hop_tac_quoc_te')->where('co_so_id', '=', $id_truong)
		->where('nam','=',$year)
		->where('dot','=',$dot)
		->select('id','co_so_id')->first();
		return $data;
	}
	public function getHopTacQuocTeTimeFromTo($id_truong, $fromDate,$toDate)
	{
		$data = DB::table('ket_qua_hop_tac_quoc_te')->where('co_so_id', '=',$id_truong)
		->where('thoi_gian_cap_nhat','>=',$fromDate)
		->where('thoi_gian_cap_nhat','<=',$toDate)
		->get();
		return $data;
    }

    // thanhnv 6/26/2020 sửa model create update
	public function createHopTacQuocTe($arrayData){
		return $this->model->create($arrayData);
    }

	public function updateHopTacQuocTe($key,$arrayData){
		return $this->model->where('id',$key)->update($arrayData);
    }
    
}
