@extends('dashboard.pages.layout')

@section('css_aditional')
    <link rel="stylesheet" type="text/css" href="/assets/css/plugins/jquery-sorteable.css">
    <style type="text/css">
        .question-option{
            margin: 0 3px;
        }
    </style>
@endsection

@section('title_page') 
    <i class="fa fa-file-text"></i> Generador de Protocolos 
    <a href="{{route('generators.create')}}" class="btn btn-primary" title="Generar nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('css_aditional')
    <style type="text/css">
        
    </style>
@endsection

@section('content_body_page')
    
    <div class="row">
        <div class="col-sm-12">
          <div class="block">
                <div class="block-title themed-background text-light-op">
                    <h2>Generadores de Protocolos</h2>
                </div>
                <div class="row">
                    @foreach($company->generators as $generator)
                        <div class="col-xs-6 col-sm-12 col-md-4">
                            <div class="widget">
                                <a href="{{ route('generators.show', $generator->id) }}" class="widget-content text-right clearfix themed-background-info">
                                    <img src="/images/placeholders/icons/file-protocol.png" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar pull-left">
                                    <h2 class="widget-heading h4 text-light"><strong>{{ $generator->title }}</strong></h2>
                                    <span class="text-light-op">Generador</span>
                                </a>
                                <div class="widget-content themed-background-muted text-dark text-right" style="padding: 5px 15px;">
                                    <a href="{{ route('generators.edit', $generator->id) }}">
                                        <i class="fa fa-2x fa-pencil text-warning"></i>
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
    
@endsection