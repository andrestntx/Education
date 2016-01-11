@extends('dashboard.pages.layout')
@section('title_page')
	<i class="fa fa-check-square-o"></i> Formato de Observaciones: {{$format->name}} 
	<a href="{{route('formats.observations.edit', $format)}}" class="btn btn-sm btn-warning" title="Editar formato de observaciones">
        <i class="fa fa-pencil"></i> 
    </a>
@stop

@section('breadcrumbs') {!! Breadcrumbs::render('formats.observations.format', $format) !!} @stop

@section('content_body_page')
	<div class="row" id="token" data-token="{{ csrf_token() }}">
		<div class="col-xs-offset-1 col-xs-10">			
				<div class="row">
					<div class="block">
						<div class="block-title">
							<div class="block-options pull-right">
								{!! Form::open(['route' => ['formats.observations.questions.create', $format->id], 'method' => 'GET', 'class' => 'form-inline']) !!}
									{!! Form::text('answers', null, ['class' => 'form-control', 'required', 'title' => 'Número de Respuestas', 'placeholder' => 'Respuestas']) !!}
									<button type="submit" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" data-original-title="Nueva Pregunta">
										<i class="fa fa-plus"> Agregar</i>
									</button>
								{!! Form::close() !!}
							</div>
							<h2>{{ $format->number_questions }} Preguntas </h2>
						</div>
						<div class="block-section">
							<ul id="sortable" class="list-unstyled" data-format-id="{{ $format->id }}">
		                    @foreach($format->questions as $question)
		                        <li title="Pregunta" id="{{ $question->id }}" style="cursor:move">
		                        	<div class="row">
		                            	<div class="col-xs-offset-1 col-xs-10 well">
		                            		<a href="{{ route('formats.observations.questions.edit', [$format->id, $question->id]) }}"  class="h4" data-toggle="tooltip" title="Editar Pregunta" >
				                                <i class="fa fa-pencil"></i>  {{ $question->text }}
				                            </a>
				                            <ul class="fa-ul">
				                            	@foreach($question->answers as $answer)
													<li><i class="fa fa-arrow-right fa-li"></i> {{ $answer->text }} </li>
												@endforeach
											</ul>
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
@endsection

@section('js_aditional')
	{!! Html::script('/assets/js/services/AppSortable.js') !!}
	<script> AppSortable.initObservations() </script>
@endsection
