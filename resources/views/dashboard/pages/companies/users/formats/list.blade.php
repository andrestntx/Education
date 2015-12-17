@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-check-square-o fa-fw"></i> Formatos de Chequeo
    <a href="{{route('formats.create')}}" class="btn btn-primary" title="Nueva formato de chequeo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('formats') !!} @stop

@section('content_body_page')
    @foreach($formats as $format)
        <div class="col-sm-4 col-lg-3" id="{{ $format->id }}" data-toggle="tooltip" data-original-title="{{ $format->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-category="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('formats.show', $format->id) }}" class="btn btn-xs btn-info">Ver</a>
                    <a href="{{ route('formats.edit', $format->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteFormat(this)" data-entity-id="{{ $format->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="fa fa-file-text-o fa-5x text-info"></i>
                </div>
                <h4>
                    <strong>{{ $format->name }}</strong><br>
                    <small>{{ $format->updated_at_hummans }}, <strong>{{ $format->number_questions }} <i class="gi gi-check"></i></strong></small>
                </h4>
            </div>
        </div>
    @endforeach
@stop
