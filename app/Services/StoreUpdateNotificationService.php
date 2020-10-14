<?php

namespace App\Services;


use App\Repositories\TuVanHoTroRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Auth;
class StoreUpdateNotificationService extends AppService
{
    protected $tuVanHoTro;
    protected $notificationService;
    public function __construct(NotificationService $notificationService,
    TuVanHoTroRepositoryInterface $tuVanHoTro
    )
    {
        $this->notificationService = $notificationService;
        $this->tuVanHoTro = $tuVanHoTro;
    }

    public function addContentUpExecl($nam,$dot,$co_so_id,$countInsert,$countUpdate,$bm,$route,$tencoso)
    {
        $content=[
            'tieu_de' => 'Cập nhật '.$bm.' bằng excel ( '.$tencoso.' )',
            'noi_dung' => 'Excel thêm mới '.$countInsert.' bản ghi Cập nhật '.$countUpdate.' bản ghi',
            'module_name' => 'xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh',
            'nam' => $nam,
            'dot' => $dot,
            'co_so_id' => $co_so_id,
            'sending_user_fullname' => Auth::user()->name,
            'route'=>$route,
            'bm' => $bm
        ];
       $this->StoreUpdateBM($content);
    }

    public function addContentUp($nam,$dot,$co_so_id,$tieude,$noidung,$route)
    {
        $content=[
            'tieu_de' => $tieude,
            'noi_dung' => $noidung,
            'module_name' => 'xuatbc.chi-tiet-dang-ky-chi-tieu-tuyen-sinh',
            'nam' => $nam,
            'dot' => $dot,
            'route'=>$route,
            'co_so_id' => $co_so_id,
            'sending_user_fullname' => Auth::user()->name
        ];
        $this->StoreUpdateBM($content);
    }

    public function StoreUpdateBM($content){ 
            $url= $content['route'].'?nam='.$content['nam'].'&dot='.$content['dot'].'&co_so_id='.$content['co_so_id'];
            $adminUsers =$this->tuVanHoTro->adminUsers();
            $notifiData = [];        
            foreach ($adminUsers as $user){
                $notifiData[] = [
                    'data_id' =>1,
                    'message_title' => $content['tieu_de'],
                    'message_content' => $content['noi_dung'],
                    'read_time' => null,
                    'recceive_user_id' => $user->model_id,
                    'sending_time' => Carbon::now(),
                    'sending_user_id' => -1,
                    'url' => $url,
                    'sending_user_fullname'=>$content['sending_user_fullname'],
                    // 'module_name' => $content['module_name'],
                    'status' => 1,
                    'nam' => $content['nam'],
                    'dot' => $content['dot'],
                    'co_so_id' => $content['co_so_id']
                ];                  
            }
            // dd($notifiData);
      
            $this->notificationService->pushNotification($notifiData);
    }


}