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
   <hr class="uk-grid-divider">
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-medium-1-2">
         <img width="660" height="400" src="img/home-section3.jpg" alt="">
      </div>
      <div class="uk-width-medium-1-2">
         <h1>Jogue e aprenda</h1>
         <p>Nosso projeto foi idealizado com o intuito de facilitar e ampliar a divulgação de conhecimentos científicos relacionados a astrofísica e astronomia. É possível notar que a divulgação de material educacional relacionado às duas matérias se dá de forma carente e fraca, pois não há incentivo nas escolas e tão pouco para o público em geral.</p>
         <p>Na internet encontramos grandes acervos de conteúdo de astronomia e astrofísica, porém esse material é de difícil absorção, pois muitas vezes se encontra de forma densa e complicada, tornando a leitura desses conteúdos muito maçante e cansativa, o que acaba por desestimular aqueles que possuem vontade de aprender sobre os temas.</p>
         <p>Muitas vezes, os conteúdos apresentam imagens relacionadas ao que está sendo explicado, porém a leitura dessas imagens - embora as mesmas possuindo legenda - é complicada, pois é necessária uma boa interpretação por parte dos leitores, o que por falta de base, se torna praticamente impossível.</p>
         <a class="uk-button uk-button-success" href="{{ url('/login') }}"><i class="uk-icon-gamepad"></i> Entrar e Jogar!</a>
      </div>
 </div>
   <hr class="uk-grid-divider">
 <div class="uk-grid" data-uk-grid>

      <div class="uk-width-medium-1-2">
         <h1>Jogue e aprenda</h1>
         <p>Analisando esse cenário precário de divulgação cientifica, percebemos que era interessante uma plataforma onde esses conteúdos se encontrassem disponíveis de forma simples, intuitiva e direta, ajudando aqueles que estivessem interessados em aprender, terem acesso a informações de boa qualidade de maneira fácil.</p>
         <p>Sendo assim optamos por fazer um site onde seria possível aprender e compreender de maneira interativa e divertida, os complexos assuntos relacionados a astronomia e astrofísica,que por conta de seu dinamismo conseguiria manter a atenção do usuário, e por conta da facilidade em se manipular, não causaria desanimo e desinteresse.</p>
         <p>Percebemos que boa parte do público jovem e infanto-juvenil demonstra um forte interesse em jogos, um exemplo disso é crescimento em grande escala do e-sport no cenário mundial, não só isso se pode notar também um grande aumento na quantidade de adultos que se interessam por jogos atualmente.</p>
         <p>Tendo em vista o grande interesse do público em jogos, decidimos que a plataforma desenvolvida seria em formato de um jogo. Onde os temas seriam abordados de maneira com que o conteúdo se tornasse dinâmico e fácil, tendo como principal foco, tornar as principais descobertas e teorias a respeito do cosmos, missões de exploração, onde cada fase seria modelada para tornar a respectiva teoria/descoberta algo divertido, onde o usuário aprendesse com ela e se divertisse ao mesmo tempo.</p>
         <p>Com a implementação do projeto criaremos uma plataforma que possa oferecer conteúdo de alta qualidade em um formato de fácil compreensão e acessibilidade para que os diferentes públicos possam ter onde aprender de forma interativa e dinâmica, e se divertir enquanto tem acesso ao material.</p>
      </div>

      <div class="uk-width-medium-1-2">
         <img width="660" height="400" src="img/screenshots/screenshot (7).png" alt="">
      </div>

   </div>
   <hr class="uk-grid-divider">
   <h1 class="uk-text-center">{{ trans('project.history') }}</h1>
   <div class="uk-grid" data-uk-grid>
      <div class="uk-width-medium-1-2">
         <div class="uk-thumbnail uk-overlay-hover ">
            <figure class="uk-overlay">
               <img width="660" height="400" src="{{ url('img/history/history_1.jpg')}}" alt="Projeto Cosmos">
               <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
               Visita ao planetário de Campinas com a professora Marli </figcatipon>
            </figure>
         </div>
      </div>
      <div class="uk-width-large-1-2">
         <img src="{{ url('img/logo.png')}}" alt="" width=200>
         <p>Tudo começou com uma ideia que surgiu numa conversa entra os idealizadores Brenda e Eduardo: - Sabe o que seria legal? Criar um simluador do universo.</p>
         <p>A partir dai a ideia não parou mais, cada vez foram surgindo outras maluquices, mas de nossos amigos curtiram e começaram a apoiar também. Arregaçamos a manga, visitamos o planetário municipal de Campinas, localizado no Taquaral. Pesquisamos muito, organizamos uma equipe de mais de 40 pessoas, e realizamos um dos melhores projetos da ETEC Pedro Ferreira Alves durante a Expoete 2015, havia até fila para entrar no stand, e muitos ficaram sem conhecer.</p>
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
   <div class="uk-grid uk-margin-large-top" data-uk-grid>
      <div class="uk-width-large-1-2" data-uk-scrollspy="{cls:'uk-animation-slide-left'}">
         <div class="uk-slidenav-position" data-uk-slideshow="{autoplay:true}">
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