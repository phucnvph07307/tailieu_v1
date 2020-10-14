<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $table = 'thong_bao';
    protected $fillable = [
        'author_id',
        'author_name',
        'title',
        'content',
        'link_route',
        'status',
        'time_ago'
    ];
}
