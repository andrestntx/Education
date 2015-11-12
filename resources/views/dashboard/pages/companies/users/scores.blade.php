@extends('dashboard.pages.layout')
@section('title_page') @if(Auth::user()->isAdmin()) Calificaciones: {{$user->name}} @else Institución {{$user->company->name}} @endif @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-12">
			<div class="block">
				<div class="block-title">
					<h2>Mis Notas</h2>
				</div>
				<div class="block-section">
					<div class="table-responsive">
			            <table id="datatable" class="table table-striped table-bordered table-vcenter">
			                <thead>
			                    <tr>
			                        <th title="Nombre del Protocolo">Protocolo Evaluado</th>
			                        <th class="text-center" title="Número de Intentos">Intentos</th>
			                        <th class="text-center" title="Mejor Calificación">Mejor Calificación</th>
			                        <th title="Ultima actulaización del Protocolo">Último Intento</th>
			                        <th class="text-center" title="Última Calificación">Última Calificación</th>
			                    	<th class="text-center" style="width: 95px;"><i class="fa fa-flash"></i></th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($protocols as $protocol)
			                        <tr>
			                        	@if(Auth::user()->isAdmin())
			                            	<td><a href="{{route('protocols.show', $protocol->id)}}" title="Ver Protocolo">{{$protocol->name}}</a></td>
			                            @else
			                            	<td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
			                            @endif
			                            <td class="text-center"></a></td>

			                            <td class="text-center">

			                            </td>
			                            <td>  </td>
			                        	<td class="text-center">

			                        	</td>
			                        	<td class="text-center">
				                        	@if(Auth::user()->isAdmin())
				                        		<a href="{{route('protocols.show', $protocol->id)}}" data-toggle="tooltip" title="Ver Protocolo" class="btn btn-effect-ripple btn-info">
				                                    <i class="fa fa-eye"></i>
				                                </a>
				                        	@else
				                        		<a href="{{route('study', $protocol->id)}}" data-toggle="tooltip" title="Estudiar Protocolo" class="btn btn-effect-ripple btn-info">
				                                    <i class="fa fa-eye"></i>
				                                </a>
				                                <a href="{{route('exams.create', $protocol->id)}}" data-toggle="tooltip" title="Presentar examen" class="btn btn-effect-ripple btn-success" disabled  >
				                                    <i class="fa fa-graduation-cap"></i>
				                                </a>
			                                @endif
		                            	</td>
			                        </tr>
			                    @endforeach
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js_aditional')
	<!-- Load and execute javascript code used only in this page -->
		{!! Html::script('assets/js/pages/scoreTables.js'); !!}
        <script>$(function(){ UiTables.init(); });</script>
@stop