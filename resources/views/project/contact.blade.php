@section('title')
Contato
@stop
@section('content')
<div class="uk-container uk-container-center contact-section">
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-2-3">
         <div class="uk-panel">
            <div class="uk-panel-badge uk-badge"></div>
            <h3 class="uk-panel-title">{{ trans('project.contato-title') }}</h3>
            <form class="uk-form uk-form-stacked">
               <div class="uk-form-row">
                  <label class="uk-form-label" for="name">{{ trans('project.your-name') }}</label>
                  <div class="uk-form-controls">
                     <input type="text" name="name" class="uk-width-1-1" required>
                  </div>
               </div>
               <div class="uk-form-row">
                  <label class="uk-form-label" for="email">{{ trans('project.your-email') }}</label>
                  <div class="uk-form-controls">
                     <input type="email" name="email" class="uk-width-1-1">
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
      <div class="uk-width-medium-1-3">
         <div class="uk-panel uk-panel-box uk-panel-box-secondary">
            <h3 class="uk-panel-title">{{ trans('project.')}}</h3>
            <p>
               <strong>Company Name</strong>
               <br>Street, Country
               <br>Postal Zip Code
            </p>
            <p>
               <a>youremail@yourdomain.com</a>
               <br><a>@YourTwitterAccount</a><br>
               P+44 (0) 208 0000 000
            </p>
            <h3 class="uk-h4">Follow Us</h3>
            <p>
               <a href="#" class="uk-icon-button uk-icon-github"></a>
               <a href="#" class="uk-icon-button uk-icon-twitter"></a>
               <a href="#" class="uk-icon-button uk-icon-dribbble"></a>
               <a href="#" class="uk-icon-button uk-icon-html5"></a>
            </p>
         </div>
      </div>
   </div>
   <hr class="uk-grid-divider">
</div>
@stop
@include('project.header')
@include('project.footer')