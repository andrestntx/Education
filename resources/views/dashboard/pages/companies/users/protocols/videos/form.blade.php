@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($video->exists) Editar Video: {{$video->name}}
  @else Nuevo Video @endif
@stop

@section('css_aditional')
  <!-- blueimp Gallery styles -->
  <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <link rel="stylesheet" href="/assets/css/plugins/fileupload/jquery.fileupload.css">
  <link rel="stylesheet" href="/assets/css/plugins/fileupload/jquery.fileupload-ui.css">

  <style type="text/css">
    #drop_zone {
      border: 2px dashed #bbb;
      -moz-border-radius: 5px;
      -webkit-border-radius: 5px;
      border-radius: 5px;
      padding: 25px;
      text-align: center;
      font: 20pt bold 'Helvetica';
      color: #bbb;
    }
  </style>
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('protocols.protocol.link', $protocol, $video) !!} @stop
@section('title_form') Datos del Video @stop
@section('form')
  {!! Form::model($video, $form_data + ['id' => 'saveVideo', 'data-fileid' => $video->getVimeoId()]) !!}
    {!! Field::hidden('redirect', route('protocols.show', $protocol), ['id' => 'formRedirect']) !!}
    {!! Field::text('name', ['ph' => 'Título del Video', 'id' => 'form-name'])!!}
    {!! Field::text('description', ['ph' => 'Descripción del Video', 'id' => 'form-description'])!!}
    {!! Field::file('video', ['id' => 'drop_zone', 'ph' => 'Arrastre y suelte el Video aquí']) !!}

    <div class="form-group">
      <div class="col-md-offset-1 col-md-10">
        
        <br>
        <div class="progress">
          <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
           0%
          </div>
        </div>
        <div id="results"></div>
      </div>
    </div>

    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Video</button>
        </div>
    </div>
  {!! Form::close() !!}

@stop

@section('js_aditional')
  <script src="/assets/js/validations/video.js"></script>
  <script src="/assets/js/plugins/uploadvimeo/upload.js"></script>
  <script type="text/javascript">

    var videoId = $("#saveVideo").data('fileid');

    if(videoId){
      FormsValidation.init(false);    
    }
    else {
      FormsValidation.init(true);
    }
     
     /**
      * Called when files are dropped on to the drop target. For each file,
      * uploads the content to Drive & displays the results when complete.
      */
     function handleFileSelect(evt, params, urlPost) {
       var file = $('#drop_zone')[0].files[0];

       var accessToken = '6bd731bdbb0654010d5f94bd3ebf6755';
       var upgrade_to_1080 = false;

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

              var url = "https://vimeo.com/"+videoId;
              params.url = url;

              AppServices.notification('success', 'El video se está procesando');
              postNewVideo(urlPost, params);
           }
       });
      uploader.upload();
     };

    var postNewVideo = function (url, data) {

      var method = 'POST';
      if(videoId){
        method = 'PUT';
      }

      $.ajax({
            url: url,
            data: data,
            dataType:'json',
            method: method,
            success:function(data){
                if(data['success']){
                  AppServices.notification('info', data['message']);
                  window.setTimeout(function() {
                    window.location.href = $("#formRedirect").attr('value');
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


     $("#saveVideo").submit(function( event ) {
        if($('#saveVideo').valid()) {
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
            console.log(data);
            AppServices.notification('success', 'Solo se actualizará la información del video');
            postNewVideo(urlPost, data);
          }
        }
      });

     /**
      * Updat progress bar.
      */
     function updateProgress(progress) {
        progress = Math.floor(progress * 100);
        var element = document.getElementById('progress');
        element.setAttribute('style', 'width:'+progress+'%');
        element.innerHTML = progress+'%';
     }
  </script>
@endsection