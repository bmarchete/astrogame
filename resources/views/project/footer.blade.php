<div class="footer">
    <div class="uk-container uk-container-center">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-margin uk-width-medium-3-10">
                <h2>Astrogame</h2>
                <p>Astrogame é um jogo online onde é possível aprender astronomia através do conceito de gamification, estudando de forma lúcida e divertida com jogos no estilo plataforma, puzzle, point-and-click e outros.</p>
            </div>

            <div class="uk-width-1-2 uk-width-medium-1-10 uk-margin-top">
                <ul class="uk-list-space uk-margin-top" style="list-style: none; margin-left: 0; padding-left: 0">
                    <li><a href="{{ url('/home') }}"><i class="uk-icon-home"></i> Home</a></li>
                    <li><a href="{{ url('/blog') }}"><i class="uk-icon-pencil"></i> Blog</a></li>
                    <li><a href="{{ url('/equipe') }}"><i class="uk-icon-users"></i> Equipe</a></li>
                    <li><a href="{{ url('/ranking') }}"><i class="uk-icon-cubes"></i> Ranking</a></li>
                </ul>
            </div>

            <div class="uk-width-1-2 uk-width-medium-1-10 uk-margin-top">
                <ul class="uk-list-space uk-margin-top" style="list-style: none; margin-left: 0; padding-left: 0">
                    <li><a href="https://facebook.com/cosmosexpoete"><i class="uk-icon-facebook"></i> Facebook</a></li>
                    <li><a href="https://www.youtube.com/channel/UCTTNFbIZIk_hsNbaZArX2fg"><i class="uk-icon-youtube"></i> Youtube</a></li>
                    <li><a href="mailto:eduardo@astrogame.me"><i class="uk-icon-envelope"></i> Email</a></li>
                </ul>
            </div>

            <div class="uk-width-medium-2-10 uk-margin-top">
                <ul class="uk-list-space uk-margin-top" style="list-style: none; margin-left: 0; padding-left: 0">
                    <li><a href="{{ url('/politica') }}"><i class="uk-icon-paperclip"></i> {{ trans('project.politica') }}</a></li>
                    <li><a href="{{ url('/termos') }}"><i class="uk-icon-gavel"></i> {{ trans('project.termos') }}</a></li>
                    <li><a href="{{ url('/credits') }}"><i class="uk-icon-user"></i> {{ trans('project.credits')}}</a></li>
                </ul>
            </div>

            <div class="uk-width-medium-3-10 uk-margin-top">
                <div class="uk-thumbnail" style="width: 315px;">
                  <div class="fb-page" data-href="https://www.facebook.com/cosmosexpoete" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/cosmosexpoete" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cosmosexpoete">Astrogame</a></blockquote></div>
                </div>
            </div>
        </div>
    </div>

    <div class="subfooter uk-margin-top">
        <div class="uk-container uk-container-center uk-text-center-small">

            <div class="uk-align-left uk-margin-remove">
                <p>{!! trans('project.made-by') !!}</p>
            </div>

            <div class="uk-align-right uk-margin-remove">
                <i class="uk-icon uk-icon-hand-spock-o"></i> Version 3.0 Spock | @if (session()->get('language', 'pt-br') == 'pt-br')
                <a href="{{ url('lang/en') }}">Change to English</a> @else
                <a href="{{ url('lang/pt-br') }}">Mudar para Português</a> @endif
                <a href="#top" data-uk-smooth-scroll><i class="uk-icon-arrow-circle-up" title="Ir para o topo"></i></a>
            </div>
        </div>
    </div>
</div>
