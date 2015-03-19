@extends('_layouts.default')

@section('content')
    <div class="row">
        <h2 class="col-xs-12 col-sm-5 text-center">{{ $movie->title }}</h2>
    </div>
    <div class="row single-movie">

        <div class="col-xs-12 col-sm-5 text-center">
            <h1 class="text-primary text-center">{{ $movie->rating }}</h1>
            <img src="{{$movie->urlPoster}}">
        </div>
        <div class="single-movie-info col-xs-12 col-sm-7">

            <h4 class="text-primary">Director</h4>
            <p>
                {{ $movie->director }}
            </p>

            <h4 class="text-primary">Genres</h4>
            <p>
                {{ $movie->genres }}
            </p>

            <h4 class="text-primary">Year</h4>
            <p>
                {{ $movie->year }}
            </p>

            <h4 class="text-primary">Runtime</h4>
            <p>
                {{ $movie->runtime }}
            </p>

            <h4 class="text-primary">Plot</h4>
            <p>
                {{ $movie->plot }}
            </p>
        </div>
    </div>
@stop