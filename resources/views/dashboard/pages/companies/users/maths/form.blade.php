@extends('dashboard.pages.form-layouts.horizontal')

@section('title_page')
  <i class="fa fa-line-chart"></i>
  @if($math->exists) Editar Fórmula: {{$math->name}}
  @else Nuevo Fórmula @endif
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('maths.math', $math) !!} @stop

@section('title_form') Datos del Fórmula @stop

@section('form')
  {!! Form::model($math, $form_data) !!}
    {!! Field::text('title', ['ph' => 'Titulo'])!!}
    {!! Field::text('url', ['ph' => 'Dirección de la página'])!!}
    {!! Field::text('description', ['ph' => 'Descripción de la Fórmula'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Fórmula</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop