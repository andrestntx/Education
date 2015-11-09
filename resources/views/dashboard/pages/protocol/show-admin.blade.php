@extends('dashboard.pages.layout')
@section('title_page')Protocolo: {{$protocol->name}} @stop
@section('breadcrumbs') 
	<div style="float:right;">mam</div> 
@stop
@section('content_body_page')
	<div class="col-lg-9">
		<div class="block">
			<div class="block-title">
				<div class="block-options pull-right">
					<a href="{{route('protocolos.edit', $protocol->id)}}" class="btn btn-effect-ripple btn-warning" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
					<div class="btn-group">
						<a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary dropdown-toggle enable-tooltip" data-toggle="dropdown" title="" style="overflow: hidden; position: relative;" data-original-title="Opciones"><i class="fa fa-chevron-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>
								<a href="javascript:void(0)">
									<i class="gi gi-cloud-download pull-right"></i>
									Descargar
								</a>
							</li>
						</ul>
					</div>
				</div>
				<h2>{{$protocol->description}}</h2>
			</div>
			<div class="block-section">
				@if($protocol->isPdfCorrect())
					<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($protocol->pdf)}}&embedded=true" style="width:100%; height:550px;" frameborder="0"></iframe>
				@else
					<h4>El protocolo no se ha subido</h4>
				@endif
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="block">
				<div class="block-title">
					<div class="block-options pull-right">
						{{Form::open(array('route' => array('protocolos.preguntas.create', $protocol->id), 'method' => 'GET', 'class' => 'form-inline'))}}
							{{ Form::text('respuestas', null, array('class' => 'form-control', 'required' => 'required', 'style' => 'max-width:60px;', 'title' => 'Número de Respuestas', 'placeholder' => 'Respuestas')) }}
							<button type="submit" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" data-original-title="Nueva Pregunta">
								<i class="fa fa-plus"></i>
							</button>
						{{Form::close()}}
					</div>
					<h2>{{$number_questions}} Preguntas </h2>
				</div>
				<div class="block-section">
					<ul class="list-unstyled">
                    @foreach($protocol->survey->questions as $question)
                        <li title="Pregunta">
                        	<div class="row">
                            	<div class="col-xs-8">
                            		<h4 style="font-size:16px;">{{$question->text}}</h4>
                            	</div>
                            	<div class="col-xs-4">
		                            <a href="{{route('protocolos.preguntas.edit', array($protocol->id, $question->id))}}" data-toggle="tooltip" title="Editar Pregunta" class="btn btn-xs btn-effect-ripple btn-warning">
		                                <i class="fa fa-pencil"></i>
		                            </a>
		                            {{Form::open(array('route' => array('protocolos.preguntas.destroy', $protocol->id, $question->id), 'method' => 'DELETE', 'style' => 'display:inline-block;'))}}
		                            <button type="submit" title="Borrar Pregunta" class="btn btn-xs btn-effect-ripple btn-danger">
		                                <i class="fa fa-times"></i>
		                            </button>
		                            {{Form::close()}}
	                        	</div>
                        	</div>
                        </li>
                    @endforeach
                    </ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="block">
				<div class="block-title">
					<div class="block-options pull-right">
						<a href="{{route('protocolos.anexos.create', $protocol->id)}}" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Nuevo Anexo"><i class="fa fa-plus"></i></a>
					</div>
					<h2>{{ $number_annex }} Anexos</h2>
				</div>
				<div class="block-section">
					<ul class="list-unstyled">
	                    @foreach($annex as $a)
                            <li title="{{$a->description}}">
                            	<div class="row">
	                            	<div class="col-xs-8">
	                            		<h4><a href="{{url($a->url)}}" target="_blank">{{$a->name}} - {{$a->type}}</a></h4>
	                            	</div>
	                            	<div class="col-xs-4">
			                            <a href="{{route('protocolos.anexos.edit', array($protocol->id, $a->id))}}" data-toggle="tooltip" title="Editar Anexo" class="btn btn-xs btn-effect-ripple btn-warning">
			                                <i class="fa fa-pencil"></i>
			                            </a>
			                            {{Form::open(array('route' => array('protocolos.anexos.destroy', $protocol->id, $a->id), 'method' => 'DELETE', 'style' => 'display:inline-block;'))}}
				                            <button type="submit" title="Borrar Anexo" class="btn btn-xs btn-effect-ripple btn-danger">
				                                <i class="fa fa-times"></i>
				                            </button>
			                            {{Form::close()}}
		                        	</div>
	                        	</div>
                            </li>
	                    @endforeach
	                </ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="block">
				<div class="block-title">
					<div class="block-options pull-right">
						<a href="{{route('protocolos.enlaces.create', $protocol->id)}}" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Nuevo Anexo"><i class="fa fa-plus"></i></a>
					</div>
					<h2>{{ $number_links }} Enlaces</h2>
				</div>
				<div class="block-section">
					<ul class="list-unstyled">
	                    @foreach($links as $link)
                            <li title="{{$link->description}}">
                            	<div class="row">
	                            	<div class="col-xs-8">
	                            		<h4 style="font-size:16px;"><a href="{{URL::to($link->url)}}" target="_blank">{{$link->name}}</a></h4>
	                            	</div>
	                            	<div class="col-xs-4">
			                            <a href="{{route('protocolos.enlaces.edit', array($protocol->id, $link->id))}}" data-toggle="tooltip" title="Editar Anexo" class="btn btn-xs btn-effect-ripple btn-warning">
			                                <i class="fa fa-pencil"></i>
			                            </a>
			                            {{Form::open(array('route' => array('protocolos.enlaces.destroy', $protocol->id, $link->id), 'method' => 'DELETE', 'style' => 'display:inline-block;'))}}
				                            <button type="submit" title="Borrar Anexo" class="btn btn-xs btn-effect-ripple btn-danger">
				                                <i class="fa fa-times"></i>
				                            </button>
			                            {{Form::close()}}
		                        	</div>
	                        	</div>
                            </li>
	                    @endforeach
	                </ul>
				</div>
			</div>
		</div>
	</div>
@stop

