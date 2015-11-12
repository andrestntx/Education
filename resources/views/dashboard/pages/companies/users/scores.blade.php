@extends('dashboard.pages.layout')
@section('title_page') <i class="gi gi-building"></i> {{$user->company->name}} @stop
@section('breadcrumbs') {!! Breadcrumbs::render('study') !!} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-6">
			<div class="block">
				<div class="block-title">
					<h2>Protocolos pendientes</h2>
				</div>
				<div class="block-section">
					<div class="table-responsive">
			            <table id="datatable" class="table table-striped table-bordered table-vcenter">
			                <thead>
			                    <tr>
			                        <th title="Nombre del Protocolo">Protocolo</th>
                                    <th class="text-center" style="width: 95px;" title="Número de Intentos"><i class="fa fa-list-ol"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Mejor Calificación"><i class="fa fa-check"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Último Intento"><i class="fa fa-calendar"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Última Calificación"><i class="fa fa-pencil-square-o fa-fw"></i></th>
			                    	<th class="text-center" style="width: 95px;"><i class="fa fa-flash"></i></th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($protocolsPending as $protocol)
			                        <tr>
                                        <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
			                            <td class="text-center">{{ $protocol->getUserExamsCount($user) }}</td>
			                            <td class="text-center">@if($bestExam = $protocol->getUserBestExam($user)) {{ $bestExam->score }} @endif</td>
			                            <td class="text-center">@if($lastExam = $protocol->getUserLastExam($user)) {{ $lastExam->created_at_hummans }} @endif</td>
			                        	<td class="text-center">@if($lastExam){{ $lastExam->score }} @endif</td>
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
                <h2>Protocolos al día</h2>
            </div>
            <div class="block-section">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered table-vcenter">
                        <thead>
                        <tr>
                            <th title="Nombre del Protocolo">Protocolo</th>
                            <th class="text-center" style="width: 95px;" title="Número de Intentos"><i class="fa fa-list-ol"></i></th>
                            <th class="text-center" style="width: 95px;" title="Mejor Calificación"><i class="fa fa-check"></i></th>
                            <th class="text-center" style="width: 95px;" title="Último Intento"><i class="fa fa-calendar"></i></th>
                            <th class="text-center" style="width: 95px;" title="Última Calificación"><i class="fa fa-pencil-square-o fa-fw"></i></th>
                            <th class="text-center" style="width: 95px;"><i class="fa fa-flash"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($protocolsOk as $protocol)
                        <tr>
                            <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
                            <td class="text-center">{{ $protocol->getUserExamsCount($user) }}</td>
                            <td class="text-center">{{ $protocol->getUserBestExam($user)->score }}</td>
                            <td class="text-center">{{ $protocol->getUserLastExam($user)->created_at_hummans }} </td>
                        	<td class="text-center">{{ $protocol->getUserLastExam($user)->score }}</td>
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