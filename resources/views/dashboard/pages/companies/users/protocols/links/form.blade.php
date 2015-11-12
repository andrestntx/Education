@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($link->exists) Editar Link: {{$link->name}}
  @else Nuevo Link @endif
@stop
@section('title_form') Datos del Link @stop
@section('form')
  {!! Form::model($link, $form_data) !!}

    {!! Field::text('url', ['ph' => 'url'])!!}
    {!! Field::text('name', ['ph' => 'Nombre del link'])!!}
    {!! Field::text('description', ['ph' => 'Descripción del Link'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Link</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop
