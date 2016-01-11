@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-sitemap @stop
@section('title_page')

<i class="gi gi-group"></i> Usuarios
<a href="{{route('users.create')}}" class="btn btn-primary" title="Nuevo usuario"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @stop

@section('content_body_page')

    @foreach($users as $user)
        <div class="col-sm-4 col-lg-3" id="{{ $user->id }}" data-toggle="tooltip" data-original-title="{{ $user->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-user="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('users.scores', $user->id) }}" title="Ver Calificaciones" class="btn btn-xs btn-effect-ripple btn-info"><i class="fa fa-bar-chart-o"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" onclick="AppServices.postDeleteuser(this)" data-entity-id="{{ $user->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                </div>
                <div class="media-items-content">
                    {!! Html::image($user->image, 'Imagen Usuario', array('class' => 'thumb', 'style' => 'width:65px;')) !!}
                </div>
                <h4>
                    <strong>{{ $user->name }}</strong><br>
                    <small><strong>@ {{ $user->username }}</strong>, {{ $user->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach

@stop
@section('js_aditional')

@stop