@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  Presentando Examen : Protocolo {{$protocol->name}}
@stop
@section('title_form') Responda las siguientes Preguntas @stop
@section('form')
  {{ Form::model($exam, $form_data) }}    
    @foreach($protocol->survey->randomQuestions() as $question)
      <div class="form-group">  
        <label class="col-md-4 control-label h4">{{$question->text}}</label>   
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
      </div>
    @endforeach
    <div class="form-group form-actions">
      <div class="col-md-8 col-md-offset-4">
          @if($protocol->survey->questions->isEmpty() || !$protocol->survey_aviable)
            <button type="submit" class="btn btn-effect-ripple btn-primary" disabled>Enviar Examen</button>
          @else
            <button type="submit" class="btn btn-effect-ripple btn-primary">Enviar Examen</button>
          @endif
      </div>
    </div>
  {{Form::close()}}
@stop
