{{--  @foreach($notifications as $notifyId => $cursor)
    <div data-notify-id="{{$notifyId}}" url='{{$cursor['url']}}' onclick="SystemUtil.changStatusField(this)"
     class="m-list-timeline__item notify__item  @if($cursor['status'] == config('common.firestore_notification_status.unread')) unread @endif
   {{$cursor['status'] == config('common.firestore_notification_status.read_detail') ?'': 'alert-dark' }}
     ">
        <span
                class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
        <span class="m-list-timeline__text">
        <strong>{{$cursor['sending_user_fullname']}}</strong>
        <br>
        <strong>{{$cursor['message_title']}}</strong>
        <br>
            {{\Str::of($cursor['message_content'])->limit(70)}}
        </span>
        <span class="m-list-timeline__time">{{$cursor['time_ago']}}</span>
    </div>
@endforeach  --}}

<div id="data">
    @foreach ($messages as $message)
        <p id="{{ $message->id }}">
            <a target="_blank" href="{{ $message->route }}">{{ $message->author_name }} -  {{ $message->title }}</a>
        </p>
    @endforeach
</div>
