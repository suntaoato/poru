
$(document).ready(function() {
	
	$('#video').videoBG({
		mp4:'assets/tunnel_animation.mp4',
		ogv:'assets/tunnel_animation.ogv',
		webm:'assets/tunnel_animation.webm',
		poster:'assets/tunnel_animation.jpg',
		scale:false,
		zIndex:-1,
		width: 256,
		height:256,
		
	});
	
	
	$('#text_replacement_demo').videoBG({
		mp4:'assets/text_replacement.mp4',
		ogv:'assets/text_replacement.ogv',
		webm:'assets/text_replacement.webm',
		poster:'assets/text_replacement.png',
		textReplacement:true,
		width:760,
		height:500,
	});
		
})