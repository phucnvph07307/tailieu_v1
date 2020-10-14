<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dot extends Model
{
    protected $table = 'dot';
    protected $fillable = [
        'time_start',
        'time_end',
        'mo_ta',
        'ten_dot',
        'nam'
    ];
    public function setTimeStartAttribute($value)
    {
        $this->attributes['time_start'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    public function setTimeEndAttribute($value)
    {
        $this->attributes['time_end'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }

}
