@extends('dashboard.pages.layout')

@section('title_page') 
    @if(Auth::user()->isAdmin())
        <i class="fa fa-users"></i> Calificaciones de {{ $user->name }}
    @else
        <i class="gi gi-building"></i> {{ $user->company->name }} 
    @endif
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('scores') !!} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-sm-6">
			<div class="block">
				<div class="block-title">
					<h2><i class="gi gi-thumbs_down text-danger"></i> Protocolos pendientes</h2>
				</div>
				<div class="block-section">
					<div class="table-responsive">
			            <table id="datatable" class="table table-striped table-bordered table-vcenter table-hover">
			                <thead>
			                    <tr>
			                        <th title="Nombre del Protocolo">Protocolo</th>
                                    <th class="text-center" style="width: 95px;" title="Número de Intentos"><i class="fa fa-list-ol"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Mejor Calificación"><i class="fa fa-check"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Último Intento"><i class="fa fa-calendar"></i></th>
                                    <th class="text-center" style="width: 95px;" title="Última Calificación"><i class="fa fa-pencil-square-o fa-fw"></i></th>
			                    </tr>
			                </thead>
			                <tbody>
			                    @foreach($user->getExamProtocolsPending() as $protocol)
			                        <tr>
                                        <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
			                            <td class="text-center">{{ $protocol->getUserExamsCount($user) }}</td>
			                            <td class="text-center">
                                            @if($bestExam = $protocol->getUserBestExam($user)) 
                                                {{ $bestExam->score }}
                                                <div class="progress progress-mini active remove-margin">
                                                    <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" 
                                                        aria-valuenow="{{ $bestExam->score }}" aria-valuemin="0" 
                                                        aria-valuemax="100" style="width: {{ $bestExam->score }}%">
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
			                            <td class="text-center">@if($lastExam = $protocol->getUserLastExam($user)) {{ $lastExam->created_at_hummans }} @endif</td>
                                        <td class="text-center">
                                            @if($lastExam)
                                                {{ $lastExam->score }}
                                                <div class="progress progress-mini active remove-margin">
                                                    <div class="progress-bar progress-bar-striped progress-bar-danger" role="progressbar" 
                                                        aria-valuenow="{{ $lastExam->score }}" aria-valuemin="0" 
                                                        aria-valuemax="100" style="width: {{ $lastExam->score }}%">
                                                    </div>
                                                </div>
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
        <div class="col-sm-6">
            <div class="block">
                <div class="block-title">
                    <h2><i class="gi gi-thumbs_up text-info"></i> Protocolos al día</h2>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->getExamProtocolsOk() as $protocol)
                            <tr>
                                <td><a href="{{route('study', $protocol->id)}}" title="Estudiar Protocolo">{{$protocol->name}}</a></td>
                                <td class="text-center">{{ $protocol->getUserExamsCount($user) }}</td>
                                <td class="text-center">{{ $protocol->getUserBestExam($user)->score }}</td>
                                <td class="text-center">{{ $protocol->getUserLastExam($user)->created_at_hummans }} </td>

                            	<td class="text-center">
                                    {{ $protocol->getUserLastExam($user)->score }}
                                    <div class="progress progress-mini active remove-margin">
                                        <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" 
                                            aria-valuenow="{{ $protocol->getUserLastExam($user)->score }}" aria-valuemin="0" 
                                            aria-valuemax="100" style="width: {{ $protocol->getUserLastExam($user)->score }}%">
                                        </div>
                                    </div>
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