@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($generator->exists) Editar Generador: {{ $generator->name }}
  @else Nuevo Generador @endif
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop
@section('title_form') Datos del Generador @stop
@section('form')
  {!! Form::model($generator, $form_data) !!}

    {!! Field::text('title', ['ph' => 'Nombre del Generador de Protocolos'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Generador</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop
