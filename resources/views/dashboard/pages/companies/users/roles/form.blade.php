@extends('dashboard.pages.form-layouts.horizontal')

@section('title_page')
  @if($role->exists) Editar Perfil: {{$role->name}}
  @else Nuevo Perfil @endif
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('roles.role', $role) !!} @stop

@section('title_form') Datos del Perfil @stop

@section('form')
  {!! Form::model($role, $form_data) !!}
    {!! Field::text('name', ['ph' => 'Nombre del área'])!!}
    {!! Field::text('description', ['ph' => 'Descripción del área'])!!}
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Perfil</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop