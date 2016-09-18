function text_cientist(message) {
    $(".cientist").show();
    $(".cientist-message").hide();
    $(".cientist-text").html(message);
    $(".cientist-message").show();
}

function cientist(message, timer) {
    setTimeout(function() {
        $(".cientist-message").hide();
        $(".cientist-text").html(message);
        $(".cientist-message").show();
    }, timer);
}

function cientist_hide() {
    $(".cientist-message").hide();
    $(".cientist").hide();
}

function fullscreen_video(video) {
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    }

}

function fullscreen_exit() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}

//////////////////////////////////////////////////////////
// falas
// ///////////////////////////////////////////////////////
window.fala = 1;
window.falas = [];
window.fala_event = new Event('troca_fala');
window.addEventListener('troca_fala', function(){
    text_cientist(window.falas[window.fala]);

});
$(document).ready(function(){
  $(".next-fala").click(function(){
      if(window.fala <= window.falas.length){
        window.fala++;
        window.dispatchEvent(window.fala_event);
      }
  });

  $(".prev-fala").click(function(){
      if(window.fala > 0){
        window.dispatchEvent(window.fala_event);
        window.fala--;
      }
  });
});
