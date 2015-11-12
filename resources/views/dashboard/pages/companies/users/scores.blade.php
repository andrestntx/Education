@extends('dashboard.pages.layout')
@section('title_page') Institución {{$user->company->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-6">
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
                                    <th class="text-center" style="width: 95px;" title="Número de Intentos"><i class="fa fa-list-ol"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Mejor Calificación"><i class="fa fa-check"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Último Intento"><i class="fa fa-calendar"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Última Calificación"><i class="fa fa-pencil-square-o fa-fw"></i></th>
			                    	<th class="text-center" style="width: 95px;"><i class="fa fa-flash"></i></th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($protocols as $protocol)
			                        <tr>
                                        <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
			                            <td class="text-center"></td>
			                            <td class="text-center"></td>
			                            <td>  </td>
			                        	<td class="text-center"></td>
			                        	<td class="text-center">
                                            <a href="{{route('study', $protocol->id)}}" data-toggle="tooltip" title="Estudiar Protocolo" class="btn btn btn-sm btn-effect-ripple btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route('exams.create', $protocol->id)}}" data-toggle="tooltip" title="Presentar examen" class="btn btn btn-sm btn-effect-ripple btn-success" disabled  >
                                                <i class="fa fa-graduation-cap"></i>
                                            </a>
		                            	</td>
			                        </tr>
			                    @endforeach
			                </tbody>
			            </table>
			        </div>
				</div>
			</div>
		</div>


    <div class="col-sm-6">
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
                            <th class="text-center" style="width: 95px;" title="Número de Intentos"><i class="fa fa-list-ol"></i></th>
                            <th class="text-center" style="width: 95px;" title="Mejor Calificación"><i class="fa fa-check"></i></th>
                            <th class="text-center" style="width: 95px;" title="Último Intento"><i class="fa fa-calendar"></i></th>
                            <th class="text-center" style="width: 95px;" title="Última Calificación"><i class="fa fa-pencil-square-o fa-fw"></i></th>
                            <th class="text-center" style="width: 95px;"><i class="fa fa-flash"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($protocols as $protocol)
                        <tr>
                            <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td>  </td>
                            <td class="text-center"></td>
                            <td class="text-center">
                                <a href="{{route('study', $protocol->id)}}" data-toggle="tooltip" title="Estudiar Protocolo" class="btn btn btn-sm btn-effect-ripple btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route('exams.create', $protocol->id)}}" data-toggle="tooltip" title="Presentar examen" class="btn btn btn-sm btn-effect-ripple btn-success" disabled  >
                                    <i class="fa fa-graduation-cap"></i>
                                </a>
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