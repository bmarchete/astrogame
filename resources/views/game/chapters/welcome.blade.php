@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('style')
<style>
video {
	display: none;
	width: 100%;
	height: 100%;
}
</style>
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
	// iniciadores
	var big_bang = Popcorn("#big-bang-video");
    var star_video = Popcorn("#stars-video");
    var milky_video = Popcorn("#milkway-video");
    var solar_video = Popcorn("#solar-video");
    var terra_video = Popcorn("#terra-video");

	/* ======================================== */
    /* PART I - BIG BANG */
    /* ======================================== */
    $("#big-bang").click(function(){
        $(this).hide();
        $(".big-bang-text").hide();

        big_bang.play();
        $("#big-bang-video").show();
    });

    big_bang.code({
	  start: 21,
	  end: 24,
	  onStart: function() {
	  	change_background('{{ url('/img/chapter/big-bang-static.jpg') }}', 0);
	  	$("#big-bang-video").hide();
        text_cientist('{{ trans('chapters.welcome.fala1') }}');
	  },
      onEnd: function() {
        star_video.play();
      }
	});

    star_video.code({
        start: 2,
        end: 3,
        onStart: function() {
            text_cientist('{{ trans('chapters.welcome.fala2') }}');
        }
    });

    star_video.code({
        start: 4,
        end: 5,
        onStart: function(){
            $("#big-bang-video").hide();
            $("#stars-video").show();
        } 
    });


    /* ======================================== */
    /* PART II - STAR VIDEO */
    /* ======================================== */
    star_video.code({
      start: 4,
      end: 15 ,
      onStart: function() {
        text_cientist('{{ trans('chapters.welcome.fala3') }}');
      },
      onEnd: function() {
        cientist_hide();
      }
    });

    star_video.code({
        start: 21,
        end: 22,
        onEnd: function(){
            $("#stars-video").hide();
            $("#milkway-video").show();
            milky_video.play();
            text_cientist('{{ trans('chapters.welcome.fala4') }}');
        }
    });

    /* ======================================== */
    /* PART III - MILKWAY VIDEO */
    /* ======================================== */
    milky_video.code({
        start: 10,
        end: 25,
        onStart: function() {
            text_cientist('{{ trans('chapters.welcome.fala5') }}');
        },
        onEnd: function(){
            milky_video.pause();
            $("#milkway-video").hide();
            $("#solar-video").show();
            solar_video.play();
            cientist_hide();
        }
    });

    /* ======================================== */
    /* PART IV - SOLAR VIDEO */
    /* ======================================== */
    solar_video.code({
        start: 8,
        end: 17,
        onStart: function() {
            text_cientist('{{ trans('chapters.welcome.fala6') }}');
        },
        onEnd: function(){
            solar_video.pause();
            $("#solar-video").hide();
            $("#terra-video").show();
            terra_video.play();
            cientist_hide();
        }
    });

    /* ======================================== */
    /* PART V - TERRA VIDEO (FINAL) */ 
    /* ======================================== */ 
    terra_video.code({
        start: 1,
        end: 3,
        onStart: function() {
            text_cientist('{{ trans('chapters.welcome.fala7') }}');
        },
        onEnd: function(){

        }
    });

    terra_video.code({
        start: 5,
        end: 8,
        onStart: function() {
            text_cientist('{{ trans('chapters.welcome.fala8') }}');
        },
        onEnd: function() {
            $("#terra-video").hide();
            cientist_hide();
            // PRÓXIMO CAPÍTULO
            window.location = '{{ url('/game/tutorial') }}';
        }
    });
    
});
</script>
@stop

@section('content')
<video id="big-bang-video" class="uk-responsive-width" controls="controls" preload="true">
	<source src="{{ url('/videos/big_bang.mp4') }}" type="video/mp4">
	<source src="{{ url('/videos/big_bang.webm') }}" type="video/webm">
	<source src="{{ url('/videos/big_bang.ogv') }}" type="video/ogg">
</video>

<video id="stars-video" class="uk-responsive-width" controls="controls" preload="true">
	<source src="{{ url('/videos/star_intro.mp4') }}" type="video/mp4">
	<source src="{{ url('/videos/star_intro.webm') }}" type="video/webm">
	<source src="{{ url('/videos/star_intro.ogv') }}" type="video/ogg">
</video>

<video id="milkway-video" class="uk-responsive-width" controls="controls" preload="true">
    <source src="{{ url('/videos/milky_way.mp4') }}" type="video/mp4">
    <source src="{{ url('/videos/milky_way.webm') }}" type="video/webm">
    <source src="{{ url('/videos/milky_way.ogv') }}" type="video/ogg">
</video>

<video id="solar-video" class="uk-responsive-width" controls="controls" preload="true">
    <source src="{{ url('/videos/solar_system.mp4') }}" type="video/mp4">
    <source src="{{ url('/videos/solar_system.webm') }}" type="video/webm">
    <source src="{{ url('/videos/solar_system.ogv') }}" type="video/ogg">
</video>

<video id="terra-video" class="uk-responsive-width" controls="controls" preload="true">
    <source src="{{ url('/videos/terra.mp4') }}" type="video/mp4">
    <source src="{{ url('/videos/terra.webm') }}" type="video/webm">
    <source src="{{ url('/videos/terra.ogv') }}" type="video/ogg">
</video>

<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
            <h1 class="uk-width-large-1-2 uk-width-medium-1-2 uk-align-center big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <button class="uk-button-primary uk-button-large" id="big-bang"><i class="uk-icon-flask"></i> {{ trans('chapters.welcome.start-button') }}</button>
        </div>

        <div class="cientist-message" style="display:none">
            <div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
                <div class="uk-tooltip-inner cientist-text"></div>
            </div>
        </div>
        <img data-uk-modal="{target:'#galileu'}" src="{{ URL('/img/char/galileu.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="" style="display:none">
    </div>
</div>

<div id="galileu" class="uk-modal">
   <div class="uk-modal-dialog">
      <a href="" class="uk-modal-close uk-close"></a>
      <div class="uk-modal-header">
         <h3 class="uk-panel-header">Galileu Galilei</h3>
      </div>
      <img src="{{ URL('/img/char/retrato-galileu.jpg') }}" alt="" style="float: left">
      <div class="uk-overflow-container">
         <p>Galileu Galilei nasceu em 15 de fevereiro de 1564. Seu pai queria que ele fosse médico e o mandou estudar em Pisa. Mas o jovem estava mais interessado em física e matemática. A vocação do aluno também descontentou o professor Orazio Morandi, que o estimulava a seguir a carreira artística.</p>
         <p>Sua primeira contribuição à ciência se deu no Duomo de Pisa. O sacristão acabara de acender uma lâmpada pendurada numa longa corda e a empurrara. O movimento pendular foi medido com as batidas do coração de Galileu. Ele percebeu que o tempo de cada oscilação era sempre igual e formulou a lei do "isocronismo" do pêndulo. Assim, encontrou o primeiro uso prático para aquela regularidade e desenhou um modelo de relógio.</p>
         <p>A famosa torre inclinada de Pisa fez parte de uma outra experiência para contestar a tese de Aristóteles de que, quanto mais pesado fosse um corpo, mais velozmente cairia. Galileu deixou cair da mesma altura duas esferas iguais em volume, mas de peso diferente. Ambas tocaram o solo no mesmo instante. Em seu livro, "Saggiatore" ("Experimentador") combateu a física aristotélica e argumentou que a matemática deveria ser o fundamento das ciências exatas.</p>
         <p>Galileu desenvolveu os fundamentos da mecânica com o estudo de máquinas simples (alavanca, plano inclinado, parafuso etc.). Entre suas criações se destacam: o binóculo, a balança hidrostática, o compasso geométrico, uma régua calculadora e o termobaroscópio: feito para medir a pressão atmosférica, porém, serviu como termômetro.</p>
         <p>Em 1609, construiu um telescópio muito melhor que os existentes e explorou os céus como nunca fora feito antes. Além de estudar as constelações Plêiades, Órion, Câncer e a Via Láctea, descobriu as montanhas lunares, as manchas solares, o planeta Saturno, os satélites de Júpiter e as fases de Vênus. As descobertas foram publicadas no livro "Siderus Nuntius" ("Mensageiro das Estrelas"), em 1610.</p>
         <p>A partir de suas descobertas astronômicas, defendeu a tese de Copérnico de que a Terra não ficava no centro do Universo. Como essa teoria era contrária ao dogma da Igreja, foi perseguido, processado duas vezes e obrigado a negar (abjurar) suas idéias publicamente. Foi banido para uma vila de Arcetri, perto de Florença, onde viveu em um regime semelhante à prisão domiciliar. Morreu em 8 de janeiro de 1642.</p>
         <p>As longas horas ao telescópio causaram sua cegueira. A amargura dos últimos anos de sua vida foi agravada pela morte de sua filha Virgínia, que se dedicara à vida religiosa com o nome de soror Maria Celeste. Em 1992, mais de três séculos após a morte de Galileu, a Igreja reviu o processo da Inquisição e decidiu pela sua absolvição.</p>
      </div>
   </div>
</div>
</div>


@stop