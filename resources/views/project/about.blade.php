@extends('project.general')
@section('title')
{{ trans('project.about') }} | {{ trans('project.project-name') }}
@stop
@section('style')
{!! Minify::stylesheet(['/vendor/uikit/css/components/slideshow.gradient.css', '/vendor/uikit/css/components/dotnav.gradient.css', '/vendor/uikit/css/components/slidenav.gradient.css'])->withFullURL() !!}
@stop
@section('javascript')
{!! Minify::javascript(['/vendor/uikit/js/components/slideshow.js'], ['async' => true])->withFullURL() !!}
@stop
@section('content')
<div class="thumbnav">
    <div class="uk-container uk-container-center">
        <h1>{{ trans('about.title') }}</h1>
    </div>
</div>
<div class="about">
    <div class="uk-container uk-container-center">
    <div class="uk-grid uk-margin-large-top" data-uk-grid>
        <div class="uk-width-medium-1-2">
            <img width="660" height="400" src="{{ url('img/about1.png') }}" alt="Tela de missões do astrogame">
        </div>
        <div class="uk-width-medium-1-2">
            <h1><i class="uk-icon uk-icon-book"></i> {{ trans('about.title1') }}</h1>
            <p>{{ trans('about.text1') }}</p>
            <p>{{ trans('about.text2') }}</p>
            <p>{{ trans('about.text3') }}</p>
            <a class="action-button blue" href="#login" data-uk-modal><i class="uk-icon-gamepad"></i> {{ trans('about.button1')}}</a>
        </div>
    </div>
    <hr class="uk-grid-divider">
    <div class="uk-grid uk-container-center" data-uk-grid>
        <div class="uk-width-1-1">
            <p>{{ trans('about.text4') }}</p>
            <p>{{ trans('about.text5') }}</p>
            <p>{{ trans('about.text6') }}</p>
            <p>{{ trans('about.text7') }}</p>
            <p>{{ trans('about.text8') }}</p>
            <p>{{ trans('about.text9') }}</p>
            <p><a href="{{ url('tcc.pdf')}}" class="action-button red"><i class="uk-icon uk-icon-download"></i> {{ trans('about.button2')}}</a></p>
        </div>
        <div class="uk-width-medium-1-2">
            <img width="660" height="400" src="{{url('img/screenshots/screenshot (7).png')}}" alt="">
        </div>
    </div>
    <hr class="uk-grid-divider">
    <h1 class="uk-text-center uk-margin-large-bottom" id="historia-cosmos"><i class="uk-icon uk-icon-archive"></i> {{ trans('about.title2')}}</h1>
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-medium-1-2">
            <div class="uk-thumbnail uk-overlay-hover ">
                <figure class="uk-overlay">
                    <img width="660" height="400" src="{{ url('img/history/history_1.jpg') }}" alt="Projeto Cosmos">
                    <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
                        {{ trans('about.figcaption1')}} </figcatipon>
                </figure>
            </div>
        </div>
        <div class="uk-width-large-1-2">
            <img src="{{ url('img/logo-cosmos.png') }}" alt="Projeto Cosmos Logo" width="200">
            <p>{{ trans('about.text10') }}</p>
            <p>{{ trans('about.text11') }}</p>
        </div>
        <div class="uk-width-large-1-2 uk-margin-large-top">
            <h2>{{ trans('about.title2') }}</h2>
            <p>{{ trans('about.text12') }}</p>
            <p>{{ trans('about.text13') }}</p>
            <p>{{ trans('about.text14') }}</p>
        </div>
        <div class="uk-width-large-1-2 uk-margin-large-top" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
            <div class="uk-thumbnail uk-overlay-hover ">
                <figure class="uk-overlay">
                    <img width="660" height="400" src="{{ url('img/history/entrada_simulador.jpg')}}" alt="">
                    <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
                        {{ trans('about.figcaption2') }} </figcatipon>
                </figure>
            </div>
        </div>
        <div class="uk-width-large-1-2 uk-margin-large-top" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
            <video class="uk-responsive-width" controls="true" poster="{{ url('history/simluador_cinema.jpg')}}">
                <source src="{{ url('videos/video_cosmos.mp4')}}" type="video/mp4">
            </video>
            <div class="uk-text-muted uk-text-center">{{ trans('about.figcaption3') }}</div>
        </div>
        <div class="uk-width-large-1-2 uk-margin-large-top">
            <h2>{{ trans('about.title3') }}</h2>
            <p>{{ trans('about.text15') }}</p>
            <p>{{ trans('about.text16') }}</p>
            <p>{{ trans('about.text17') }}</p>
        </div>
    </div>
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-large-1-2">
            <h2 class="uk-text-center">{{ trans('about.title4') }}</h2>
            <ul class="uk-list uk-list-striped uk-overflow-container" style="height:300px">
                <li>ADRIANO FABOCI</li>
                <li>ALICE MANTOVANI</li>
                <li>ALVARO VIERA</li>
                <li>ANA JULIA P. LACRETA</li>
                <li>ANA LAURA SANTOS</li>
                <li>BRENDA CONTTESSOTTO</li>
                <li>BRUNO CASTIGLIONI</li>
                <li>CAIO EDUARDO</li>
                <li>CARLOS EDUARDO</li>
                <li>CAROL SANTOS</li>
                <li>EDUARDO AUGUSTO RAMOS</li>
                <li>EDUARDO AUGUSTO SILVA</li>
                <li>EDUARDO TEODORO</li>
                <li>FELIPE PEREIRA JORGE</li>
                <li>FILICIO ROCHA DAVID</li>
                <li>FILIPE GIANOTTO</li>
                <li>GABRIEL FILIPE FERREIRA</li>
                <li>GABRIEL LEITE</li>
                <li>GUSTAVO ELIAS ANECHINI</li>
                <li>GUSTAVO OLIVEIRA</li>
                <li>GUSTAVO SANTOS BORBORENO</li>
                <li>JÉSSICA LARA DOS SANTOS</li>
                <li>JOÃO PEDRO ALKIMI BUENO</li>
                <li>LAÍS VITÓRIA GRANZIEIRA</li>
                <li>LEONARDO FERNANDES</li>
                <li>MÁRCIO BOMBO</li>
                <li>MARIA CAROLINE MARQUES</li>
                <li>MATHEUS DIAS</li>
                <li>MATEHUS NERY</li>
                <li>MONIQUE VECHINI</li>
                <li>MURILO GINEZ</li>
                <li>NATHALIA MANDELI</li>
                <li>PEDRO CERRUTI</li>
                <li>RENAN BUENO</li>
                <li>RODRIGO PESSANHA</li>
                <li>THAYNÁ RECCHIA</li>
                <li>VINICIUS LAGUNA</li>
                <li>VITOR HUGO MARTONI FRANCO</li>
                <li>VICTOR LIMA</li>
                <li>WANDREW ROGÉRIO</li>
                <li>YASMIN MENEZES</li>
            </ul>
        </div>
        <div class="uk-width-large-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
            <div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
                <ul class="uk-slideshow">
                    <li><img src="{{ url('img/history/equipe_completa.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe_com_patrocinador.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe_2.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe_5.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe_6.jpg') }}" alt=""></li>
                </ul>
                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" style="color: rgba(255,255,255,0.4)"></a>
                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next" style="color: rgba(255,255,255,0.4)"></a>
            </div>
        </div>
    </div>
    <div class="uk-grid uk-margin-large-top" data-uk-grid>
        <div class="uk-width-large-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
            <div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
                <ul class="uk-slideshow">
                    <li><img src="{{ url('img/history/nebulosa.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/buraco_negro.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/visitacao1.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/visitacao2.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/lousa.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/simluador_cinema.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/simluador_interno.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/simluador_projetor.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/simluador2.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/lousa.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/planetario.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/planetario_claro.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/equipe_stands.jpg') }}" alt=""></li>
                    <li><img src="{{ url('img/history/disco_da_voayger.jpg') }}" alt=""></li>
                </ul>
                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" style="color: rgba(255,255,255,0.4)"></a>
                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next" style="color: rgba(255,255,255,0.4)"></a>
            </div>
        </div>
        <div class="uk-width-large-1-2">
            <blockquote>
                <p>Foi uma das melhores experiências participar do projeto cosmos</p>
                <small>Eduardo Ramos - líder do projeto</small>
            </blockquote>
            <blockquote>
                <p>Donec lobortis placerat sem, a pellentesque felis dignissim ac.</p>
                <small>Jefferson - professor de física</small>
            </blockquote>
            <blockquote>
                <p>Vestibulum leo nisi, viverra quis eleifend eleifend, finibus non ex.</p>
                <small>Eduardo Ramos - líder do projeto</small>
            </blockquote>
            <blockquote>
                <p>Donec eget lacus vitae metus porttitor suscipit.</p>
                <small>Eduardo Ramos - líder do projeto</small>
            </blockquote>
            <blockquote>
                <p>urabitur egestas libero ac sapien tincidunt, nec sagittis massa tincidunt.</p>
                <small>Eduardo Ramos - líder do projeto</small>
            </blockquote>
        </div>
    </div>
    <hr class="uk-grid-divider">
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-1-1 uk-text-center">
            <div class="uk-thumbnail uk-overlay-hover ">
                <figure class="uk-overlay">
                    <img width="660" height="300" src="{{ url('img/history/et_e_equipe.jpg') }}" alt="Eduardo Ramos, Renan e Alvaro ET">
                    <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
                        Life long and prosper! </figcaption>
                </figure>
            </div>
        </div>
    </div>
</div>
<hr class="uk-grid-divider">
</div>
</div>
@stop
