<!DOCTYPE html>
<html lang="es" @yield('class_html')>
	<head>
		<meta charset="utf-8"/>
		<title> @yield('title_web_page', 'Bienvenido a la Aplicación') </title>
		@yield('css_files')
		@yield('meta')
	</head>
	<body @yield('class_body')>
		@yield('content_body')
		@yield('js_files')
	</body>
</html>
