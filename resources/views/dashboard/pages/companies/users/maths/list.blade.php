@extends('dashboard.pages.layout')
@section('title_page')
    <i class="fa fa-line-chart"></i> Fórmulas
    <a href="{{route('maths.create')}}" class="btn btn-primary" title="Nueva Fórmula"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('maths') !!} @stop

@section('content_body_page')
    @foreach($maths as $math)
        <div class="col-sm-4 col-lg-3" id="{{ $math->id }}" data-toggle="tooltip" data-original-title="{{ $math->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-math="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('maths.edit', $math->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteMath(this)" data-entity-id="{{ $math->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="fa fa-line-chart fa-5x text-success"></i>
                </div>
                <h4>
                    <strong>{{ $math->title }}</strong><br>
                    <small>{{ $math->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach

@stop

@section('js_aditional')
    
@stop