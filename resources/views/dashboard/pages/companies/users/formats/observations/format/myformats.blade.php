@extends('dashboard.pages.layout')
@section('title_page')<i class="fa fa-check-square-o"></i> Formatos de Observaciones @stop
@section('breadcrumbs') {!! Breadcrumbs::render('myformats.observations') !!} @stop
@section('content_body_page')
    <div class="row">
        @foreach($formats as $format)
            <div class="col-sm-6 col-lg-4">
                @include('dashboard.extends.widget',[
                'widget_url'    => route('myformats.observations.doit.index', $format->id),
                'widget_title'  => $format->name,
                'widget_count'  => $format->getUserObservationsCount($user),
                'widget_icon'   => 'fa fa-folder-open',
                'widget_themed' => 'themed-background-warning'
                ])
            </div>
        @endforeach
    </div>
@stop

@section('js_aditional')
    <!-- Load and execute javascript code used only in this page -->
        <script src="assets/js/pages/readyDashboard.js"></script>
        <script>$(function(){ ReadyDashboard.init(); });</script>
@stop