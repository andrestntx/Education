@extends('layout')
@section ('css_files') 
	@include('auth.css')
@endsection
@section('content_body')
	<!-- Full Background -->
    <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
    {{ HTML::image('images/placeholders/layout/error_full_bg.jpg', 'Página 404 Laravel', array('class' => 'full-bg full-bg-bottom animation-pulseSlow')) }}
    <!-- END Full Background -->

    <!-- Error Container -->
    <div id="error-container">
        <div class="row text-center">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="text-light animation-fadeInQuick"><strong>¿Qué buscas?</strong></h1>
                <h2 class="text-muted animation-fadeInQuickInv"><em>Lo sientimos, esta página no se encuentra disponible</em></h2>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <form action="page_ready_search_results.html" method="post" class="push">
                    <div class="input-group input-group-lg">
                        <input type="text" id="search-term" name="search-term" class="form-control" placeholder="Buscar Laravel..">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <a href="{{ URL::previous() }}" class="btn btn-effect-ripple btn-default"><i class="fa fa-arrow-left"></i> Volver atrás</a>
            </div>
        </div>
    </div>
    <!-- END Error Container -->
@endsection