@extends('dashboard.pages.layout')
@section('title_page')Protocolo: {{$format->name}} @stop

@section('breadcrumbs') {!! Breadcrumbs::render('formats.format', $format) !!} @stop

@section('content_body_page')
	<div class="row">
		<div class="col-xs-12">			
			
				<div class="row">
					<div class="block">
						<div class="block-title">
							<div class="block-options pull-right">
								{!! Form::open(['route' => ['formats.questions.create', $format->id], 'method' => 'GET', 'class' => 'form-inline']) !!}
									{!! Form::text('answers', null, array('class' => 'form-control', 'required', 'style' => 'max-width:120px;', 'title' => 'Número de Respuestas', 'placeholder' => 'Respuestas')) !!}
									<button type="submit" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" data-original-title="Nueva Pregunta">
										<i class="fa fa-plus"></i>
									</button>
								{!! Form::close() !!}
							</div>
							<h2>{{ $format->number_questions }} Preguntas </h2>
						</div>
						<div class="block-section">
							<ul class="list-unstyled">
		                    @foreach($format->questions as $question)
		                        <li title="Pregunta">
		                        	<div class="row">
		                            	<div class="col-xs-11">
		                            		<p style="font-size:16px;">{{$question->text}}</p>
		                            	</div>
		                            	<div class="col-xs-1">
				                            <a href="{{ route('formats.questions.edit', [$format->id, $question->id]) }}" data-toggle="tooltip" title="Editar Pregunta" class="btn btn-sm btn-effect-ripple btn-warning">
				                                <i class="fa fa-pencil"></i>
				                            </a>
			                        	</div>
		                        	</div>
		                        </li>
		                    @endforeach
		                    </ul>
						</div>
					</div>
				</div>				
			
		</div>
	</div>
@stop

