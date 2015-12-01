@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-file-text"></i> Generador de Protocolos 
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('css_aditional')
    <style type="text/css">
        
    </style>
@endsection

@section('content_body_page')
    
    <div class="row">

        <div class="col-sm-5">
            <div class="block full">
                <div class="block-title">
                    <h2>Preguntas del Generador</h2>
                </div>
                
                <h4><i class="fa fa-question"></i> Nueva Pregunta</h4>
                <input type="text" id="newQuestion" placeholder="Escriba la pregunta.." class="form-control" data-token="{{ csrf_token() }}" required>
                <hr>

                <ul class="list-unstyled sortable" style="margin-top:20px;">
                    @foreach($company->protocolGeneratorQuestions as $question)
                        <li class="well well-sm" id="{{ $question->id }}" style="cursor:pointer;">
                            <a href="#"><i class="gi gi-bin pull-right text-danger" onclick="AppProtocolGenerator.postDeleteQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
                            <a href="#" class="editable h4" data-url="/protocol-generator/{{ $question->id }}" data-pk="{{ $question->id }}">
                                {{ $question->text }}
                            </a>
                        </li>
                    @endforeach 
                </ul>
            </div>
        </div>

        <div class="col-sm-7">
          <div class="block">
              <div class="block-title">
                  <h2>Protocolos Generados</h2>
              </div>

          </div>
        </div>
    </div>

@stop

@section('js_aditional')
    {!! Html::script('/assets/js/services/AppProtocolGenerator.js') !!}
    <script> AppProtocolGenerator.init() </script> 
@endsection