@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  @if($category->exists) Editar Categoría: {{$category->name}}
  @else Nuevo Categoría @endif
@stop
@section('title_form') Datos de la Categoría @stop
@section('form')
  {{ Form::model($category, $form_data) }}
    {{ Form::input('hidden', 'company_id', Auth::user()->preferredCompany->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre de la Categoría <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre de la Categoría', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción de la Categoría </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción de la Categoría'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Categoría</button>
        </div>
    </div>
  {{Form::close()}}
@stop
