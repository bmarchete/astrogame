@extends('project.general')
@section('title')
Reset Password | {{ trans('project.project-name') }}
@stop
@section('content')
<div class="uk-vertical-align uk-text-center uk-height-1-1 login-section">
   <div class="uk-vertical-align-middle" style="width: 300px;">
      <img class="uk-margin-bottom" width="280" height="120" src="{{ url('img/logo.png') }}" alt="{{ trans('project.project-name') }}">
      <form class="uk-panel uk-panel-box uk-form" role="form" method="POST" action="{{ url('/password/email') }}">
         {!! csrf_field() !!}
         @if (session('status'))
         <div class="uk-alert uk-alert-success" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <p>{{ session('status') }}</p>
         </div>
         @endif
         @if ($errors->has('email'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="#" class="uk-alert-close uk-close"></a>
            <strong>{{ $errors->first('email') }}</strong>
         </div>
         @endif
         <div class="uk-form-row">
            <input type="email" class="uk-width-1-1 uk-form-large" name="email" value="{{ old('email') }}" placeholder="Seu email" required>
         </div>
         <div class="uk-form-row">
               <button type="submit" class="uk-button uk-width-1-1 uk-button-primary uk-button-large">
               <i class="uk-icon-envelope"></i> Send Password Reset Link </button>
         </div>
      </form>
   </div>
</div>
@endsection
