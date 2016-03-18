@section('title')
Tutorial | Game
@stop

@section('style')
<link rel="stylesheet" href="{{ URL('/css/game/main.css') }}">
<link rel="stylesheet" href="{{ URL('/vendor/uikit/css/components/notify.css') }}">
<link rel="stylesheet" href="{{ URL('/vendor/uikit/css/components/progress.gradient.css') }}">
<link rel="stylesheet" href="{{ URL('/vendor/uikit/css/components/tooltip.css') }}">
@stop

@section('javascript')
<script src="{{ URL('/vendor/uikit/js/components/notify.min.js') }}"></script>
<script src="{{ URL('/vendor/uikit/js/components/tooltip.min.js') }}"></script>
<script src="{{ URL('/vendor/buzz/buzz.min.js') }}"></script>
<script>
	$(document).ready(function(){
		UIkit.notify({
		    message : 'Bem vindo ao Cosmos Game!',
		    status  : 'info',
		    timeout : 3000,
		    pos     : 'top-right'
		});

		UIkit.notify({
		    message : 'Você está no modo tutorial agora :)',
		    status  : 'warning',
		    timeout : 5000,
		    pos     : 'top-right'
		});
	});

	// sounds
	var background = new buzz.sound("sounds/music/bg.mp3", {preload: true, loop: true});
	background.play().loop();

	$("#volume-music").click(function(value) {
		value = $("#volume-music").val();
		console.log(value);
	});
</script>
@stop

@section('content')

@stop

@include('game.general.header')
@include('game.general.player-bar')
@include('game.general.footer')