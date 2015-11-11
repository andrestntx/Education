@extends('dashboard.pages.layout')
@section('title_page')
    Perfiles de Usuario
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
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td><strong>{{$role->name}}</strong></td>
                            <td>{{$role->description}}</td>
                            <td>{{ $role->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('roles.edit', $role->id)}}" data-toggle="tooltip" title="Editar Perfil" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
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