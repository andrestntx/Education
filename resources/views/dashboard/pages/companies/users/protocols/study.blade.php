@extends('dashboard.pages.layout')
@section('title_page')Estudiar Protocolo: {{$protocol->name}} @stop
@section('breadcrumbs') {!! Breadcrumbs::render('study.protocol', $protocol) !!} @stop
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
				<a href="@if($protocol->aviable) {{ route('exams.create', $protocol->id) }} @endif" class="widget" title="@if($protocol->aviable) Presentar Examen @else Examen no disponible @endif">
					@if($bestExam = $protocol->getUserBestExam($user))
                        @include('dashboard.extends.widget_percent', ['title' => 'Presentar examen', 'value' => $bestExam->score])
                    @else
                        @include('dashboard.extends.widget_percent', ['title' => 'Presentar examen', 'value' => 0])
                    @endif
				</a>
			</div>
		</div>
	</div>
@stop


