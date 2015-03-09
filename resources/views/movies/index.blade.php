@extends('_layouts.default')

@section('content')
	<div class="page-container">
		<h2>Movies</h2>
		<ul>

			@foreach($user->movies as $movie)
				<li class="movie-lists">
					<h2>{{ $movie->title }}</h2>
					<h3>{{ $movie->imdbRating }}</h3>
					<div class="movie-lists-img"><img src="{{$movie->poster}}"></div>
					<div class="movie-lists-plot"><p>{{ $movie->plot }}</p></div>

				</li>
			@endforeach

		</ul>
	</div>	

@stop