@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-file-text"></i> Protocolos 
    <a href="{{route('protocols.create')}}" class="btn btn-primary" title="Nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('content_body_page')

    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Protocolo"><i class="fa fa-file-text"></i> Nombre</th>
                        <th title="Descripción del Protocolo">Descripción</th>
                        <th class="text-center" title="Número de Anexos"><i class="fa fa-file-zip-o"></i></th>
                        <th class="text-center" title="Número de Links"><i class="fa fa-share-alt"></i></th>
                        <th class="text-center" title="Número de Preguntas"><i class="fa fa-sort-numeric-desc"></i></th>
                        <th title="Ultima actulaización del Protocolo"><i class="gi gi-clock"></i> Actualización</th>
                        <th class="text-center" style="min-width: 65px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($protocols as $protocol)
                        <tr id="{{ $protocol->id }}">
                            <td><a href="{{route('protocols.show', $protocol->id)}}" title="Ver Protocolo"><i class="fa fa-file-text"></i> {{$protocol->name}}</a></td>
                            <td>{{ $protocol->description }}</td>
                            <td class="text-center"> {{ $protocol->number_annexes }} </td>
                            <td class="text-center"> {{ $protocol->number_links }} </td>
                            <td class="text-center"> {{ $protocol->number_questions }} </td>
                            <td>{{ $protocol->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="#" onclick="AppServices.postDeleteProtocol(this)" data-entity-id="{{ $protocol->id }}" data-token="{{ csrf_token() }}" data-toggle="tooltip" title="Borrar Perfil" class="btn btn-sm btn-effect-ripple btn-danger">
                                    <i class="gi gi-remove_2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
