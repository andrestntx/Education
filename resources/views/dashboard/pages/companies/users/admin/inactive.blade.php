@extends('dashboard.pages.layout')

@section('title_page')
    <i class="gi gi-group"></i> <b>Usuarios Inactivos</b>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @stop

@section('content_body_page')

    @foreach($users as $user)
        <div class="col-sm-3 col-md-2" id="{{ $user->id }}" data-toggle="tooltip" data-original-title="{{ $user->description }}" data-placement="bottom">
            <div class="media-items animation-fadeInQuick2" data-user="pdf">
                <div class="media-items-options text-right">
                    <a href="{{ route('users.scores', $user->id) }}" title="Ver Calificaciones" class="btn btn-xs btn-effect-ripple btn-info"><i class="fa fa-bar-chart-o"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" title="Habilitar Usuario" onclick="AppServices.postActivateUser(this)" data-entity-id="{{ $user->id }}" data-token="{{ csrf_token() }}" class="btn btn-xs btn-success"><i class="fa fa-hand-o-up"></i></a>
                </div>
                <div class="media-items-content">
                    {!! Html::image($user->image, 'Imagen Usuario', array('class' => 'thumb', 'style' => 'width:65px;')) !!}
                </div>
                <h4 class="h5">
                    <strong>{{ $user->name }}</strong><br>
                    <small><strong>@ {{ $user->username }}</strong>, <br> {{ $user->updated_at_hummans }}</small>
                </h4>
            </div>
        </div>
    @endforeach

@stop
@section('js_aditional')

@stop