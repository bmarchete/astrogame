@extends('project.general')
@section('title')
{{ trans('project.login') }} | {{ trans('project.project-name') }}
@stop

@section('content')
<div class="uk-vertical-align uk-text-center uk-height-1-1 login-section">
   <div class="uk-vertical-align-middle" style="width: 550px;">
      <img class="uk-margin-bottom" width="280" height="120" src="img/logo.png" alt="{{ trans('project.project-name') }}">
      <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{ url('/login') }}">
         {!! csrf_field() !!}
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
            @if ($errors->has('name'))
                <span class="uk-alert uk-alert-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
         </div>

         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="email" name="email" value="{{ old('email') }}" placeholder="Email (exemplo@exemplo.com)" required>
            @if ($errors->has('email'))
                <span class="uk-alert uk-alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
         </div>
         
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password" value="{{ old('password') }}" placeholder="{{ trans('project.password') }}" required>
            @if ($errors->has('password'))
                <span class="uk-alert uk-alert-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
         </div>

         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Repetir senha" required>
            @if ($errors->has('password_confirmation'))
                <span class="uk-alert uk-alert-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
         </div>

         <div class="uk-form-row">
            <button type="submit" class="uk-width-1-3 uk-button uk-button-danger uk-button-large"><i class="uk-icon-user-plus"></i> Cadastrar</button>
            <a class="uk-width-2-4 uk-button uk-button-primary uk-button-large" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Cadastrar com facebook</a>
         </div>

      </form>
   </div>
</div>
@stop