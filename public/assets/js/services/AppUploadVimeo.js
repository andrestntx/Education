/*
*  Document   : AppUloadVimeo.js
*  Author     : andrestntx
*  Description: Custom javascript code used in the Vimeo Embed API
*/

var AppUploadVimeo = function() {

  var file = null;
  var accessToken = '6bd731bdbb0654010d5f94bd3ebf6755';
  var upgrade_to_1080 = false;
  var videoId = $("#saveVideo").data('fileid');
  var formRedirect = $("#formRedirect").val();

  var getUrlPublicVimeo = function(videoId){
    return "https://vimeo.com/" + videoId;
  }

  var getMethodUploadVimeo = function(){
    if(videoId){
      return 'PUT';
    }

    return 'POST';
  }
  
  /**
  * Updat progress bar.
  */
  var updateProgress = function(progress) {
    progress = Math.floor(progress * 100);    
    var element = $('#progress');
    element.attr('style', 'width:'+progress+'%');
    element.html(progress + '%');
  }

  /**
  * Called when files are dropped on to the drop target. For each file,
  * uploads the content to Drive & displays the results when complete.
  */
  var handleFileSelect = function(evt, params, urlPost) {
    
    // Clear the results div
    var node = document.getElementById('results');
    while (node.hasChildNodes()) node.removeChild(node.firstChild);

    // Rest the progress bar
    updateProgress(0);

    var uploader = new MediaUploader({
      file: file,
      fileId: videoId,
      token: accessToken,
      upgrade_to_1080: upgrade_to_1080,
      params: params,
      onError: function(data) {
        var errorResponse = JSON.parse(data);
        message = errorResponse.error;

        var element = document.createElement("div");
        element.setAttribute('class', "alert alert-danger");
        element.appendChild(document.createTextNode(message));
        document.getElementById('results').appendChild(element);
       },
       onProgress: function(data) {
          updateProgress(data.loaded / data.total);
       },
       onComplete: function(videoId) {
          var url = getUrlPublicVimeo(videoId);
          params.url = url;

          AppServices.notification('success', 'El video se está procesando');
          postNewVideo(urlPost, params);
       }
    });
    uploader.upload();
  };

  // Save or Update new Video in DB
  var postNewVideo = function (url, data) {

    $.ajax({
      url: url,
      data: data,
      dataType:'json',
      method: getMethodUploadVimeo(),
      success:function(data){
        if(data['success']) {
          AppServices.notification('info', data['message']);
          window.setTimeout(function() {
            window.location.href = formRedirect;
          }, 1000);
        }
        else{
          AppServices.notification('danger', data['message']);
        }
      },
      error:function(){
          alert('fallo la conexion');
      }
    });

  };

  return {
    init: function(){

      if(videoId) {
        videoValidation.init(false);    
      }
      else {
        videoValidation.init(true);
      }

      $("#saveVideo").submit(function( event ) {
        if($('#saveVideo').valid()) {
          file = $('#drop_zone')[0].files[0];
          event.stopPropagation();
          event.preventDefault();

          var urlPost = $("#saveVideo").attr('action');      
          var name = $("#form-name").val();
          var description = $("#form-description").val();

          data = {
            name: name, 
            description: description,
          };

          if($("#drop_zone").val()) {
            AppServices.notification('info', 'Se ha empezado a subir el Video');
            handleFileSelect(event, data, urlPost);  
          }
          else {
            AppServices.notification('success', 'Solo se actualizará la información del video');
            postNewVideo(urlPost, data);
          }
        }
      });    
    }
  }

}();
  