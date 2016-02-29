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
  {!! Html::script('assets/js/services/AppUploadVimeo.js') !!}
  <script type="text/javascript">AppUploadVimeo.init(); </script>
@endsection