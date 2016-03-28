@extends('project.general')
@section('title')
{{ trans('project.login') }} | {{ trans('project.project-name') }}
@stop

@section('content')
<div class="uk-vertical-align uk-text-center uk-height-1-1 login-section">
   <div class="uk-vertical-align-middle" style="width: 300px;">
      <img class="uk-margin-bottom" width="280" height="120" src="img/logo.png" alt="{{ trans('project.project-name') }}">
      <form class="uk-panel uk-panel-box uk-form" method="POST" action="{{ url('/login') }}">
         {!! csrf_field() !!}

         @if (session()->has('social_error'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <p>{{ session('social_error') }}</p>
         </div>
         @endif

         @if ($errors->has('email') || $errors->has('password'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <p>{{ $errors->first('email') }}</p>
         </div>
         @endif
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('project.email') }}" required>
         </div>
         <div class="uk-form-row">
            <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="{{ trans('project.password') }}" required>
         </div>
         <div class="uk-form-row uk-text-small">
            <label class="uk-float-left"><input type="checkbox" name="remember" checked> {{ trans('project.remember')}}</label>
            <a class="uk-float-right uk-link uk-link-muted" href="{{ url('/password/reset') }}">{{ trans('project.forget-password')}}</a>
         </div>
         <div class="uk-form-row">
            <div class="uk-button-group">
               <button type="submit" class="uk-button uk-button-danger uk-button-large"><i class="uk-icon-sign-in"></i> {{ trans('project.submit') }}</button>
               <a class="uk-button uk-button-primary uk-button-large" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Facebook</a>
            </div>
         </div>
         <div class="uk-form-row">
            <a href="{{ URL('/register') }}" class="uk-button uk-width-1-1 uk-button-success uk-button-large"><i class="uk-icon-user-plus"></i> {{ trans('project.register')}}</a>
         </div>
      </form>
   </div>
</div>
@endsection