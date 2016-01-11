@extends('dashboard.pages.layout')
@section('title_page')
    <i class="fa fa-folder-open"></i> Categorías de Protocolos
    <a href="{{route('categories.create')}}" class="btn btn-primary" title="Nueva categoría"><i class="fa fa-plus"></i> </a>
@endsection

@section('breadcrumbs') {!! Breadcrumbs::render('categories') !!} @endsection

@section('content_body_page')
    @foreach($categories as $category)
        <div class="col-sm-4 col-lg-3" id="{{ $category->id }}" data-toggle="tooltip" data-original-title="{{ $category->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-category="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteCategory(this)" data-entity-id="{{ $category->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="fa fa-folder-open fa-5x text-warning"></i>
                </div>
                <h4>
                    <strong>{{ $category->name }}</strong><br>
                    <small>{{ $category->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach
@endsection
