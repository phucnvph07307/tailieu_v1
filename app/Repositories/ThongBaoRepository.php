<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ThongBao;
use App\Events\RedisEvent;
use Illuminate\Support\Facades\Auth;

class ThongBaoRepository extends BaseRepository
{
    protected $model;

    public function __construct(ThongBao $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getTable()
    {
        return 'thong_bao';
    }

    public function taoThongBao($title,$content,$link_route)
    {
        $mes =  $this->model::create([
            'author_id' => Auth::user()->id,
            'author_name' => Auth::user()->name,
            'title' => $title,
            'content' => $content,
            'link_route' => $link_route
        ]);
        event(
            $e = new RedisEvent($mes)
        );
    }
}