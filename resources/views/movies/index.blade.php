@extends('_layouts.default')

@section('content')
	<div class="page-container">
		<h2>Movies</h2>

        <div class="row">
            @foreach($user->movies as $movie)
                <a class="col-xs-12 col-sm-5" href="{{ action('MoviesController@show', [$movie->id]) }}">
                        <h3 class="col-xs-12">{{ $movie->rating }}</h3>
                        <div class="col-xs-2 movie-lists-img"><img src="{{$movie->urlPoster}}"></div>
                        <div class="col-xs-10 movie-lists-plot"><p>{{ $movie->simplePlot }}</p></div>
                </a>
            @endforeach
        </div>



		</ul>
	</div>	

@stop