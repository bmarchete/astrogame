<div class="footer">
	<div class="uk-container uk-container-center uk-text-center">
		<a href="{{ url('/termos') }}">{{ trans('project.termos') }}</a> | <a href="{{ url('/politica') }}">{{ trans('project.politica') }}</a> | 
		<a href="{{ url('/sobre') }}">{{ trans('project.navbar.sobre') }}</a> | <a href="{{ url('/contato') }}">{{ trans('project.navbar.contato') }}</a> | 
		<a href="{{ url('/desastronautas') }}">{{ trans('project.navbar.blog') }}</a>
		<p>{!! trans('project.made-by') !!}</p>
	</div>
	<div class="uk-container uk-container-center uk-text-right">
	<p>Version 1.0.0 Alpha | 
	@if (session()->get('language', 'pt-br') == 'pt-br')
		<a href="{{ url('lang/en') }}">Change to English</a>
	@else
		<a href="{{ url('lang/pt-br') }}">Mudar para Português</a>
	@endif
	</p>
	</div
</div>