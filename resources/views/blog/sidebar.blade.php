<div class="uk-panel">
    <h3 class="uk-panel-title">{{ trans('blog.search-title') }}</h3>
    
    <form class="uk-search" data-uk-search method="GET" action="{{ url('/desastronautas/search')}}">
        <input class="uk-search-field" name="search" type="search" placeholder="{{ trans('blog.search') }}">
    </form>
</div>

<div class="uk-panel">
    <h3 class="uk-panel-title">{{ trans('blog.categories') }}</h3>
    <ul class="uk-list uk-list-line">
        <li><a href="{{ url('/desastronautas/category/astronomia') }}">{{ trans('blog.astronomy') }}</a></li>
        <li><a href="{{ url('/desastronautas/category/curiosidades') }}">{{ trans('blog.curiosity') }}</a></li>
        <li><a href="{{ url('/desastronautas/category/desenvolvimento') }}">{{ trans('blog.development') }}</a></li>
        <li><a href="{{ url('/desastronautas/category/eventos') }}">{{ trans('blog.events') }}</a></li>
    </ul>
</div>

<div class="uk-panel">
    <h3 class="uk-panel-title">{{ trans('blog.authors') }}</h3>
    <ul class="uk-list uk-list-line">
        <li><a href="{{ url('/desastronautas/author/1') }}">Eduardo Ramos</a></li>
        <li><a href="{{ url('/desastronautas/author/2') }}">Brenda Conttessotto</a></li>
        <li><a href="{{ url('/desastronautas/author/3') }}">Gabriel Ferreira</a></li>
        <li><a href="{{ url('/desastronautas/author/4') }}">Adriano Faboci</a></li>
        <li><a href="{{ url('/desastronautas/author/5') }}">Laís Vitória</a></li>
    </ul>
</div>