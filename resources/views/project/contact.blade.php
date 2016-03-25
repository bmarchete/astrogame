@extends('project.general')

@section('title') 
Contato 
@stop
@section('content')
<div class="uk-container uk-container-center contact-section">
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-1-1 uk-width-medium-1-2 uk-width-large-2-3">
         <div class="uk-panel">
            <h2>{{ trans('project.contato-title') }}</h2>
            <form class="uk-form uk-form-stacked">
               <div class="uk-form-row">
                  <label class="uk-form-label" for="name">{{ trans('project.your-name') }}</label>
                  <div class="uk-form-controls">
                     <input type="text" name="name" class="uk-width-1-1" required placeholder="{{ trans('project.name-placeholder') }}">
                  </div>
               </div>
               <div class="uk-form-row">
                  <label class="uk-form-label" for="email">{{ trans('project.your-email') }}</label>
                  <div class="uk-form-controls">
                     <input type="email" name="email" class="uk-width-1-1" placeholder="{{ trans('project.email-placeholder') }}">
                  </div>
               </div>
               <div class="uk-form-row">
                  <label class="uk-form-label">{{ trans('project.your-message') }}</label>
                  <div class="uk-form-controls">
                     <textarea class="uk-width-1-1" name="message" cols="100" rows="9" required></textarea>
                  </div>
               </div>
               <div class="uk-form-row">
                  <div class="uk-form-controls">
                     <button class="uk-button uk-button-primary">{{ trans('project.enviar') }}</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="uk-width-1-1 uk-width-medium-1-2 uk-width-large-1-3">
         <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-panel-title">{{ trans('project.project-name') }}</h3>
            <p>
               <strong>ETEC Pedro Ferreira Alves</strong>
               <br>Mogi Mirim, São Paulo
               <br>Brazil
            </p>
            <p>
               <a href="mailto:contato@astrogame.com.br">contato@astrogame.com.br</a>
               <br><a href="https://twitter.com/@astrogame">@astrogame</a><br>
            </p>
            <h3 class="uk-h4">{{ trans('project.follow-us') }}</h3>
            <p>
               <a href="#" class="uk-icon-button uk-icon-facebook"></a>
               <a href="#" class="uk-icon-button uk-icon-instagram"></a>
            </p>
         </div>
      </div>
   </div>
   <hr class="uk-grid-divider">
</div>
@stop