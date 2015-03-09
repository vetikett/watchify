<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Watchify</title>
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
</head>
<body>
	@include('_partials.header')
	
	<div class="main container">		
		@yield('content')
	</div>

	@include('_partials.footer')	
</body>
</html>