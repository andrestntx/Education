@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($role->exists) Editar Perfil: {{$role->name}}
  @else Nuevo Perfil @endif
@stop
@section('title_form') Datos del Perfil @stop
@section('form')
  {{ Form::model($role, $form_data) }}
    {{ Form::input('hidden', 'company_id', Auth::user()->preferredCompany->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Perfil <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Perfil', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción del Perfil </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Perfil'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Perfil</button>
        </div>
    </div>
  {{Form::close()}}
@stop