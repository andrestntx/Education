@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') fa fa-sitemap @stop
@section('title_page') @if($area->exists) Editar Área: {{$area->name}} @else Nueva Área @endif @stop
@section('title_form') Datos del Área @stop
@section('form')
  {{ Form::model($area, $form_data) }}
    {{ Form::input('hidden', 'company_id', Auth::user()->preferredCompany->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Área <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Área', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción del Área </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Área'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Área</button>
        </div>
    </div>
  {{Form::close()}}
@stop
