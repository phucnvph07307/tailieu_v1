<?php

namespace App\Services;

use App\Repositories\CoQuanChuQuanRepository;

class CoQuanChuQuanService extends AppService
{
    public function getRepository()
    {
        return CoQuanChuQuanRepository::class;
    }


}

?>