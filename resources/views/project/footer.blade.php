<div class="footer">
    <div class="uk-container uk-container-center uk-text-center">
          <a href="{{ url('/termos') }}">{{ trans('project.termos') }}</a> / <a href="{{ url('/politica') }}">{{ trans('project.politica') }}</a> /
        <a href="{{ url('/credits') }}">{{ trans('project.credits')}}</a> / <a href="{{ url('/equipe') }}">{{ trans('project.navbar.equipe') }}</a> / <a href="{{ url('/contato') }}">{{ trans('project.navbar.contato') }}</a>
        <p>{!! trans('project.made-by') !!}</p>
    </div>

    <div class="subfooter uk-margin-top">
        <div class="uk-container uk-container-center uk-text-right uk-text-center-small">
          <p> <i class="uk-icon uk-icon-rocket"></i> Version 2.1 Carl Sagan | @if (session()->get('language', 'pt-br') == 'pt-br')
              <a href="{{ url('lang/en') }}">Change to English</a> @else
              <a href="{{ url('lang/pt-br') }}">Mudar para Português</a> @endif
          </p>
        </div>
    </div>
</div>
