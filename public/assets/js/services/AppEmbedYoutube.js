/*
*  Document   : AppEmbedYoutube.js
*  Author     : andrestntx
*  Description: Custom javascript code used in the Youtube API
*/

var AppEmbedYoutube = function() {
	
	var videoHtml = function(videoId){
		return '<iframe width="100%" height="400" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';
	}

	return {
		init: function() {
			// This event embeds the video when the Modal is to be opened
			$('#modal-fade-youtube').on('show.bs.modal', function (e) {
				var video = $(e.relatedTarget).data('video');
				var videoId = $(e.relatedTarget).data('youtube');
				$("#modal-fade-youtube #modal-video-name").html(video.name);
				$("#modal-fade-youtube #embed").html(videoHtml(videoId));
			});

			// This event delete the video html when the Modal is to be closed
			$('#modal-fade-youtube').on('hidden.bs.modal', function (e) {
				$("#modal-fade-youtube #embed").html("");
			});
		},
	}	
}();