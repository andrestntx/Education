@extends('dashboard.pages.layout')
@section('title_page')
    <i class="gi gi-old_man"></i> Perfiles de Usuario
    <a href="{{route('roles.create')}}" class="btn btn-primary" title="Nuevo Perfil"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('roles') !!} @stop

@section('content_body_page')
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th title="Nombre del Perfil">Nombre</th>
                        <th title="Descripción del Perfil">Descripción</th>
                        <th title="Ultima actulaización del Perfil">Actualización</th>
                        <th class="text-center" style="min-width: 100px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr id="{{ $role->id }}">
                            <td><strong>{{$role->name}}</strong></td>
                            <td>{{$role->description}}</td>
                            <td>{{ $role->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('roles.edit', $role->id)}}" data-toggle="tooltip" title="Editar Perfil" class="btn btn-sm btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" onclick="AppServices.postDeleteRole(this)" data-entity-id="{{ $role->id }}" data-token="{{ csrf_token() }}" data-toggle="tooltip" title="Borrar" class="btn btn-sm btn-effect-ripple btn-danger">
                                    <i class="gi gi-remove_2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $roles->render() !!}
        </div>
    </div>

@stop

@section('js_aditional')
    
@stop