@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-sitemap @stop
@section('title_page') 
    Áreas de la Institución 
    <a href="{{route('areas.create')}}" class="btn btn-primary" title="Nueva área"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('areas') !!} @stop

@section('content_body_page')

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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                    {!! $areas->render() !!}
        </div>
    </div>

    <!-- END Datatables Block -->

@stop
@section('js_aditional')

@stop