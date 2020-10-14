<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class NotificationController extends Controller
{
    public function getNotifyList(Request $request){
        $requestData = $request->data;
        $rows = [];
        $dateTimeFormat = 'd-m-Y H:i:s';
        foreach ($requestData as $cursor) {
            $rows[$cursor['notify_id']] = $cursor;
            $diff = Carbon::parse($cursor['sending_time'])->diffForHumans(Carbon::now(), 'vn');
            $rows[$cursor['notify_id']]['time_ago'] = $diff;
        }
        $collectNotify = collect($rows);
        $hasNewMessage = count($collectNotify->where('status', config('common.firestore_notification_status.unread'))) > 0;
        return response(view('layouts.partials.notify-json', [
                'notifications' => $collectNotify,
                'hasNewMessage' => $hasNewMessage,
            ]
        ),200, ['Content-Type' => 'application/json']);

    }
}
