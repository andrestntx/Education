@extends ('layout')

@section ('title_page') .: {{ env('APP_NAME') }} | Login :. @endsection
@section ('css_files') 
	@include('auth.css')
@endsection
@section ('meta') 
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
@endsection

@section ('class_body') class="auth" @endsection
@section ('content_body')
    {{-- Login Container --}}
    <div id="login-container">
    	{{-- Header --}}
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown" style="margin-top: 20px;">
        	@yield('title_auth')
        </h1>
        {{-- END Header --}}

        {{-- Block --}}
        <div class="block animation-fadeInQuickInv">
            {{-- Title --}}
            <div class="block-title">
                <div class="block-options pull-right">
                	@yield('buttons_header')
                </div>
                @yield('title_header')
            </div>
            {{-- END Title --}}

            {{-- Form --}}
            @yield('form_auth')
            {{-- END Form --}}
        </div>
        {{-- END Block --}}

        {{-- Footer --}}
        @include('alerts')
        <footer style="color:white;" class="text-center animation-pullUp">
            <small>
                <span id="year-copy"></span> &copy; 
                <a href="{{ env('APP_DEVELOPER_WEBSITE') }}" style="color:white;" target="_blank">{{ env('APP_DEVELOPER') }}</a>
            </small>
        </footer>
        {{-- END Footer --}}
    </div>
    {{-- END Login Container --}}
@endsection

