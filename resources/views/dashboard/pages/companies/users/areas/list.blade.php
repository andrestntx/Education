@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-sitemap @endsection
@section('title_page') 
    <i class="fa fa-sitemap"></i> Áreas de la Institución 
    <a href="{{route('areas.create')}}" class="btn btn-primary" title="Nueva área"><i class="fa fa-plus"></i> </a>
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('areas') !!} @endsection

@section('content_body_page')

    @foreach($areas as $area)
        <div class="col-sm-4 col-lg-3" id="{{ $area->id }}" data-toggle="tooltip" data-original-title="{{ $area->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-category="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteArea(this)" data-entity-id="{{ $area->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="fa fa-sitemap fa-5x text-info"></i>
                </div>
                <h4>
                    <strong>{{ $area->name }}</strong><br>
                    <small>{{ $area->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach
              
@endsection
@section('js_aditional')

@endsection