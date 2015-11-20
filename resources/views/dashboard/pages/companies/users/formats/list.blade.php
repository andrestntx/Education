@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-check-square-o fa-fw"></i> Formatos de Chequeo
    <a href="{{route('formats.create')}}" class="btn btn-primary" title="Nueva formato de chequeo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('formats') !!} @stop

@section('content_body_page')

    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Titulo"><i class="fa fa-file-text"></i> Nombre</th>
                        <th title="Descripción del Formato">Descripción</th>
                        <th class="text-center" title="Número de Preguntas"><i class="fa fa-sort-numeric-desc"></i></th>
                        <th title="Ultima actulaización del Formato"><i class="gi gi-clock"></i> Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formats as $format)
                        <tr>
                            <td><a href="{{route('formats.show', $format->id)}}" title="Ver Formato"><i class="fa fa-file-text"></i> {{$format->name}}</a></td>
                            <td>{{ $format->description }}</td>
                            <td class="text-center"> {{ $format->number_questions }} </td>
                            <td>{{ $format->updated_at_hummans }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
