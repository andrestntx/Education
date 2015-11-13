@extends('dashboard.pages.layout')
@section('class_icon_page') fa fa-sitemap @stop
@section('title_page')
Usuarios de la Institución
<a href="{{route('users.create')}}" class="btn btn-primary" title="Nuevo usuario"><i class="fa fa-plus"></i> </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('users') !!} @stop

@section('content_body_page')

    <div class="block full">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;" title="Número de Cédula del Votante">Imagen</th>
                        <th title="Usuario del Votante">Usuario</th>
                        <th title="Nombre del Votante">Nombre</th>
                        <th>Email</th>
                        <th title="Ultima actulaización del Usuario">Actualización</th>
                        <th class="text-center" style="width: 115px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{!! Html::image($user->image, 'Imagen Usuario', array('class' => 'thumb', 'style' => 'width:50px;')) !!}</td>
                            <td>{{$user->username}}</td>
                            <td><strong>{{$user->name}}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->updated_at_hummans }}</td>
                            <td class="text-center">
                                <a href="" data-toggle="tooltip" title="Ver Calificaciones" class="btn btn-effect-ripple btn-info">
                                    <i class="fa fa-bar-chart-o"></i>
                                </a>
                                <a href="{{route('users.edit', $user->id)}}" data-toggle="tooltip" title="Editar Administrador" class="btn btn-effect-ripple btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $users->render() !!}
        </div>
    </div>

@stop
@section('js_aditional')

@stop