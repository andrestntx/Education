@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page') @if($area->exists) Editar Área: {{$area->name}} @else Nueva Área @endif @stop
@section('title_form') Datos del Área @stop
@section('breadcrumbs') {!! Breadcrumbs::render('areas.area', $area) !!} @stop
@section('form')
  {!! Form::model($area, $form_data) !!}

    {!! Field::text('name', ['ph' => 'Nombre del área'])!!}
    {!! Field::text('description', ['ph' => 'Descripción del área'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Área</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop
