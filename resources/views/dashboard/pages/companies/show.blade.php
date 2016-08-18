@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page')<i class="gi gi-building"></i> {{ $user->company->name }} @stop
@section('breadcrumbs') {!! Breadcrumbs::render('home') !!} @stop
@section('content_body_page')
	<div class="row">
        
        <div class="col-sm-12 border-bottom">
            <h4>Configuración</h4>
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/users', 
                'widget_title'  => 'Usuarios', 
                'widget_count'  => $user->company->users()->registereds()->count(), 
                'widget_icon'   => 'gi gi-group',
                'widget_themed' => 'themed-background'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/roles', 
                'widget_title'  => 'Perfiles', 
                'widget_count'  => $user->company->roles->count(), 
                'widget_icon'   => 'gi gi-old_man',
                'widget_themed' => 'themed-background-success'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/areas', 
                'widget_title'  => 'Áreas', 
                'widget_count'  => $user->company->areas->count(), 
                'widget_icon'   => 'fa fa-sitemap',
                'widget_themed' => 'themed-background-danger'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/categories', 
                'widget_title'  => 'Categorías', 
                'widget_count'  => $user->company->categories->count(), 
                'widget_icon'   => 'fa fa-folder-open',
                'widget_themed' => 'themed-background-warning'
            ])
        </div>

        <div class="col-sm-12 border-bottom">
            <h4>Protocolos</h4>
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/generators', 
                'widget_title'  => 'Generador de Protocolos', 
                'widget_count'  => $user->company->generators->count(), 
                'widget_icon'   => 'hi hi-edit',
                'widget_themed' => 'themed-background-success'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/protocols', 
                'widget_title'  => 'Protocolos', 
                'widget_count'  => $user->company->protocols->count(), 
                'widget_icon'   => 'fa fa-file-text',
                'widget_themed' => 'themed-background-info'
            ])
        </div>

        <div class="col-sm-12 border-bottom">
            <h4>Formatos</h4>
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/formats/checklists', 
                'widget_title'  => 'Listas de Chequeo', 
                'widget_count'  => $user->company->formats->count(), 
                'widget_icon'   => 'fa fa-check-square-o',
                'widget_themed' => 'themed-background'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/formats/observations', 
                'widget_title'  => 'Observaciones', 
                'widget_count'  => $user->company->observationFormats->count(), 
                'widget_icon'   => 'fa fa-check-square-o',
                'widget_themed' => 'themed-background-danger'
            ])
        </div>

    </div>
@stop

@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
        <script src="assets/js/pages/readyDashboard.js"></script>
        <script>$(function(){ ReadyDashboard.init(); });</script>
@stop