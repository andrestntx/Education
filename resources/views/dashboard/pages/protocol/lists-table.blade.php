@extends('dashboard.pages.layout')
@section('title_page') Todos los Protocolos @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
    	<div class="col-md-12">
            <a href="{{route('protocolos.create')}}" class="btn btn-primary"><i class="fa fa-file-text"></i> Nuevo Protocolo</a>
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Protocolo">Nombre</th>
                        <th title="Descripción del Protocolo">Descripción</th>
                        <th class="text-center" title="Número de Anexos"># Anexos</th>
                        <th class="text-center" title="Número de Preguntas"># Preguntas</th>
                        <th title="Ultima actulaización del Protocolo">Actualización</th>
                        <th class="text-center" style="width: 155px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($protocols as $protocol)
                        <tr>
                            <td><a href="{{route('protocolos.show', $protocol->id)}}" title="Ver Protocolo">{{$protocol->name}}</a></td>
                            <td>{{ $protocol->description }}</td>
                            <td class="text-center"><a href="{{route('protocolos.anexos.index', $protocol->id)}}">{{ $protocol->number_annex }}</a></td>
                            <td class="text-center"><a href="{{route('protocolos.preguntas.index', $protocol->id)}}">{{ $protocol->number_questions }}</a></td>
                            <td>{{ $protocol->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('protocolos.estadisticas', $protocol->id)}}" data-toggle="tooltip" title="Ver Estadisticas" class="btn btn-effect-ripple btn-info">
                                    <i class="fa fa-bar-chart-o"></i>
                                </a>
                                <a href="{{route('protocolos.show', $protocol->id)}}" data-toggle="tooltip" title="Ver Protocolo" class="btn btn-effect-ripple btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route('protocolos.edit', $protocol->id)}}" data-toggle="tooltip" title="Editar Protocolo" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $protocol->id }}" id="btn-delete-{{$protocol->id}}" onclick="deleteModel('btn-delete-{{$protocol->id}}')"  data-toggle="tooltip" title="Borrar Protocolo" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('protocolos.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/protocolTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop