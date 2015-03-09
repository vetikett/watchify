<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Moviebay</title>
	{{ HTML::style('css/normalize.css') }}
	{{ HTML::style('css/main.css') }}
</head>
<body>
	<header>
		<div class="container">
			<h1>Watchify</h1>
		</div>
	</header><!-- /header -->
	
	<div class="main container">		
		@yield('auth-content')
	</div>

	@include('_partials.footer')	
</body>
</html>