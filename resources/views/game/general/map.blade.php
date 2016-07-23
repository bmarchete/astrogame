
<div class="uk-container uk-container-center">
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-1-1 map">
            <h1>Mapa da Campanha</h1>
            <dl class="uk-description-list-line">
                @foreach ($progress->keys as $chapter)
                <dt>
                    <div class="uk-badge">1</div> {{ $chapter['title'] }}

                    @if($progress->current()->name == $chapter['name'])
                    <strong> - VOCÊ ESTÁ AQUI </strong>
                    @endif

                    <div class="uk-text-muted">{{ $chapter['description'] }}</div>
                </dt>
                @endforeach
            </dl>
            </div>
    </div>
</div>
