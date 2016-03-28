@extends('project.general')
@section('title') {{ trans('project.title') }} @stop

@section('javascript')

@stop

@section('content')
<div class="home-section">
   <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-1">
         <div class="uk-vertical-align uk-text-center">
            <div class="uk-vertical-align-middle uk-width-1-1 uk-width-large-1-2">
               <h1 class="uk-heading-large">{{ trans('project.home-title') }}</h1>
               <p class="uk-text-large">{{ trans('project.home-description') }}</p>
               <div class="uk-button-group">
                  <a class="uk-button uk-button-success uk-button-large" href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a>
                  <a class="uk-button uk-button-primary uk-button-large uk-hidden-small" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Facebook</a>
                  <a class="uk-button uk-button-large" href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="uk-container uk-container-center uk-margin-top">
   <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-cog uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
               <h2 class="uk-h3">{{ trans('project.home-text.title1') }}</h2>
               <p>{{ trans('project.home-text.text1') }}</p>
            </div>
         </div>
      </div>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-thumbs-o-up uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
                <h2 class="uk-h3">{{ trans('project.home-text.title2') }}</h2>
                <p>{{ trans('project.home-text.text2') }}</p>   
            </div>
         </div>
      </div>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-cloud-download uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
                <h2 class="uk-h3">{{ trans('project.home-text.title3') }}</h2>
                <p>{{ trans('project.home-text.text3') }}</p>   
            </div>
         </div>
      </div>
   </div>
   <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-dashboard uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
                <h2 class="uk-h3">{{ trans('project.home-text.title4') }}</h2>
                <p>{{ trans('project.home-text.text4') }}</p>   
            </div>
         </div>
      </div>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-comments uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
                <h2 class="uk-h3">{{ trans('project.home-text.title5') }}</h2>
                <p>{{ trans('project.home-text.text5') }}</p>   
            </div>
         </div>
      </div>
      <div class="uk-width-medium-1-3">
         <div class="uk-grid">
            <div class="uk-width-1-6">
               <i class="uk-icon-briefcase uk-icon-large uk-text-primary"></i>
            </div>
            <div class="uk-width-5-6">
                <h2 class="uk-h3">{{ trans('project.home-text.title6') }}</h2>
                <p>{{ trans('project.home-text.text6') }}</p>   
            </div>
         </div>
      </div>
   </div>
   <hr class="uk-grid-divider">
   <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-2">
         <img width="660" height="400" src="img/home-section3.jpg" alt="">
      </div>
      <div class="uk-width-medium-1-2">
         <h1>Explore o Universo!</h1>
         <p>Explore as estrelas, conheça os planetas de nosso sistema solar, e até mesmo os lugares mais distantes de nossa galaxia!</p>
          <h2>Ao Infinito e Além!</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
         <a class="uk-button uk-button-primary" href="#">Button</a>
      </div>
   </div>
   <hr class="uk-grid-divider">
   <div class="uk-grid" data-uk-grid-margin>
      <div class="uk-width-medium-1-2 uk-text-right">
         <h1>Heading</h1>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
         <h2>Subheading</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
         <a class="uk-button uk-button-primary" href="#">Button</a>
      </div>
      <div class="uk-width-medium-1-2">
         <img width="660" height="400" src="img/home-section4.jpg" alt="">
      </div>
   </div>
   <hr class="uk-grid-divider">

   <h1 class="uk-text-center">Screenshots do jogo</h1>

            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                    <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                       <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                   <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                    <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                         <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>

                <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
                     <figure class="uk-overlay uk-overlay-hover">
                        <img width="350" height="150" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjQsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzUwcHgiIGhlaWdodD0iMTUwcHgiIHZpZXdCb3g9IjAgMCAzNTAgMTUwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAzNTAgMTUwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxyZWN0IGZpbGw9IiNGNUY1RjUiIHdpZHRoPSIzNTAiIGhlaWdodD0iMTUwIi8+DQo8ZyBvcGFjaXR5PSIwLjciPg0KCTxwYXRoIGZpbGw9IiNEOEQ4RDgiIGQ9Ik0xMzEuOTEsNDEuMXY2Ny44aDg2LjE4VjQxLjFIMTMxLjkxeiBNMjExLjE0NiwxMDEuNTQ5SDEzOS4yNlY0OC40NTFoNzEuODg3VjEwMS41NDl6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0Q4RDhEOCIgcG9pbnRzPSIxNDMuMTI5LDk1LjgzIDE1Ny45NDMsODAuMjU4IDE2My40OTQsODIuNjYgMTgxLjAwOSw2NC4wMTQgMTg3LjkwMiw3Mi4yNiAxOTEuMDE0LDcwLjM4MiANCgkJMjA3Ljg0OCw5NS44MyAJIi8+DQoJPGNpcmNsZSBmaWxsPSIjRDhEOEQ4IiBjeD0iMTYwLjI0MyIgY3k9IjYxLjk1NCIgcj0iNi40NzIiLz4NCjwvZz4NCjwvc3ZnPg0K" alt="">
                        <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                            <div>Client Name</div>
                        </figcaption>
                        <a class="uk-position-cover" href="#"></a>
                    </figure>
                </div>
            </div>

        <hr class="uk-grid-divider">

</div>

<div id="login" class="uk-modal">
    <div class="uk-modal-dialog">
    	<a class="uk-modal-close uk-close"></a>
    	<div class="uk-modal-header"><h3>Login</h3></div>

        <form method="POST" action="/login" id="login-form" class="uk-form uk-align-center">
        	 {!! csrf_field() !!}
            <div class="uk-form-row">
                <label class="uk-form-label" for="email">Email</label>
                <div class="uk-form-controls">
                    <input type="email" name="email" id="email" required>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="password">{{ trans('project.senha') }}</label>
                <div class="uk-form-controls">
                    <input type="password" name="password" id="password" required>
                </div>
            </div>

            <div class="uk-form-row">
              <label><input type="checkbox" name="remember"> {{ trans('project.remember') }}</label>

            	<button type="submit" class="uk-button uk-button-success">{{ trans('project.submit') }}</button>
            </div>

            <div class="uk-form-row">
            	<a href="" class="uk-button uk-button-danger"><i class="uk-icon-sign-in"></i> Google</a>
            	<a href="" class="uk-button uk-button-primary"><i class="uk-icon-sign-in"></i> Facebook</a>
            </div>
        </form>
    </div>
</div>
@stop