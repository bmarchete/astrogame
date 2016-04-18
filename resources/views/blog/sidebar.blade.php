<div class="uk-panel">
    <h3 class="uk-panel-title">Procure no blog</h3>
    
    <form class="uk-search" data-uk-search method="POST" action="{{ url('/desastronautas/search')}}">
        {!! csrf_field() !!}
        <input class="uk-search-field" name="search" type="search" placeholder="procurar">
    </form>
</div>
<div class="uk-panel">
    <h3 class="uk-panel-title">Archives</h3>
    <ul class="uk-list uk-list-line">
        <li><a href="#">January 2014</a></li>
        <li><a href="#">December 2013</a></li>
        <li><a href="#">November 2013</a></li>
        <li><a href="#">October 2013</a></li>
        <li><a href="#">September 2013</a></li>
    </ul>
</div>

<div class="uk-panel">
    <h3 class="uk-panel-title">{{ trans('blog.categories') }}</h3>
    <ul class="uk-list uk-list-line">
        <li><a href="#">Astronomia</a></li>
        <li><a href="#">Curiosidades</a></li>
        <li><a href="#">Desenvolvimento</a></li>
    </ul>
</div>

<div class="uk-panel">
    <h3 class="uk-panel-title">Social Links</h3>
    <ul class="uk-list">
        <li><a href="#">GitHub</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Facebook</a></li>
    </ul>
</div>