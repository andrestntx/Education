@extends('dashboard.pages.layout')
@section('title_page') <i class="fa fa-file-text"></i> Protocolo: {{$protocol->name}} @stop
@section('breadcrumbs') {!! Breadcrumbs::render('study.protocol', $protocol) !!} @stop
@section('content_body_page')
	<div class="row">
		<div class="col-lg-9">
			<div class="block">
				<div class="block-title">
					<h2>{{$protocol->description}}</h2>
				</div>
				<div class="block-section">
					<iframe src="https://drive.google.com/viewerng/viewer?url={{URL::to($protocol->doc)}}&embedded=true" style="width:100%; height:550px;" frameborder="0"></iframe>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
            @if($bestExam = $protocol->getUserBestExam($user))
                <div class="block">
                    <h4>Mejor calificación</h4>
                    <a href="{{ route('exams.create', $protocol->id) }}" class="widget" title="@if($protocol->aviable) Presentar Examen @else Examen no disponible @endif">
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $bestExam->score }}%">{{ $bestExam->score }}%</div>
                        </div>
                    </a>
                </div>
            @endif

            <a href="{{ route('exams.create', $protocol->id) }}" class="widget" title="@if($protocol->aviable) Presentar Examen @else Examen no disponible @endif">
                @if($lastExam = $protocol->getUserLastExam($user))
                    @include('dashboard.extends.widget_percent', ['title' => 'Última calificación', 'value' => $lastExam->score])
                @else
                    @include('dashboard.extends.widget_percent', ['title' => 'Presentar examen', 'value' => 0])
                @endif
            </a>

            <div class="block">
                <div class="block-title">
                    <h2>Videos</h2>
                </div>
                <div class="block-section">
                    <ul class="list-unstyled">
                        @foreach($protocol->getVideos() as $video)
                        <li title="{{ $video->description }}">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 style="font-size:16px;">
                                        <a href="#modal-fade" data-video="{{ $video }}" data-toggle="modal" class="widget" title="{{ $video->description }}">
                                            <i class="fa fa-play fa-fw"></i>
                                            {{ $video->name }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="block">
                <div class="block-title">
                    <h2>Enlaces</h2>
                </div>
                <div class="block-section">
                    <ul class="list-unstyled">
                        @foreach($protocol->getLinks() as $link)
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
            <div class="block">
                <div class="block-title">
                    <h2>Anexos</h2>
                </div>
                <div class="block-section">
                    <ul class="list-unstyled">
                        @foreach($protocol->getAnnexes() as $key => $annex)
                        <li>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4>
                                        <i class="fa fa-file-photo-o"></i>
                                        <a href="/storage/{{$annex}}" target="_blank" title="{{ explode('/', $annex)[3] }}">Descargar anexo {{ $key + 1 }}</a>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @include('dashboard.pages.companies.users.protocols.videos.modal')

		</div>
	</div>
@endsection

@section('js_aditional')
    
    {!! Html::script('assets/js/services/AppEmbedVimeo.js') !!}
    <script type="text/javascript"> AppEmbedVimeo.init(); </script>
    
@endsection


