@extends('dashboard.pages.layout')

@section('title_page') 
    <i class="gi gi-building"></i> {{ $company->name }}: Administradores
    <a href="{{ route('companies.users.create', $company->id) }}" class="btn btn-primary" title="Nuevo Administrador"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('companies.company.users', $company) !!} @stop

@section('content_body_page')
    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;" title="Imagen">Imagen</th>
                        <th title="Usuario">Usuario</th>
                        <th title="Nombre">Nombre</th>
                        <th>Email</th>
                        <th title="Ultima actulaización del Usuario">Actualización</th>
                        <th class="text-center" style="width: 120px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr id="{{ $user->id }}">
                            <td class="text-center">{!! Html::image($user->image, 'a picture', array('class' => 'thumb', 'style' => 'width:50px;')) !!}</td>
                            <td>{{ $user->username }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="{{route('companies.users.edit', array($company->id, $user->id))}}" data-toggle="tooltip" title="Editar Administrador" class="btn btn-effect-ripple btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" onclick="AppServices.postDeleteUser(this)" data-entity-id="{{ $user->id }}" data-token="{{ csrf_token() }}" data-toggle="tooltip" title="Borrar Admin" class="btn btn-sm btn-effect-ripple btn-danger">
                                    <i class="gi gi-remove_2"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
@stop
@section('js_aditional')
	
@stop