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
                        <th title="Número de Protocolos"># Protocolos</th>
                        <th title="Ultima actulaización del Categoría"><i class="gi gi-clock"></i> Actualización</th>
                        <th class="text-center" style="min-width: 100px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr id="{{ $category->id }}">
                            <td><strong>{{$category->name}}</strong></td>
                            <td>{{$category->description}}</td>
                            <td class="text-center">{{$category->protocols->count()}}</td>
                            <td>{{ $category->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{ route('categories.edit', $category->id) }}" data-toggle="tooltip" title="Editar Categoría" class="btn btn-sm btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" onclick="AppServices.postDeleteCategory(this)" data-entity-id="{{ $category->id }}" data-token="{{ csrf_token() }}" data-toggle="tooltip" title="Borrar Perfil" class="btn btn-sm btn-effect-ripple btn-danger">
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
