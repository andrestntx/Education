@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  <i class="fa fa-check-square-o"></i> 
  {{ $format->name }}: Aplicado 
  <a href="{{ route('myformats.checklists.doit.donwload', [$format->id, $checklist->id]) }}" target="_blank" title="Descargar PDF">
    <i class="gi gi-cloud-download"></i>
  </a>
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('myformats.checklists.doit.apply', $format) !!} @stop
@section('title_form') Lista de chequeo aplicada @stop
@section('form')
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Fecha:</b> {{ $checklist->created_at_hummans }} - {{ $checklist->created_at }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Aplicada a:</b> {{ $checklist->applied }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Observaciones:</b> {{ $checklist->observation }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h3 lead"><strong>Preguntas</strong></p>
      </div>

      @foreach($checklist->answers as $answer)
        <div class="col-xs-offset-1 col-xs-10">
          <p class="well">
            <strong>{{ $answer->question->text }}</strong> <br>
            <i class="gi gi-check"></i> {{ $answer->text }}
          </p>
        </div>
      @endforeach

    </div>
    

   

@stop
