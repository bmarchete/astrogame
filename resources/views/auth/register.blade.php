@extends('project.general')
@section('title')
{{ trans('project.login') }} | {{ trans('project.project-name') }}
@stop
@section('content')
<div class="uk-vertical-align uk-text-center uk-height-1-1 login-section">
   <div class="uk-vertical-align-middle" style="width: 550px;">
      <img class="uk-margin-bottom" width="280" height="120" src="img/logo.png" alt="{{ trans('project.project-name') }}">
      <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{ url('/register') }}">
         {!! csrf_field() !!}
         @if ($errors->has('name'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <strong>{{ $errors->first('name') }}</strong>
         </div>
         @endif
         @if ($errors->has('email'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <strong>{{ $errors->first('email') }}</strong>
         </div>
         @endif
         @if ($errors->has('password'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <strong>{{ $errors->first('password') }}</strong>
         </div>
         @endif
         @if ($errors->has('password_confirmation'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <strong>{{ $errors->first('password_confirmation') }}</strong>
         </div>
         @endif
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('project.name')}}" required maxlength="60">
         </div>
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('project.email-register') }}" required>
         </div>
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password" value="{{ old('password') }}" placeholder="{{ trans('project.password') }}" required>
         </div>
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="{{ trans('project.confirm-password') }}" required>
         </div>
         <div class="uk-form-row">
            <a class="uk-float-right uk-link uk-link-muted" href="{{ url('/login') }}">{{ trans('project.login-register')}}</a>
         </div>
         <div class="uk-form-row">
            <div class="uk-button-group">
               <button type="submit" class="uk-button uk-button-danger uk-button-large"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</button>
               <a class="uk-button uk-button-primary uk-button-large" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> {{ trans('project.facebook') }}</a>
            </div>
         </div>
      </form>
   </div>
</div>
@stop
