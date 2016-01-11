@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  <i class="fa fa-check-square-o"></i> 
  {{ $format->name }}: Aplicado 
  <a href="{{ route('myformats.observations.doit.donwload', [$format->id, $observation->id]) }}" target="_blank" title="Descargar PDF">
    <i class="gi gi-cloud-download"></i>
  </a>
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('myformats.observations.doit.apply', $format) !!} @stop
@section('title_form') Lista de chequeo aplicada @stop
@section('form')
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Fecha:</b> {{ $observation->created_at_hummans }} - {{ $observation->created_at }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Aplicada a:</b> {{ $observation->applied }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h4"> <b>Observaciones:</b> {{ $observation->observation }}</p>
      </div>

      <div class="col-xs-offset-1 col-xs-10">
        <p class="h3 lead"><strong>Preguntas</strong></p>
      </div>

      @foreach($observation->answers as $answer)
        <div class="col-xs-offset-1 col-xs-10">
          <p class="well">
            <strong>{{ $answer->question->text }}</strong> <br>
            <i class="gi gi-check"></i> {{ $answer->text }} <br>
            <i class="fa fa-eye"></i> {{ $answer->observation }}
          </p>
        </div>
      @endforeach

    </div>
    

   

@stop
