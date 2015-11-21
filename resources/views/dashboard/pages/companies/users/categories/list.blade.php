@extends('dashboard.pages.layout')
@section('title_page')
    <i class="fa fa-folder-open"></i> Categorías de Protocolos
    <a href="{{route('categories.create')}}" class="btn btn-primary" title="Nueva categoría"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('categories') !!} @stop

@section('content_body_page')
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Categoría">Nombre</th>
                        <th title="Descripción del Categoría">Descripción</th>
                        <th title="Ultima actulaización del Categoría"><i class="gi gi-clock"></i> Actualización</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td><strong>{{$category->name}}</strong></td>
                            <td>{{$category->description}}</td>
                            <td>{{ $category->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('categories.edit', $category->id)}}" data-toggle="tooltip" title="Editar Categoría" class="btn btn-effect-ripple btn-warning">
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
