<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class checkStatusUpdateKetQuaTotNghiepVoiDoanhNghiep
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $trangthai = DB::table('ket_qua_tot_nghiep_gan_voi_doanh_nghiep')->where('id', $id)->select('ket_qua_tot_nghiep_gan_voi_doanh_nghiep.trang_thai')->first();
        if ($trangthai->trang_thai > 3) {
            return redirect()->route('xuatbc.ket-qua-tot-nghiep-voi-doanh-nghiep');
        }
        return $next($request);
    }
}
