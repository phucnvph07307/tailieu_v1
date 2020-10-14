<?php
/**
 * Created by PhpStorm.
 * User: ginv2
 * Date: 6/21/20
 * Time: 14:59
 */

namespace App\Http\ViewComposers;


use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class HeaderNotificationComposer
{
    protected $notificationService;
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function compose(View $view)
    {
        $notifiData = $this->notificationService->getUserNotifications(Auth::id());
        $rows = [];
        $dateTimeFormat = 'd-m-Y H:i:s\Z';
        foreach ($notifiData as $cursor){
            $rows[$cursor->id()] = $cursor->data();
            $raw = $cursor['sending_time']->get()->format($dateTimeFormat);
            $diff = Carbon::parse($raw)->diffForHumans(Carbon::now(), 'vn');
            $rows[$cursor->id()]['time_ago'] = $diff;
        }
        $collectNotify = collect($rows)->sortByDesc('sending_time');
        $hasNewMessage = count($collectNotify->where('status', config('common.firestore_notification_status.unread'))) > 0;

        $view->with([
            'notifications' => $collectNotify,
            'hasNewMessage' => $hasNewMessage,
            'carbonNow' => Carbon::now()
        ]);
    }
}