@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-file-text"></i> Protocolos 
    <a href="{{route('protocols.create')}}" class="btn btn-primary" title="Nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('content_body_page')

    @foreach($protocols as $protocol)
        <div class="col-sm-4 col-lg-3" id="{{ $protocol->id }}" data-toggle="tooltip" data-original-title="{{ $protocol->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-category="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('protocols.show', $protocol->id) }}" class="btn btn-xs btn-info">Ver</a>
                    <a href="{{ route('protocols.edit', $protocol->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteProtocol(this)" data-entity-id="{{ $protocol->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="fa fa-file-pdf-o fa-5x text-warning"></i>
                </div>
                <h4>
                    <strong>{{ $protocol->name }}</strong><br>
                    <small>{{ $protocol->updated_at_hummans }}, <strong>{{ $protocol->number_questions }} <i class="fa fa-navicon"></i></strong></small>
                </h4>
            </div>
        </div>
    @endforeach
@stop
