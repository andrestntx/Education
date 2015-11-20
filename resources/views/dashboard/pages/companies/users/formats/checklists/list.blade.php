@extends('dashboard.pages.layout')
@section('title_page') 
    <i class="fa fa-check-square-o fa-fw"></i> {{ $format->name }}: Listas de chequeo
    <a href="{{route('myformats.checklists.create', $format)}}" class="btn btn-primary @if(! $format->isAviable()) disabled @endif" title="Apicar lista de chequeo">
        <i class="fa fa-plus"></i> 
    </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('myformats.checklists', $format) !!} @stop

@section('content_body_page')

    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Aplicada A:"><i class="fa fa-file-text"></i> Aplicada</th>
                        <th title="Observaciones lista de chequeo">Observaciones</th>
                        <th title="Ultima actulaización del Formato"><i class="gi gi-clock"></i> Actualización</th>
                        <th title="Descargar lista de chequeo"><i class="fa fa-cloud-download"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checklists as $checklist)
                        <tr>
                            <td>{{ $checklist->applied }}</td>
                            <td>{{ $checklist->observation }}</td>                            
                            <td>{{ $checklist->updated_at_hummans }}</td>
                            <td><a href="{{route('myformats.checklists.show', [$format, $checklist])}}" title="Ver Formato"><i class="fa fa-file-text"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop