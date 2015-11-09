@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  Formulario : {{$survey->name}}
@stop
@section('title_form') Responda las siguientes Preguntas @stop
@section('form')
  {{ Form::model($resolvedSurvey, $form_data) }}    
    @foreach($survey->randomQuestions() as $question)
      <div class="form-group">  
        <label class="col-md-4 h4">{{$question->text}}</label>   
        @if($question->isMultiple())
          <div class="col-md-8"> 
            @foreach($question->answers as $answer)
              <div class="radio">
                <label style="font-size:16px;" for="answers[{{$question->id}}][{{$answer->id}}]">
                    <input type="radio" name="answers[{{$question->id}}]" id="answers[{{$question->id}}][{{$answer->id}}]" value="{{$answer->id}}" required/>
                    {{$answer->text}}
                </label>
              </div>
            @endforeach
          </div>
        @else
          <div class="col-md-12"> 
            <div class="input-group">
              {{Form::textarea('simpleAnswers['.$question->id.']', null, array('class' => 'ckeditor', 'required' => 'required', 'style' => 'width:100%;'))}}
            </div>
          </div>
        @endif
      </div>
    @endforeach
    <div class="form-group form-actions">
      <div class="col-md-8 col-md-offset-4">
          @if($survey->questions->isEmpty())
            <button type="submit" class="btn btn-effect-ripple btn-primary" disabled>Guardar</button>
          @else
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
          @endif
      </div>
    </div>
  {{Form::close()}}
@stop

@section('js_aditional')
  <script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>
@stop
