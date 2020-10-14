<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\CoQuanChuQuanInterface;

class CoQuanChuQuanRepository extends BaseRepository implements CoQuanChuQuanInterface{
    
    public function getTable()
    {
        return 'co_quan_chu_quan';
    }
}
?>