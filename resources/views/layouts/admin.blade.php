<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- start start-->
	@include('layouts.dashboard.style')
	@yield('style')
	<!-- end start-->
</head>

<body
	class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">


	{{-- thanhnv loading --}}
	<div class="loading" style="display:none">

		<div class="loading-background-back-all"></div>
		<div class='loading-position'>
			<div class="lds-ring">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div>
				&nbsp; &nbsp;Loading...
			</div>
		</div>

	</div>
	{{-- done loading --}}

	<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- start header	 -->
		@include('layouts.dashboard.header')
		<!-- end header -->

		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<!-- start slidebar -->
			@include('layouts.dashboard.sidebar')
			<!-- end slidebar -->

			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!--start content -->
				@yield('content')
				<!--end content -->
			</div>
		</div>
	</div>
	<!--start footer -->
	@include('layouts.dashboard.footer')
	<!--end footer -->
	<input type="hidden" id="api-get-notify-list" value="{{route('api.get-notify-list')}}">
</body>
<!-- start script -->
@include('layouts.dashboard.script')
@yield('script')
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyBgsIr_D6abvJfc88zzLajDN6Y4VRrtNxs",
        authDomain: "ldtbxhhn-2eede.firebaseapp.com",
        databaseURL: "https://ldtbxhhn-2eede.firebaseio.com",
        projectId: "ldtbxhhn-2eede",
        storageBucket: "ldtbxhhn-2eede.appspot.com",
        messagingSenderId: "813977702932",
        appId: "1:813977702932:web:c59614e111376f2f1e4d01",
        measurementId: "G-VDPZR40YYC"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
	$(document).ready(function(){
		var avatarImgUrl = $('.m-topbar__userpic>img').attr('src');
		SystemUtil.defaultImgUrl(avatarImgUrl, '.m-topbar__userpic>img', "{!! asset('uploads/avatars/user.png') !!}");

		SystemUtil.getFirebaseNotify({{\Illuminate\Support\Facades\Auth::id()}});
		
	});


	//phuc
	var socket = io('http://localhost:6001');
        socket.on('laravel_database_chat:message',function(data){
            console.log(data);
            if($('#'+data.id).length == 0){
              $('#data').append(` 
                 <p id="${data.id}">
                   <a target="_blank" href="">${data.author_name} -  ${data.title}</a>
                </p>
                `)
            }else{
            console.log('đã có tin nhắn');
            }

        })
//phuc

</script>
<!-- end script -->

</html>