@extends('dashboard.pages.layout')

@section('css_aditional')
    <style type="text/css">
        .question-option{
            margin: 0 3px;
        }
    </style>
@endsection

@section('title_page') 
    <i class="fa fa-file-text"></i> Generador de Protocolos 
    <a href="{{route('generated-protocols.create')}}" class="btn btn-primary" title="Generar nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('css_aditional')
    <style type="text/css">
        
    </style>
@endsection

@section('content_body_page')
    
    <div class="row">

        <div class="col-sm-4">
            <div class="block full">
                <div class="block-title themed-background-info text-light-op">
                    <h2>Preguntas</h2>
                </div>
                
                <h4><i class="fa fa-question"></i> Nueva Pregunta</h4>
                <input type="text" id="newQuestion" placeholder="Escriba la pregunta.." class="form-control" data-token="{{ csrf_token() }}" required>
                <hr>

                <ul class="list-unstyled sortable" style="margin-top:20px;">
                    @foreach($company->protocolGeneratorQuestions as $question)
                        <li class="well well-sm" id="{{ $question->id }}" style="cursor:pointer;">
                            <a href="#" title="Borrar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-danger"><i class="gi gi-bin" onclick="AppProtocolGenerator.postDeleteQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
                            
                            @if($question->aviable)
                                <a href="javascript:void(0)" title="Desactivar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-warning"><i class="gi gi-thumbs_down" onclick="AppProtocolGenerator.postDeactivateQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
                            @else
                                <a href="javascript:void(0)" title="Activar Pregunta" data-toggle="tooltip" class="pull-right question-option btn btn-xs btn-success"><i class="gi gi-thumbs_up" onclick="AppProtocolGenerator.postDeactivateQuestion(this)" data-entity-id="{{ $question->id }}"></i></a>
                            @endif

                            <a href="#" class="editable h4" data-url="/protocol-generator/{{ $question->id }}" data-pk="{{ $question->id }}">
                                {{ $question->text }}
                            </a>
                        </li>
                    @endforeach 
                </ul>
            </div>
        </div>


        <div class="col-sm-8">
          <div class="block">
                <div class="block-title themed-background text-light-op">
                    <h2>Protocolos Generados</h2>
                </div>
                <div class="row">
                    @foreach($company->generatedProtocols as $generatedProtocol)
                        <div class="col-xs-6 col-sm-12 col-md-6">
                            <div class="widget">
                                <a href="{{ route('generated-protocols.edit', $generatedProtocol->id) }}" class="widget-content text-right clearfix themed-background-info">
                                    <img src="/images/placeholders/icons/file-protocol.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                                    <h2 class="widget-heading h4 text-light"><strong>{{ $generatedProtocol->title }}</strong></h2>
                                    <span class="text-light-op">{{ $generatedProtocol->user->name }}</span>
                                </a>
                                <div class="widget-content themed-background-muted text-dark text-right" style="padding: 5px 15px;">
                                    <a href="{{ route('generated-protocols.show', $generatedProtocol->id) }}" target="_blank">
                                        <i class="fa fa-2x fa-cloud-download text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
          </div>
        </div>
    </div>

@stop

@section('js_aditional')
    {!! Html::script('/assets/js/services/AppProtocolGenerator.js') !!}
    <script> AppProtocolGenerator.init() </script> 
@endsection