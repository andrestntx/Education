@extends('dashboard.layout')
@section('content_page')
	<!-- Blank Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>@yield('title_page', 'Laravel')</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    @yield('breadcrumbs')
                </div>
            </div>
        </div>
    </div>
    <!-- END Blank Header -->
    @yield('content_body_page')
@endsection