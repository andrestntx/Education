@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-sitemap @stop
@section('title_page') Áreas de la Institución @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('areas.create')}}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Nueva Área</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Area">Nombre</th>
                        <th title="Descripción del Area">Descripción</th>
                        <th title="Ultima actulaización del Area">Actualización</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $area)
                        <tr>
                            <td><strong>{{$area->name}}</strong></td>
                            <td>{{$area->description}}</td>
                            <td>{{ $area->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('areas.edit', $area->id)}}" data-toggle="tooltip" title="Editar Area" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $area->id }}" id="btn-delete-{{$area->id}}" onclick="deleteModel('btn-delete-{{$area->id}}')"  data-toggle="tooltip" title="Borrar Area" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('areas.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/areaTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop