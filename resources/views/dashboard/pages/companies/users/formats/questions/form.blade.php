@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  Formato {{ $format->name }} -
  @if($question->exists) Editar Pregunta
  @else Nueva Pregunta @endif
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('formats.format.question', $format, $question) !!} @stop
@section('title_form') Datos de la Pregunta @stop
@section('form')
  {!! Form::model($question, $form_data) !!}

    <div class="row">
      <div class="form-group">
        <label class="col-md-3 control-label" for="text">Pregunta <span class="text-danger">*</span></label>
        <div class="col-md-6">
            <div class="input-group">
                {!! Form::text('text', null, array('class' => 'form-control', 'placeholder' => 'Pregunta', 'required' => 'required')) !!}
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
            </div>
        </div>
      </div>  
      <div class="form-group"> 
        <h4 style="margin-left:10%;">Respuestas</h4>
      </div>
      @if( !$question->exists)
        @for($i=1; $i <= $number_answers; $i++ )
          <div class="form-group">
            <label class="col-md-3 control-label" for="answers[{{$i}}][text]">Respuesta {{$i}} <span class="text-danger">*</span></label> 
            <div class="col-md-6">      
              {!! Form::text('answers['.$i.'][text]', null, array('required' => 'required', 
                'placeholder' => 'Respuesta '.$i, 'class' => 'form-control')) !!}
            </div>
          </div>
        @endfor
      @else
        @foreach($question->answers as $answer)
            <div class="form-group">
              <label class="col-md-3 control-label" for="answers[{{$answer->id}}][text]">Respuesta <span class="text-danger">*</span></label>     
              <div class="col-md-6">      
                {!! Form::text('answers['.$answer->id.'][text]', $answer->text, ['required', 
                  'placeholder' => 'Respuesta ', 'class' => 'form-control']) !!}
              </div>
            </div>
          @endforeach
        @endif
      </div>
      <div class="form-group form-actions">
          <div class="col-md-8 col-md-offset-4">
              <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar Pregunta</button>
          </div>
      </div>
    </div>
  {!! Form::close() !!}
@stop