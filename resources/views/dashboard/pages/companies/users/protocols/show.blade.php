@extends('dashboard.pages.layout')
@section('title_page')Protocolo: {{$protocol->name}} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-lg-9">
			<div class="block">
				<div class="block-title">
					<div class="block-options pull-right">
						<div class="btn-group">
							<a href="javascript:void(0)" class="btn btn-effect-ripple btn-primary dropdown-toggle enable-tooltip" data-toggle="dropdown" title="" style="overflow: hidden; position: relative;" data-original-title="Opciones"><i class="fa fa-chevron-down"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<a href="javascript:void(0)">
										<i class="gi gi-cloud-download pull-right"></i>
										#
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
						</div>
						<h2>{{$protocol->number_annex}} Anexos </h2>
					</div>
					<div class="block-section">
						<ul class="fa-ul">
		                    @foreach($protocol->annex as $annex)
	                            <li title="{{$annex->description}}">
	                            	<i class="{{$annex->icon}} fa-li"></i>
	                            	@if($annex->isLink() && !$annex->islinkYoutube())
	                            		<h4><a href="{{URL::to($annex->url)}}" target="_blank">{{$annex->name}}</a></h4>	
	                            	@else
		                           		<h4><a href="#modal-annex-{{$annex->id}}" data-toggle="modal">{{$annex->name}}</a></h4>	
		                           	@endif		                            	
	                            </li>	
	                            @if($annex->isFile() || $annex->islinkYoutube())	
		                            <div id="modal-annex-{{$annex->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		                                <div class="modal-dialog modal-lg">
		                                    <div class="modal-content">
		                                        <div class="modal-header">
		                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                            <h3 class="modal-title"><strong>{{$annex->name}}</strong></h3>
		                                        </div>
		                                        <div class="modal-body">
		                                        	@if($annex->isImage())
		                                        		<img src="{{URL::to($annex->url)}}" class="text-center" style="max-height:400px; margin: 0 auto; display:block;">
		                                        	@elseif($annex->isVideo())
		                                        		<video style="max-height:400px; max-width:100%; margin: 0 auto; display:block;" controls>
														 	<source src="{{URL::to($annex->url)}}" type="video/mp4">
															El navegador no soporta HTML5
														</video>
		                                        	@elseif($annex->isPdf())
		                                        		<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($annex->url)}}&embedded=true" style="width:100%; height:450px;" frameborder="0"></iframe>
		                                        	@elseif($annex->islinkYoutube())
		                                        		<iframe width="100%" height="450" src="//www.youtube.com/embed/{{$annex->id_link_youtube}}" frameborder="0" allowfullscreen></iframe>
		                                        	@else
		                                        		<h3>El tipo de archivo no se puede visuarlizar. Miralo aquí <a href="{{URL::to($annex->url)}}" target="_blank">Anexo {{var_dump($annex->type)}}</a></h3>
		                                        	@endif
		                                        </div>
		                                        <div class="modal-footer">
		                                            <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Cerrar</button>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
	                            @endif
	                            <!-- END Regular Fade -->                            
		                    @endforeach
		                </ul>
					</div>
				</div>
			</div>
			<div class="row">
				@if($protocol->survey->aviable)
					<a href=" {{route('examenes.create', $protocol->id)}}" class="widget" title="Presentar Examen">
				@else
					<a href="#" class="widget" title="Examen no disponible">
				@endif
					<div class="widget-content widget-content-mini themed-background-muted text-center">
						<i class="fa fa-bar-chart-o"></i> @if($user->best_exam_score > 0) Mejorar Calificación @else Presentar Examen @endif
					</div>
					<div class="widget-content text-center">
						<div class="pie-chart easyPieChart" data-percent="{{$user->best_exam_score}}" data-line-width="3" data-bar-color="#cccccc" data-track-color="#f9f9f9" style="width: 80px; height: 80px; line-height: 80px;">
							<span><strong>{{$user->best_exam_score}}%</strong></span>
							<canvas width="80" height="80"></canvas>
						</div>
					</div>
					<div class="widget-content themed-background-muted">
						<div class="progress progress-striped progress-mini active remove-margin">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{$user->best_exam_score}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$user->best_exam_score}}%"></div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
@stop


