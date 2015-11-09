@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-users @stop
@section('title_page') Usuarios @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('usuarios.create')}}" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo Usuario</a>
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
                        <th class="text-center" style="width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ HTML::image($user->image, 'a picture', array('class' => 'thumb', 'style' => 'width:50px;')) }}</td>
                            <td>{{$user->username}}</td>
                            <td><strong>{{$user->name}}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('usuarios.calificaciones', $user->id)}}" data-toggle="tooltip" title="Ver Calificaciones" class="btn btn-effect-ripple btn-info">
                                    <i class="fa fa-bar-chart-o"></i>
                                </a>
                                <a href="{{route('usuarios.edit', $user->id)}}" data-toggle="tooltip" title="Editar Administrador" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $user->id }}" id="btn-delete-{{$user->id}}" onclick="deleteModel('btn-delete-{{$user->id}}')"  data-toggle="tooltip" title="Borrar Administrador" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('usuarios.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/uiTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop