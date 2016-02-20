@extends('dashboard.pages.layout')
@section('title_page')<i class="fa fa-file-text"></i> Protocolo: {{$protocol->name}} @stop

@section('breadcrumbs') {!! Breadcrumbs::render('protocols.protocol', $protocol) !!} @stop
@section('css_aditional')
	<style type="text/css">
		#embed iframe{
			width: 100%;
		}
	</style>
@endsection
@section('content_body_page')
	<div class="row">
		<div class="col-xs-12">
			<div class="col-lg-8">
				<div class="block">
					<div class="block-title">
						<div class="block-options pull-right">
							<a href="{{route('protocols.edit', $protocol->id)}}" class="btn btn-effect-ripple btn-warning" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
							<div class="btn-group">
								<a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary dropdown-toggle enable-tooltip" data-toggle="dropdown" title="" style="overflow: hidden; position: relative;" data-original-title="Opciones"><i class="fa fa-chevron-down"></i></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<a href="{{ URL::to($protocol->doc) }}" target="_blank">
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
						@if($protocol->isDocCorrect())
							<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($protocol->doc)}}&embedded=true" style="width:100%; height:550px;" frameborder="0"></iframe>
						@else
							<h4>El protocolo no se ha subido</h4>
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				
				<div class="row">
	                <div id="questions" class="panel-group">
	                    <div class="panel panel-info">
	                    	<div class="block-options pull-right">
								{!! Form::open(['route' => ['protocols.questions.create', $protocol->id], 'method' => 'GET', 'class' => 'form-inline']) !!}
									{!! Form::text('answers', null, array('class' => 'form-control', 'required', 'style' => 'max-width:120px;', 'title' => 'Número de Respuestas', 'placeholder' => 'Respuestas')) !!}
									<button type="submit" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" data-original-title="Nueva Pregunta">
										<i class="fa fa-plus"></i>
									</button>
								{!! Form::close() !!}
							</div>
	                        <div class="panel-heading" style="padding:10px;">
	                            <div class="panel-title">
	                                <i class="fa fa-angle-right"></i> <a class="accordion-toggle h4" data-toggle="collapse" data-parent="#questions" href="#questions_1"><strong>Preguntas</strong></a>
	                            </div>
	                        </div>
	                        <div id="questions_1" class="panel-collapse collapse">
	                            <div class="panel-body">
	                                <ul class="list-unstyled">
					                    @foreach($protocol->questions as $question)
					                        <li title="Pregunta">
					                        	<div class="row">
					                            	<div class="col-xs-12">
					                            		<a href="{{ route('protocols.questions.edit', [$protocol->id, $question->id]) }}" data-toggle="tooltip" title="Editar Pregunta" style="font-size:16px;">
					                            			@if($question->aviable)
							                                	<i class="fa fa-pencil"></i> {{$question->text}}
							                                @else
							                                	<span class="text-danger"> <i class="fa fa-pencil"></i> {{$question->text}}</span>
							                                @endif
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

	            <div class="row">
	                <div id="links" class="panel-group">
	                    <div class="panel panel-warning">
	                    	<div class="block-options pull-right">
								<a href="{{ route('protocols.links.create', $protocol->id) }}" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" title="Nuevo Enlace"><i class="fa fa-plus"></i></a>
							</div>
	                        <div class="panel-heading" style="padding:10px;">
	                            <div class="panel-title">
	                                <i class="fa fa-angle-right"></i> <a class="accordion-toggle h4" data-toggle="collapse" data-parent="#links" href="#links_1"><strong>Enlaces</strong></a>
	                            </div>
	                        </div>
	                        <div id="links_1" class="panel-collapse collapse">
	                            <div class="panel-body">
	                                <ul class="list-unstyled">
					                    @foreach($protocol->getLinks() as $link)
				                            <li title="{{$link->description}}">
				                            	<div class="row">
					                            	<div class="col-xs-10">
					                            		<a href="{{ route('protocols.links.edit', [$protocol->id, $link->id]) }}" data-toggle="tooltip" title="Editar Enlace" style="font-size:16px;">
							                                <i class="gi gi-link"></i> {{ $link->name }}
							                            </a>
					                            	</div>
					                            	<div class="col-xs-2">
							                            {!! Form::open(['route' => ['protocols.links.destroy', $protocol->id, $link->id], 'method' => 'DELETE', 'style' => 'display:inline-block;']) !!}
								                            <button type="submit" title="Borrar Enlace" class="btn btn-xs btn-effect-ripple btn-danger">
								                                <i class="fa fa-times"></i>
								                            </button>
							                            {!! Form::close() !!}
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

                <div class="row">
	                <div id="videos" class="panel-group">
	                    <div class="panel panel-danger">
	                    	<div class="block-options pull-right">
	                    		<a href="{{ route('protocols.videos.create', $protocol->id) }}" class="btn btn-effect-ripple btn-info" data-toggle="tooltip" title="Nuevo Video"><i class="fa fa-plus"></i></a>
							</div>
	                        <div class="panel-heading" style="padding:10px;">
	                            <div class="panel-title">
	                                <i class="fa fa-angle-right"></i> <a class="accordion-toggle h4" data-toggle="collapse" data-parent="#videos" href="#videos_1"><strong>Videos</strong></a>
	                            </div>
	                        </div>
	                        <div id="videos_1" class="panel-collapse collapse">
	                            <div class="panel-body">
	                                <ul class="list-unstyled">
					                    @foreach($protocol->getVideos() as $video)
					                    	<li>
				                            	<div class="row">
					                            	<div class="col-xs-9">
					                            		<a href="#modal-fade" data-video="{{ $video }}" data-toggle="modal" class="widget" title="{{ $video->description }}">
							                                <i class="hi hi-cloud_upload"></i> {{ $video->name }}
							                            </a>
					                            	</div>
					                            	<div class="col-xs-3">
					                            		<a href="{{ route('protocols.videos.edit', [$protocol, $video]) }}" class="btn btn-xs btn-effect-ripple btn-warning">
					                            			<i class="fa fa-pencil"></i>
					                            		</a>
							                            {!! Form::open(['route' => ['protocols.videos.destroy', $protocol, $video], 'method' => 'DELETE', 'style' => 'display:inline-block;']) !!}
								                            <button type="submit" title="Borrar Video" class="btn btn-xs btn-effect-ripple btn-danger">
								                                <i class="fa fa-times"></i>
								                            </button>
							                            {!! Form::close() !!}
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

                @if($protocol->getAnnexes())
	                <div class="row">
		                <div id="annexes" class="panel-group">
		                    <div class="panel panel-success">
		                    	<div class="block-options pull-right">

								</div>
		                        <div class="panel-heading" style="padding:10px;">
		                            <div class="panel-title">
		                                <i class="fa fa-angle-right"></i> <a class="accordion-toggle h4" data-toggle="collapse" data-parent="#annexes" href="#annexes_1"><strong>Anexos</strong></a>
		                            </div>
		                        </div>
		                        <div id="annexes_1" class="panel-collapse collapse">
		                            <div class="panel-body">
		                                <ul class="list-unstyled">
						                    @foreach($protocol->getAnnexes() as $annex)
						                    	<li>
					                            	<div class="row">
						                            	<div class="col-xs-10">
						                            		<a href="/storage/{{$annex}}" data-toggle="tooltip" title="Descargar Anexo" style="font-size:16px;" target="_blank">
								                                <i class="hi hi-cloud_upload"></i> {{ explode('/', $annex)[3] }}
								                            </a>
						                            	</div>
						                            	<div class="col-xs-2">
								                            {!! Form::open(['route' => ['protocols.annexes.destroy', $protocol->id, explode('/', $annex)[3]], 'method' => 'DELETE', 'style' => 'display:inline-block;']) !!}
									                            <button type="submit" title="Borrar Enlace" class="btn btn-xs btn-effect-ripple btn-danger">
									                                <i class="fa fa-times"></i>
									                            </button>
								                            {!! Form::close() !!}
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
	            @endif

				<div class="row">
					<div class="block">
						<div class="block-title">
							<h2>Agregar Anexos</h2>
						</div>
						<div class="block-section">
							<div class="row">
				                <div class="col-xs-12">
								<!-- Dropzone Content -->
				                <!-- Dropzone.js, You can check out https://github.com/enyo/dropzone/wiki for usage examples -->
				                	{!! Form::open(['route' => ['protocols.annexes.store', $protocol->id], 'method' => 'POST', 'class' => 'dropzone']) !!}
				                <!-- END Dropzone Content -->
								</div>
							</div>
						</div>
					</div>
				</div>



			</div>
		</div>
	</div>

	@include('dashboard.pages.companies.users.protocols.videos.modal')
	
@endsection

@section('js_aditional')
	
	{!! Html::script('assets/js/services/AppEmbedVimeo.js') !!}
	<script type="text/javascript"> AppEmbedVimeo.init(); </script>
	
	<script>
		$(".dropzone").dropzone({ 
			dictDefaultMessage: 'Suelte aquí los anexos que desea agregar',
			maxFilesize: 2, // MB,
			dictFileTooBig: 'El anexo es demasiado grande. No puede superar las 2MB'
		});
	</script>


@endsection

