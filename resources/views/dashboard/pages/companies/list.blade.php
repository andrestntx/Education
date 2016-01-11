@extends('dashboard.pages.layout')

@section('title_page') <i class="gi gi-building"></i> Instituciones registradas
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
		                <h5 class="widget-heading text-light">{{ $company->tel }}</h5>
		                <h5 class="widget-heading text-light">{{ $company->address }}</h5>
		                <h5 class="widget-heading text-light">{{ $company->email }}</h5>
		                @if(! $company->active)<span class="label label-danger" style="font-size: 18px;">Inactiva</span> @endif
		            </div>
		            <div class="widget-content themed-background-muted text-center">
		                <div class="btn-group">
		                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-effect-ripple btn-warning"><i class="fa fa-pencil"></i> Editar</a>
		                    <a href="{{ route('companies.users.index', $company->id) }}" class="btn btn-effect-ripple btn-info"><i class="gi gi-group"></i> Admins.</a>
		                </div>
		            </div>
		            <div class="widget-content">
		                <div class="row text-center">
		                	<div class="col-xs-4">
		                        <h3 class="widget-heading"><span class="h4">Admins</span><br><a href="{{ route('companies.users.index', $company->id) }}" class="themed-color-system">{{ $company->admin_users_count }}</a></h3>
		                    </div>
		                    <div class="col-xs-4">
		                        <h3 class="widget-heading"><span class="h4">Usuarios</span><br><a href="javascript:void(0)" class="themed-color-system">{{ $company->registered_users_count }}</a></h3>
		                    </div>
		                    <div class="col-xs-4">
		                        <h3 class="widget-heading"><span class="h4">Protocolos</span><br><a href="javascript:void(0)" class="themed-color-system">{{ $company->protocols_count }}</a></h3>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
	    @endforeach
    </div>
    {!! $companies->render() !!}
@stop