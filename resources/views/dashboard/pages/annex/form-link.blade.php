@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  Protocolo {{$protocol->name}} - @if($annex->exists) Editar Enlace: {{$annex->name}} @else Nuevo Enlace @endif
@stop
@section('title_form') Datos de la Enlace @stop
@section('form')
  {{ Form::model($annex, $form_data) }}
    {{ Form::input('hidden', 'protocol_id', $protocol->id) }}
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Nombre del Enlace <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre del Enlace', 'required' => 'required'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>  
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Descripción de la Enlace </label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Descripción del Enlace'))}}
              <span class="input-group-addon"><i class="fa fa-bars"></i></span>
          </div>
      </div>
    </div>     
    <div class="form-group">
      <label class="col-md-4 control-label" for="url">Link <span class="text-danger">*</span></label>
      <div class="col-md-6">
          <div class="input-group">
              {{Form::text('url', null, array('class' => 'form-control', 'placeholder' => 'Link del Enlace'))}}
              <span class="input-group-addon"><i class="fa fa-share"></i></span>
          </div>
      </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Enlace</button>
        </div>
    </div>
  {{Form::close()}}
@stop

