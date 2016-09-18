@section('javascript2')
@include('game.general.player-js')
@stop
<div class="buttons">
    <a href="#profile" class="action-button green menu-jogador" data-uk-modal="{target:'#player-modal'}">Perfil &nbsp;<i class="uk-icon uk-icon-user"></i></a>
    <a href="{{ URL('/game')}}" class="action-button red menu-campanha">Campanha  <i class="uk-icon uk-icon-map"></i></a>
    <a href="#shop" class="action-button yellow menu-loja" data-uk-modal="{target:'#shop'}">Loja  <i class="uk-icon uk-icon-shopping-cart"></i></a>
    <a href="#missions" class="action-button red menu-missions" data-uk-modal="{target:'#quests'}">Missões &nbsp;&nbsp;<i class="uk-icon uk-icon-exclamation"></i></a>>
    <a href="#config" class="action-button red menu-config" data-uk-modal="{target:'#settings'}">Configurações  <i class="uk-icon uk-icon-cog"></i></a>
    <a href="{{ URL('/home') }}" class="action-button green menu-home">Home  <i class="uk-icon uk-icon-home"></i></a>
    <a href="#suggestions" class="action-button red menu-suggestions" data-uk-modal="{target:'#bug-report-modal'}">{{ trans('game.suggestions')}}  <i class="uk-icon uk-icon-mail-forward"></i></a>
    <a href="{{ URL('/logout') }}" class="action-button red menu-logout">Sair  <i class="uk-icon uk-icon-arrow-left"></i></a>
    <a href="#observatory" class="action-button red menu-observatory" data-uk-modal="{target:'#observatory'}">Planetário &nbsp;&nbsp;<i class="uk-icon uk-icon-moon-o"></i></a>
</div>
@include('game.general.modals')
