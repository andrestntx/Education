@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page')<i class="fa fa-check-square-o"></i> Listas de chequeo @stop
@section('breadcrumbs') {!! Breadcrumbs::render('myFormats') !!} @stop
@section('content_body_page')
	<div class="row">
        @foreach($formats as $format)
            <div class="col-sm-6 col-lg-3">
                @include('dashboard.extends.widget',[
                'widget_url'    => 'checklists/'. $format->id ,
                'widget_title'  => $format->name,
                'widget_count'  => $format->getUserChecklistsCount($user),
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