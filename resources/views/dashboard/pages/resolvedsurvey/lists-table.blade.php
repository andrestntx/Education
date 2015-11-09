@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-check @stop
@section('title_page') Registros - {{$survey->name}} @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="block full"> 
        <div class="block-title">
            <div class="block-options pull-right">
                <a title="" data-toggle="tooltip" class="btn btn-effect-ripple btn-info" href="{{route('formularios.registros.create', $survey->id)}}" style="overflow: hidden; position: relative;" data-original-title="Nuevo Registro">
                    <i class="fa fa-plus"></i> Nuevo Registro
                </a>
            </div>
            <h2>{{$survey->description}}</h2>
        </div>
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" title="Código del Registro">Código</th>
                        <th class="text-center" title="Fecha del Registro">Fecha del Registro</th>
                        <th class="text-center" style="width:125px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resolvedSurveys as $resolvedSurvey)
                        <tr>
                            <td class="text-center"><strong>{{ $resolvedSurvey->id }}</strong></td>
                            <td class="text-center"><strong>{{ $resolvedSurvey->created_at }}</strong></td>
                            <td class="text-center">
                                <a href="{{route('formularios.registros.show', array($survey->id, $resolvedSurvey->id))}}" data-toggle="tooltip" title="Ver Registro" class="btn btn-sm btn-effect-ripple btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route('formularios.registros.export', array($survey->id, $resolvedSurvey->id))}}" data-toggle="tooltip" title="Exportar a PDF" class="btn btn-sm btn-effect-ripple btn-success">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                <a href="{{route('formularios.registros.send', array($survey->id, $resolvedSurvey->id))}}" data-toggle="tooltip" title="Enviar al Correo" class="btn btn-sm btn-effect-ripple btn-warning">
                                    <i class="fa fa-send-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
    {{Form::open(array('route' => array('formularios.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
    <!-- Load and execute javascript code used only in this page -->
        {{ HTML::script('assets/js/pages/onecolumnTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop

