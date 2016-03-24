function cientist(message, timer){
	setTimeout(function(){
    	$(".cientist-message").hide();
    	$(".cientist-text").html(message);
    	$(".cientist-message").show('slow');
	}, timer);
}

function fala_hide() {
	
}

function fullscreen_video(video){
	if (video.requestFullscreen) {
		video.requestFullscreen();
	} else if (video.mozRequestFullScreen) {
		video.mozRequestFullScreen();
	} else if (video.webkitRequestFullscreen) {
		video.webkitRequestFullscreen();
	}
	
}

function fullscreen_exit(){
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

function change_background(url, timer){
	if(url != ''){
		setTimeout(function() {
		$("body").css("background", "url('"+ url +"') center center /cover");
		}, timer);
	} else {
		$("body").removeAttr('css');
	}


}