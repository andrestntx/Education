@extends('dashboard.pages.layout')
@section('title_page')
    <i class="gi gi-old_man"></i> Perfiles de Usuario
    <a href="{{route('roles.create')}}" class="btn btn-primary" title="Nuevo Perfil"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('roles') !!} @stop

@section('content_body_page')
    @foreach($roles as $role)
        <div class="col-sm-4 col-lg-3" id="{{ $role->id }}" data-toggle="tooltip" data-original-title="{{ $role->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-role="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteRole(this)" data-entity-id="{{ $role->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    <i class="gi gi-old_man fa-5x text-success"></i>
                </div>
                <h4>
                    <strong>{{ $role->name }}</strong><br>
                    <small>{{ $role->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach

@stop

@section('js_aditional')
    
@stop