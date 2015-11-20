@extends('dashboard.pages.form-layouts.horizontal')
@section('title_page')
  <i class="fa fa-check-square-o"></i> {{ $format->name }}: Aplicar 
@stop
@section('breadcrumbs') {!! Breadcrumbs::render('myformats.checklists.apply', $format) !!} @stop
@section('title_form') Llena la seguiente lista de chequeo @stop
@section('form')
  {!! Form::model($checklist, $form_data) !!}
    {!! Field::text('applied', ['ph' => 'Aplicada a:']) !!}
    @foreach($format->questions as $question)
      <div class="form-group">  
        <label class="col-md-5 control-label h4">{{$question->text}}</label>   
        <div class="col-md-7"> 
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
    {!! Field::textarea('observation', ['ph' => 'Observaciones:']) !!}
    <div class="form-group form-actions">
      <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Guardar</button>
      </div>
    </div>
  {!! Form::close() !!}
@stop
