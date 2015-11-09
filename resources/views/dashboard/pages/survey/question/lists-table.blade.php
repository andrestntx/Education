@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-question @stop
@section('title_page') Preguntas - {{$survey->name}} @stop
@section('breadcrumbs')

@stop
@section('content_body_page')
    <div class="row" id="title_page" style="margin-bottom: 10px;">
        <div class="col-sm-8">
            <a href="{{route('formularios.preguntas.create', $survey->id)}}" class="btn btn-primary btn-effect-ripple" data-toggle="tooltip" data-original-title="Pregunta Simple">
                <i class="fa fa-plus-square"></i> Nueva Pregunta Simple
            </a>
            <a href="{{route('formularios.preguntas.create', $survey->id)}}?tipo=texto" class="btn btn-success btn-effect-ripple" data-toggle="tooltip" data-original-title="Pregunta Simple">
                <i class="fa fa-plus-square"></i> Nuevo Campo de texto
            </a>
        </div>
        <div class="col-sm-4">
            {{Form::open(array('route' => array('formularios.preguntas.create', $survey->id), 'method' => 'GET', 'class' => 'form-inline'))}}
                {{Form::text('respuestas', null, array('class' => 'form-control', 'placeholder' => 'Número Respuestas', 'required' => 'required'))}}
                <button type="submit" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-original-title="Pregunta Multiple"><i class="fa fa-plus"></i> Nueva Pregunta</button>
            {{Form::close()}}
        </div>
    </div>
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Pregunta">Pregunta</th>
                        <th title="Tipo de Pregunta">Tipo</th>
                        <th title="Ultima actulaización del Area">Actualización</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($survey->questions as $question)
                        <tr>
                            <td><strong>@if($question->isText()) Campo de texto libre @else {{ $question->text }} @endif </strong></td>
                            <td>{{ $question->type->name }}</td>
                            <td>{{ $question->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('formularios.preguntas.edit', array($survey->id, $question->id))}}" data-toggle="tooltip" title="Editar Area" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-id="{{ $question->id }}" id="btn-delete-{{$question->id}}" onclick="deleteModel('btn-delete-{{$question->id}}')"  data-toggle="tooltip" title="Borrar Area" class="btn btn-effect-ripple btn-danger">
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
    {{Form::open(array('route' => array('formularios.preguntas.destroy', 'USER_ID') , 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete'))}}
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/areaTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop