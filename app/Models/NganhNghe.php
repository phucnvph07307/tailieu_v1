<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NganhNghe extends Model
{
    protected $table = 'nganh_nghe';
    protected $fillable = [
        'id',
        'ten_nganh_nghe',
        'bac_nghe',
        'ma_cap_nghe'
    ];
    public $timestamps = FALSE;
}
