<body onload="notifyMe()">
<ul>
@foreach($snapshot as $row)
    <li>{{$row['message_title']}}</li>
@endforeach
</ul>


<script>


</script>
</body>