@extends('dashboard.pages.layout')
@section('title_page')
    Categorías de Protocolos
@stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('protocolos.categorias.create')}}" class="btn btn-primary">Nueva Categoría</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Categoría">Nombre</th>
                        <th title="Descripción del Categoría">Descripción</th>
                        <th title="Ultima actulaización del Categoría">Actualización</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><strong>{{$category->name}}</strong></td>
                            <td>{{$category->description}}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('protocolos.categorias.edit', $category->id)}}" data-toggle="tooltip" title="Editar Categoría" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $category->id }}" id="btn-delete-{{$category->id}}" onclick="deleteModel('btn-delete-{{$category->id}}')"  data-toggle="tooltip" title="Borrar Categoría" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('protocolos.categorias.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/categoryTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop