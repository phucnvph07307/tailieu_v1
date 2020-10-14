@extends('master.master')
@section('content')
<h3>xin chào</h3>

 <div>

        <form action="" method="post">
          @csrf
           author_id: 
           <input type="text" name="author_id">
           <hr>
           author_name: 
           <input type="text" name="author_name">
           <hr>
           title: 
           <input type="text" name="title">
           <hr>
            route: 
            <input type="text" name="route">
           <button type="submit" id="gui">Gửi</button>
        </form>
    </div>
    <script>
           $(document).ready(function() {
             $('#gui').click(function(e) {
                 e.preventDefault();
                 var data_input = {
                  author_id:   $("[name=author_id]").val(),
                  author_name: $("[name=author_name]").val(),
                  title:       $("[name=title]").val(),
                  route:       $("[name=route]").val()
                  }

                 axios.post('{{ route("sendpost-message") }}',data_input)  
             });
          });
    </script>
@endsection
