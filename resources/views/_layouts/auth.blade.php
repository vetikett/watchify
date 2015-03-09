<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Watchify</title>
	{{ HTML::style('css/normalize.css') }}
	{{ HTML::style('css/main.css') }}
	{{ HTML::style('css/login.css') }}
</head>
<body>
	<header>
		<div class="container">
			<p class="title">Watchify</p>
		</div>
	</header><!-- /header -->
	
	<div class="main container">		
		@yield('auth-content')
	</div>

	@include('_partials.footer')	
</body>
</html>