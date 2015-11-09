@extends('dashboard.pages.layout')
@section('title_page')
  Lista de Chequeo: {{$survey->name}}, # {{$resolvedSurvey->id}} 
@stop
@section('content_body_page')
  <div class="block full"> 
    <div class="block-title">
      <div class="block-options pull-right">
          <a title="" data-toggle="tooltip" class="btn btn-effect-ripple btn-warning" href="{{route('formularios.registros.send', array($survey->id, $resolvedSurvey->id))}}" style="overflow: hidden; position: relative;" data-original-title="Enviar al Correo">
              <i class="fa fa-send-o"></i> Enviar al Correo
          </a>
      </div>
      <div class="block-options pull-right">
          <a title="" data-toggle="tooltip" class="btn btn-effect-ripple btn-success" href="{{route('formularios.registros.export', array($survey->id, $resolvedSurvey->id))}}" style="overflow: hidden; position: relative;" data-original-title="Descargar en Pdf">
              <i class="fa fa-file-pdf-o"></i> Descargar en Pdf
          </a>
      </div>
      <h2>{{$survey->description}}</h2>
    </div>
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        @foreach($resolvedSurvey->answers as $answer)
          <div class="block">
            <div class="block-title" style="margin-bottom:5px;">
              <h2>{{$answer->question->text}}</h2>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <p style="font-size:16px; margin-bottom:5px;">{{$answer->text}}</p>
                @if($answer->observation)
                  <p style="font-size:16px; margin-bottom:5px;"><strong>Observación:</strong> {{$answer->observation}}</p>
                @endif
              </div>
            </div>
          </div>
        @endforeach()
      </div>
    </div>
  </div>
@stop


