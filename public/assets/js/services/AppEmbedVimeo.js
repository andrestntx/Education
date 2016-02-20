/*
*  Document   : AppEmbedVimeo.js
*  Author     : andrestntx
*  Description: Custom javascript code used in the Vimeo Embed API
*/

var AppEmbedVimeo = function() {

    // This function loads the data from Vimeo
    function initVideo(url) {
        var js = document.createElement('script');
        js.setAttribute('type', 'text/javascript');
        js.setAttribute('src', url);
        document.getElementsByTagName('head').item(0).appendChild(js);
    };

	return {
		init: function() {
			// This event embeds the video when the Modal is to be opened
			$('#modal-fade').on('show.bs.modal', function (e) {
				var video = $(e.relatedTarget).data('video');
				$("#modal-video-name").html(video.name);

		        // This is the oEmbed endpoint for Vimeo (we're using JSON)
		        // (Vimeo also supports oEmbed discovery. See the PHP example.)
		        var endpoint = 'http://www.vimeo.com/api/oembed.json';
		        // Tell Vimeo what function to call
		        var callback = 'AppEmbedVimeo.embedVideo';
		        // Put together the URL
		        var url = endpoint + '?url=' + encodeURIComponent(video.url) + '&callback=' + callback + '&width=700';
		        // Call our init function when the page loads
		        initVideo(url);
			});

			// This event delete the video html when the Modal is to be closed
			$('#modal-fade').on('hidden.bs.modal', function (e) {
				$("#embed").html("");
			});
		},
		// This function puts the video on the page
	    embedVideo: function (video) {
	        $('#embed').append(unescape(video.html));
	    }
	}	
}();