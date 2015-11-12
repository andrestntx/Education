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

						<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($protocol->pdf)}}&embedded=true" style="width:100%; height:550px;" frameborder="0"></iframe>

						<h4>El protocolo no se ha subido</h4>

				</div>
			</div>
		</div>

		<div class="col-lg-3">

            <div class="row">
                <div class="block">
                    <div class="block-title">
                        <h2>Enlaces</h2>
                    </div>
                    <div class="block-section">
                        <ul class="list-unstyled">
                            @foreach($protocol->links as $link)
                            <li title="{{$link->description}}">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 style="font-size:16px;"><i class="fa fa-external-link fa-fw"></i><a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a></h4>
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
                        <h2>Anexos</h2>
                    </div>
                    <div class="block-section">
                        <ul class="list-unstyled">
                            @foreach($protocol->getAnnexes() as $annex)
                            <li>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4>
                                            <i class="fa fa-file-photo-o"></i>
                                            <a href="/storage/{{$annex}}" target="_blank">{{ explode('/', $annex)[3] }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row">

					<a href=" {{route('exams.create', $protocol->id)}}" class="widget" title="Presentar Examen">

					<a href="#" class="widget" title="Examen no disponible">

					<div class="widget-content widget-content-mini themed-background-muted text-center">
						<i class="fa fa-bar-chart-o"></i> @if($protocol->bestExam($user)->score > 0) Mejorar Calificación @else Presentar Examen @endif
					</div>
					<div class="widget-content text-center">
						<div class="pie-chart easyPieChart" data-percent="{{ $protocol->bestExam($user)->score }}" data-line-width="3" data-bar-color="#cccccc" data-track-color="#f9f9f9" style="width: 80px; height: 80px; line-height: 80px;">
							<span><strong>{{ $protocol->bestExam($user)->score }}%</strong></span>
							<canvas width="80" height="80"></canvas>
						</div>
					</div>
					<div class="widget-content themed-background-muted">
						<div class="progress progress-striped progress-mini active remove-margin">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $protocol->bestExam($user)->score }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $protocol->bestExam($user)->score }}%"></div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
@stop


