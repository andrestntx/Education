@extends('dashboard.pages.layout')
@section('title_page') 
    Todos los Protocolos 
    <a href="{{route('protocols.create')}}" class="btn btn-primary" title="Nuevo Protocolo"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols') !!} @stop

@section('content_body_page')

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
                            <td><a href="{{route('protocols.show', $protocol->id)}}" title="Ver Protocolo">{{$protocol->name}}</a></td>
                            <td>{{ $protocol->description }}</td>
                            <td class="text-center"><a href="#">{{ $protocol->number_annex }}</a></td>
                            <td class="text-center"><a href="#">{{ $protocol->number_questions }}</a></td>
                            <td>{{ $protocol->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('protocols.show', $protocol->id)}}" data-toggle="tooltip" title="Ver Protocolo" class="btn btn-effect-ripple btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route('protocols.edit', $protocol->id)}}" data-toggle="tooltip" title="Editar Protocolo" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
