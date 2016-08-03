document.addEventListener("DOMContentLoaded", function(event) { 
    var apollo_11 = new buzz.sound('sounds/effects/apollo_11_speech.mp3', {preload: true, loop: false});
    apollo_11.setVolume(50);
    $(".astronaut").click(function(){
        apollo_11.togglePlay();
    });
});
