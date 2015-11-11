@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($category->exists) Editar Categoría: {{$category->name}}
  @else Nueva Categoría @endif
@stop
@section('title_form') Datos de la Categoría @stop
@section('form')
  {!! Form::model($category, $form_data) !!}

    {!! Field::text('name', ['ph' => 'Nombre de la categoría'])!!}
    {!! Field::text('description', ['ph' => 'Descripción de la categoría'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Categoría</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop
