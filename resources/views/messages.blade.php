<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
</head>
<body>
    <h3>Message</h3>

    <div id="data">
        @foreach ($messages as $message)
            <p id="{{ $message->id }}">
                <a target="_blank" href="{{ $message->route }}">{{ $message->author_name }} -  {{ $message->title }}</a>
            </p>
        @endforeach
    </div>

    <div>
        <form action="" method="post">
            @csrf
           Name: 
           <input type="text" name="author">
        <br>
        <br>
           Content: 
           <textarea name="content"  cols="30" rows="10"></textarea>
           <br>
           <button type="submit" id="gui">Gửi</button>
        </form>
    </div>

  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#gui').click(function(e) {
                e.preventDefault();
                var data_input = {
                    author: $("input[name=author]").val(),
                    content: $("[name=content]").val()
                 }

                axios.post('{{ route("sendpost-message") }}',data_input)  
            });
         });
      
 

        var socket = io('http://localhost:6001');
        socket.on('laravel_database_chat:message',function(data){
            console.log(data);
            if($('#'+data.id).length == 0){
              $('#data').append(` 
                 <p id="${data.id}">
                   <a target="_blank" href="${data.route}">${data.author_name} -  ${data.title}</a>
                </p>
                `)
            }else{
            console.log('đã có tin nhắn');
            }

        })
    </script>
</body>
</html>