@extends('game.general.general')
@section('title')
Capítulo 2 test | {{ trans('project.title') }}
@stop

@section('style')
<style type="text/css">
		html, body {
			overflow: hidden;
			touch-action: none;
			-ms-touch-action: none;
		}
		canvas {
			touch-action-delay: none;
			touch-action: none;
			-ms-touch-action: none;
      width: auto;
      height: auto;
		}
    </style>
@stop

@section('javascript')
{!! Minify::javascript(['/construct/chapter2/c2runtime.js'])->withFullURL() !!}
<script>
  $(document).ready(function(){

  // Size the canvas to fill the browser viewport.
  jQuery(window).resize(function() {
    cr_sizeCanvas(jQuery(window).width(), jQuery(window).height());
  });

  // Start the Construct 2 project running on window load.
  jQuery(document).ready(function ()
  {
    // Create new runtime using the c2canvas
    cr_createRuntime("c2canvas");
  });

  // Pause and resume on page becoming visible/invisible
  function onVisibilityChanged() {
    if (document.hidden || document.mozHidden || document.webkitHidden || document.msHidden)
      cr_setSuspended(true);
    else
      cr_setSuspended(false);
  };

  document.addEventListener("visibilitychange", onVisibilityChanged, false);
  document.addEventListener("mozvisibilitychange", onVisibilityChanged, false);
  document.addEventListener("webkitvisibilitychange", onVisibilityChanged, false);
  document.addEventListener("msvisibilitychange", onVisibilityChanged, false);

  if (navigator.serviceWorker && navigator.serviceWorker.register)
  {
    // Register an empty service worker to trigger web app install banners.
    navigator.serviceWorker.register("/construct/chapter2/sw.js", { scope: "./" });
  }
  });
  </script>
@stop

@section('content')
<div id="c2canvasdiv">
		<canvas id="c2canvas">
			<h1>Your browser does not appear to support HTML5.  Try upgrading your browser to the latest version.  <a href="http://www.whatbrowser.org">What is a browser?</a>
			<br/><br/><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">Microsoft Internet Explorer</a><br/>
			<a href="http://www.mozilla.com/firefox/">Mozilla Firefox</a><br/>
			<a href="http://www.google.com/chrome/">Google Chrome</a><br/>
			<a href="http://www.apple.com/safari/download/">Apple Safari</a><br/>
			<a href="http://www.google.com/chromeframe">Google Chrome Frame for Internet Explorer</a><br/></h1>
		</canvas>
</div>
<div id="copernico" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">Nicolau Copernico</h3>
        </div>
        <img src="{{ URL('/img/char/retrato-copernico.jpg') }}" alt="" style="float: left">
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
@stop