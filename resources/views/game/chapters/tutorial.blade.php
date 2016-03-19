@extends('game.general.general')
@section('title')
Tutorial | Game
@stop

@section('style')
@stop

@section('javascript')
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
});
</script>
@stop

@section('cosntent')
<div class="uk-grid" data-uk-grid>
	<div class="uk-container uk- uk-margin-top">
		<div class="uk-panel uk-panel-box uk-width-medium-1-2">
	        <div class="uk-panel-badge uk-badge uk-badge-danger">Hot</div>
	        <h3 class="uk-panel-title">Title</h3>
	            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	    </div>
	</div>
</div>
@stop