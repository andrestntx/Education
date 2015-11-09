@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page')Institución {{ $user->company->name }} @stop
@section('content_body_page')
	<div class="row">
        
        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/users', 
                'widget_title'  => 'Usuarios', 
                'widget_count'  => $user->company->users->count(), 
                'widget_icon'   => 'gi gi-group',
                'widget_themed' => 'themed-background'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/users/roles', 
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
                'widget_icon'   => 'gi gi-building',
                'widget_themed' => 'themed-background-danger'
            ])
        </div>

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/protocols/categories', 
                'widget_title'  => 'Categorías', 
                'widget_count'  => $user->company->categories->count(), 
                'widget_icon'   => 'fa fa-folder-open',
                'widget_themed' => 'themed-background-warning'
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

        <div class="col-sm-6 col-lg-3">
            @include('dashboard.extends.widget',[
                'widget_url'    => '/exams', 
                'widget_title'  => 'Examenes', 
                'widget_count'  => $user->company->exams->count(), 
                'widget_icon'   => 'fa fa-check',
                'widget_themed' => 'themed-background'
            ])
        </div>

    </div>
@stop

@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
        <script src="assets/js/pages/readyDashboard.js"></script>
        <script>$(function(){ ReadyDashboard.init(); });</script>
@stop