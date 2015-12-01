@extends('dashboard.pages.layout')
@section('title_page')
    <i class="gi gi-show_thumbnails_with_lines"></i> Mis Protocolos Generados
    <a href="{{route('generated-protocols.create')}}" class="btn btn-primary" title="Generar nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop


@section('breadcrumbs') {!! Breadcrumbs::render('generated-protocols') !!} @stop 


@section('content_body_page')
    <div class="row">

        @foreach($generatedProtocols as $generatedProtocol)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <div class="widget text-center">
                    <div class="widget-content themed-background-muted">
                        <a href="{{ route('generated-protocols.edit', $generatedProtocol->id) }}">
                            <strong class="h4 text-dark"> {{ $generatedProtocol->title }}</strong>
                        </a>
                    </div>
                    <div class="widget-content">
                        <a href="{{ route('generated-protocols.show', $generatedProtocol->id) }}" target="_blank">
                            <i class="fa fa-3x fa-cloud-download text-primary"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@stop
