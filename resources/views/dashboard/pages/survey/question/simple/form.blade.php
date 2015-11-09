@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  {{$survey->name}} -
  @if($question->exists) Editar Pregunta
  @else Nueva Pregunta @endif
@stop
@section('title_form') Datos de la Pregunta @stop
@section('form')
  {{ Form::model($question, $form_data) }}
    {{ Form::input('hidden', 'survey_id', $survey->id) }}
    {{ Form::input('hidden', 'type_id', $type_id) }}
    <div class="row">
      <div class="form-group">
        <label class="col-md-3 control-label" for="text">Pregunta <span class="text-danger">*</span></label>
        <div class="col-md-7">
            <div class="input-group">
                {{Form::text('text', null, array('class' => 'form-control', 'placeholder' => 'Pregunta', 'required' => 'required'))}}
                <span class="input-group-addon"><i class="fa fa-question"></i></span>
            </div>
        </div>
      </div>  
    </div>
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Pregunta</button>
        </div>
    </div>
  {{Form::close()}}
@stop