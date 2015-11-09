@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  {{$survey->name}} -
  @if($question->exists) Editar texto libre
  @else Nuevo texto libre @endif
@stop
@section('title_form') Datos del texto @stop
@section('form')
  {{ Form::model($question, $form_data) }}
    {{ Form::input('hidden', 'survey_id', $survey->id) }}
    {{ Form::input('hidden', 'type_id', $type_id) }}
    <div class="row">
      <div class="form-group">
        <div class="col-md-12">
            <div class="input-group">
                {{Form::textarea('text', null, array('class' => 'ckeditor', 'placeholder' => 'Texto', 'required' => 'required', 'style' => 'width:100%;'))}}
            </div>
        </div>
      </div>  
    </div>
    <div class="form-group form-actions">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Texto</button>
        </div>
    </div>
  {{Form::close()}}
@stop

@section('js_aditional')
  {{ HTML::script('assets/js/plugins/ckeditor/ckeditor.js'); }}
@stop
