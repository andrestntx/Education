@extends('dashboard.pages.layout')

@section('title_page') 
    <i class="fa fa-check-square-o fa-fw"></i> {{ $format->name }}: Observaciones
    <a href="{{ route('myformats.observations.doit.create', $format) }}" class="btn btn-primary @if(! $format->isAviable()) disabled @endif " title="Apicar lista de chequeo">
        <i class="fa fa-plus"></i> 
    </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('myformats.observations.doit', $format) !!} @stop

@section('content_body_page')

    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Aplicada A:"><i class="fa fa-file-text"></i> Aplicada</th>
                        <th title="Observaciones lista de chequeo">Observaciones</th>
                        <th title="Ultima actulaización del Formato"><i class="gi gi-clock"></i> Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($observations as $observation)
                        <tr>
                            <td>
                                <a href="{{ route('myformats.observations.doit.show', [$format, $observation]) }}" title="Ver Formato">
                                    <i class="fa fa-file-text"></i> 
                                    {{ $observation->applied }}
                                </a>
                            </td>
                            <td>{{ $observation->observation }}</td>                            
                            <td>{{ $observation->updated_at_hummans }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop