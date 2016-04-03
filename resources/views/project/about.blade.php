@extends('project.general')
@section('title')
{{ trans('project.about') }} | {{ trans('project.project-name') }}
@stop
@section('style')
{!! Minify::stylesheet(['/vendor/uikit/css/components/slideshow.gradient.css',
'/vendor/uikit/css/components/dotnav.gradient.css',
'/vendor/uikit/css/components/slidenav.gradient.css'])->withFullURL() !!}
@stop
@section('javascript')
{!! Minify::javascript(['/vendor/uikit/js/components/slideshow.js'])->withFullURL() !!}
@stop
@section('content')
<div class="uk-container uk-container-center about-section">
   <h1>Astrogame - O Jogo</h1>
   <div class="uk-grid" data-uk-grid>
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
   <div class="uk-grid-divider"></div>
   <h1>{{ trans('project.history') }}</h1>
   <h2>Projeto Cosmos</h2>
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-medium-1-2">
         <div class="uk-thumbnail uk-overlay-hover ">
            <figure class="uk-overlay">
               <img width="660" height="400" src="{{ url('img/history/history_1.jpg')}}" alt="">
               <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
               Visita ao planetário de Campinas com a professora Marli </figcatipon>
            </figure>
         </div>
      </div>
      <div class="uk-width-large-1-2">
         <img src="{{ url('img/logo.png')}}" alt="" width=200>
         <h3>A origem</h3>
         <p>Tudo começou com uma ideia que surgiu numa conversa entra os idealizadores Brenda e Edu:</p>
         <p>- Sabe o que seria legal? Criar um simluador do universo.</p>
         <p>A partir dai a ideia não parou mais, cada vez foram surgindo outras ideias, mas de nossos amigos curtiram e começaram a apoiar também. Arregaçamos a manga, visitamos o planetário municipal de Campinas, localizado no Taquaral. Pesquisamos muito, organizamos uma equipe de mais de 40 pessoas, e realizamos um dos melhores projetos da ETEC Pedro Ferreira Alves durante a Expoete 2015, havia até fila para entrar no stand, e muitos ficaram sem conhecer.</p>
      </div>
      <div class="uk-width-large-1-2 uk-margin-large-top">
         <h2>Sobre o Projeto</h2>
         {!! trans('project.about-cosmos') !!}
      </div>
      <div class="uk-width-large-1-2 uk-margin-large-top" data-uk-scrollspy="{cls:'uk-animation-slide-right'}">
         <div class="uk-thumbnail uk-overlay-hover ">
            <figure class="uk-overlay">
               <img width="660" height="400" src="{{ url('img/history/entrada_simulador.jpg')}}" alt="">
               <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
               Entrada do Simulador do universo </figcatipon>
            </figure>
         </div>
      </div>
      <div class="uk-width-large-1-2 uk-margin-large-top" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
         <video class="uk-responsive-width" controls="true" poster="{{ url('img/history/simluador_cinema.jpg')}}">
            <source src="{{URL('/videos/video_cosmos.mp4')}}" type="video/mp4">
         </video>
         <div class="uk-text-muted uk-text-center">Video do Simluador</div>
      </div>
      <div class="uk-width-large-1-2 uk-margin-large-top">
         <h2>{{ trans('project.percurso-universo') }}</h2>
      	 {!! trans('project.percurso-texto') !!} 	  
      </div>
   </div>
   <div class="uk-grid-divider"></div>
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-large-1-2">
         <h2 class="uk-text-center">Membros do Projeto Cosmos</h2>
         <ul class="uk-list uk-list-striped uk-overflow-container" style="height:300px">
            <li>ADRIANO FABOCI</li>
            <li>ALICE MANTOVANI</li>
            <li>ALVARO VIERA</li>
            <li>ANA JULIA P. LACRETA</li>
            <li>ANA LAURA SANTOS</li>
            <li>BRENDA CONTTESSOTTO</li>
            <li>BRUNO CASTIGLIONI</li>
            <li>BRUNO PAULSEN</li>
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
         <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'swipe', autoplay:true}">
            <ul class="uk-slideshow">
               <li><img src="{{ url('img/history/equipe_completa.jpg')}}" alt=""></li>
               <li><img src="{{ url('img/history/equipe_com_patrocinador.jpg')}}" alt=""></li>
               <li><img src="{{ url('img/history/equipe.jpg')}}"  alt=""></li>
               <li><img src="{{ url('img/history/equipe_2.jpg')}}"  alt=""></li>
               <li><img src="{{ url('img/history/equipe_5.jpg')}}"  alt=""></li>
               <li><img src="{{ url('img/history/equipe_6.jpg')}}"  alt=""></li>
            </ul>
            <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" style="color: rgba(255,255,255,0.4)"></a>
            <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next" style="color: rgba(255,255,255,0.4)"></a>
         </div>
      </div>
   </div>
   <div class="uk-width-large-1-2 uk-margin-large-top" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
      <div class="uk-slidenav-position" data-uk-slideshow="{animation: 'swipe', autoplay:true}">
         <ul class="uk-slideshow">
            <li><img src="{{ url('img/history/nebulosa.jpg')}}" alt=""></li>
            <li><img src="{{ url('img/history/buraco_negro.jpg')}}" alt=""></li>
            <li><img src="{{ url('img/history/visitacao1.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/visitacao2.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/lousa.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/simluador_cinema.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/simluador_interno.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/simluador_projetor.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/simluador2.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/lousa.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/planetario.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/planetario_claro.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/equipe_stands.jpg')}}"  alt=""></li>
            <li><img src="{{ url('img/history/disco_da_voayger.jpg')}}"  alt=""></li>
         </ul>
         <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" style="color: rgba(255,255,255,0.4)"></a>
         <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next" style="color: rgba(255,255,255,0.4)"></a>
      </div>
   </div>
   <h2>Depoimentos</h2>
   <div class="uk-grid uk-margin-top" data-uk-grid>
      <div class="uk-width-large-1-2">
         <blockquote>
            <p>Foi uma das melhores experiências participar do projeto cosmos</p>
            <small>Eduardo Ramos - líder do projeto</small>
         </blockquote>
      </div>
      <div class="uk-width-large-1-2">
         <blockquote>
            <p>Foi uma das melhores experiências participar do projeto cosmos</p>
            <small>Eduardo Ramos - líder do projeto</small>
         </blockquote>
      </div>
      <div class="uk-width-large-1-2 uk-margin-top">
         <blockquote>
            <p>Foi uma das melhores experiências participar do projeto cosmos</p>
            <small>Eduardo Ramos - líder do projeto</small>
         </blockquote>
      </div>
      <div class="uk-width-large-1-2 uk-margin-top">
         <blockquote>
            <p>Foi uma das melhores experiências participar do projeto cosmos</p>
            <small>Eduardo Ramos - líder do projeto</small>
         </blockquote>
      </div>
   </div>

   <hr class="uk-grid-divider">

   <div class="uk-grid" data-uk-grid>
   <div class="uk-width-1-1 uk-text-center">

   <div class="uk-thumbnail uk-overlay-hover ">
            <figure class="uk-overlay">
               <img width="660" height="300" src="{{ url('img/history/et_e_equipe.jpg')}}" alt="">
               <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
               Life long and prosper! </figcatipon>
            </figure>
         </div>
    </div>
</div>

</div>
<div class="uk-grid-divider"></div>
</div>
@stop