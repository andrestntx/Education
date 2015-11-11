@extends('dashboard.pages.layout')
@section('title_page')Protocolo: {{$protocol->name}} - Estadísticas @stop
@section('content_body_page')
	<div class="row">
		<div class="col-lg-12">
			<div class="block">
				<div class="block-title">
					<h2>Examenes de los Usuarios</h2>
				</div>
				<div class="block-section">
					<div class="box-body">
						<div class="table-responsive">
				            <table id="datatable" class="table table-striped table-bordered table-vcenter">
				                <thead>
				                    <tr>
				                        <th class="text-center" style="width: 50px;" title="Número de Cédula del Votante">Imagen</th>
				                        <th title="Usuario">Usuario</th>
				                        <th class="text-center" title="Número de Intentos">Intentos</th>
				                        <th class="text-center" title="Mejor Calificación">Mejor Calificación</th>
				                        <th title="Ultima actulaización del Protocolo">Último Intento</th>
				                        <th class="text-center" title="Última Calificación">Última Calificación</th>
				                        <th class="text-center" title="Última Calificación">Estado</th>
				                    </tr>
				                </thead>
				                <tbody>
				                    @foreach($users as $user)
				                        <tr>
				                            <td class="text-center">{{ HTML::image($user->image, 'a picture', array('class' => 'thumb', 'style' => 'width:50px;')) }}</td>
				                            <td>{{$user->username}} - <strong>{{$user->name}}</strong></td>
				                            <td class="text-center">{{ $user->examScores->count() }}</a></td>
				                            <td class="text-center">{{ $user->best_exam_score }}</td>
				                            <td> {{ $user->last_exam_update }} </td>
				                        	<td class="text-center"> {{ $user->last_exam_score }}</td>
				                        	<td class="text-center"> {{ $user->best_exam_status }}</td>
				                        </tr>
				                    @endforeach
				                </tbody>
				            </table>
        				</div>
	            	</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{{ HTML::script('assets/js/pages/uiTables.js'); }}
        <script>$(function(){ UiTables.init(); });</script>
@stop