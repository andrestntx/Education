@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-hospital-o @stop
@section('title_page') <i class="fa fa-building-o"></i> Instituciones registradas
<a href="{{route('companies.create')}}" class="btn btn-primary" title="Nueva Institución"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('companies') !!} @stop

@section('content_body_page')
	<div class="row">
		@foreach($companies as $company)
		    <div class="col-lg-4">
		        <div class="widget">
		        	<div class="widget-content themed-background-social text-right clearfix">
		        		
		                <a href="{{route('companies.edit', $company->id)}}" class="pull-left">
		                    <img src="{{$company->logo}}" alt="{{$company->name}}" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
		                </a>
		                <h3 class="widget-heading text-light">{{ $company->name }}</h3>
		            </div>
		            <div class="widget-content themed-background-muted text-center">
		                <div class="btn-group">
		                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-effect-ripple btn-warning"><i class="fa fa-pencil"></i> Editar</a>
		                    <a href="{{ route('companies.users.index', $company->id) }}" class="btn btn-effect-ripple btn-info"><i class="fa fa-users"></i> Admins.</a>
		                </div>
		            </div>
		            <div class="widget-content">
		                <div class="row text-center">
		                    <div class="col-xs-6">
		                        <h3 class="widget-heading"><small>USUARIOS</small><br><a href="javascript:void(0)" class="themed-color-system">{{ $company->users_count }}</a></h3>
		                    </div>
		                    <div class="col-xs-6">
		                        <h3 class="widget-heading"><small>PROTOCOLOS</small><br><a href="javascript:void(0)" class="themed-color-system">{{ $company->protocols_count }}</a></h3>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
	    @endforeach
    </div>
    {!! $companies->render() !!}
@stop