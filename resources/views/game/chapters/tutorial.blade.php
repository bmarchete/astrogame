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
<script src="{{ URL('/vendor/jquery/ajaxform.min.js') }}"></script>
<script src="{{ URL('/vendor/uikit/js/components/notify.min.js') }}"></script>
<script src="{{ URL('/vendor/uikit/js/components/tooltip.min.js') }}"></script>
<script src="{{ URL('/vendor/buzz/buzz.min.js') }}"></script>
<script>
	$(document).ready(function(){
		UIkit.notify({
		    message : 'Bem vindo ao {{ trans('project.project-name') }}!',
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

		$("#volume-music").change(function(){
    		var volume=$(this).val();
    		console.log("Music volume set to: " + volume + "%");
    		music_background.setVolume(volume);
  		});

		$("#volume-sound").change(function(){
    		var volume=$(this).val();
    		console.log("Sound effects volume set to: " + volume + "%");
  		});


  		$('#bug-report').ajaxForm({
		       type: "POST",
		       dataType: 'JSON',
		       success: function(data) {
		       	   if (data.status){
		       	   	    var modal = UIkit.modal("#bug-report-modal");
		           	    modal.hide();
		           	    UIkit.notify(data.text, {status:'success'});
		       	   } else {
		       	   		UIkit.notify("<i class='uk-icon-close'></i> " + data.text, {status:'danger'});
		       	   }	
		       } 
		   });
	});

	// music background
	var music_background = new buzz.sound("sounds/music/bg.mp3", {preload: true, loop: true});
	music_background.play().loop();

</script>
@stop

@section('content')

@stop

@include('game.general.header')
@include('game.general.player-bar')
@include('game.general.footer')