@extends('_layouts.default')

@section('content')
	<div class="page-container">
		<h2>Movies</h2>
		<ul>

			@foreach($user->movies as $movie)
				<li class="movie-lists">
					<h3>{{ $movie->rating }}</h3>
					<div class="movie-lists-img"><img src="{{$movie->urlPoster}}"></div>
					<div class="movie-lists-plot"><p>{{ $movie->simplePlot }}</p></div>

				</li>
			@endforeach

		</ul>
	</div>	

@stop