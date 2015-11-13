@extends('dashboard.pages.form-layouts.horizontal')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page') 
  <i class="fa fa-building-o"></i> @if($company->exists) Editar Institución: {{ $company->name }} @else Nueva Institución @endif 
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('companies.company', $company) !!} @stop

@section('title_form') Datos de la Institución @stop

@section('form')
  {!! Form::model($company, $form_data) !!}

    {!! Field::text('name', ['class' => 'form-control', 'ph' => 'Nombre de la Institución']) !!}
    <div class="form-group">
      <label class="col-md-4 control-label" for="url_logo">Logo de la Institución <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
            <input id="url_logo" name="url_logo" type="file" class="file"></input>
          </div>
      </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Institución</button>
        </div>
    </div>
  {!! Form::close() !!}
@stop

@section('js_aditional')
  
@stop