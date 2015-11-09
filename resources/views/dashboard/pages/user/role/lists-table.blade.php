@extends('dashboard.pages.layout')
@section('title_page')
    Perfiles de Usuario
@stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('usuarios.perfiles.create')}}" class="btn btn-primary"><i class="gi gi-old_man"></i> Nuevo Perfil</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Perfil">Nombre</th>
                        <th title="Descripción del Perfil">Descripción</th>
                        <th title="Ultima actulaización del Perfil">Actualización</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td><strong>{{$role->name}}</strong></td>
                            <td>{{$role->description}}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('usuarios.perfiles.edit', $role->id)}}" data-toggle="tooltip" title="Editar Perfil" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $role->id }}" id="btn-delete-{{$role->id}}" onclick="deleteModel('btn-delete-{{$role->id}}')"  data-toggle="tooltip" title="Borrar Perfil" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('usuarios.perfiles.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/roleTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop