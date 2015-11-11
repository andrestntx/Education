@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @stop
@section('title_page') <i class="fa fa-building-o"></i> {{ $company->name }}: Administradores @stop

@section('breadcrumbs') {!! Breadcrumbs::render('companies.company.users', $company) !!} @stop

@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{ route('companies.users.create', $company->id) }}" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo Administrador</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;" title="Número de Cédula del Votante">Imagen</th>
                        <th title="Usuario del Votante">Usuario</th>
                        <th title="Nombre del Votante">Nombre</th>
                        <th>Email</th>
                        <th title="Ultima actulaización del Usuario">Actualización</th>
                        <th class="text-center" style="width: 120px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{!! Html::image($user->image, 'a picture', array('class' => 'thumb', 'style' => 'width:50px;')) !!}</td>
                            <td>{{ $user->username }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('companies.users.edit', array($company->id, $user->id))}}" data-toggle="tooltip" title="Editar Administrador" class="btn btn-effect-ripple btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $user->id }}" id="btn-delete-{{$user->id}}" onclick="deleteModel('btn-delete-{{$user->id}}')"  data-toggle="tooltip" title="Borrar Administrador" class="btn btn-effect-ripple btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
@stop
@section('js_aditional')
	
@stop