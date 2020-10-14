<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class checkStatusUpdateSoLieuTuyenSinh
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
        $trangthai = DB::table('tuyen_sinh')->where('id', $id)->select('tuyen_sinh.trang_thai')->first();
        if ($trangthai->trang_thai > 3) {
            return redirect()->route('solieutuyensinh');
        }
        return $next($request);
    }
}
