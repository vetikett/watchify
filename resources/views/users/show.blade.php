@extends('_layouts.default')

@section('content')
    <div class="row">
        <h3 class="text-center col-xs-12">{{ $user->username }}</h3>
    </div>
    <div class="row">
        <div class="text-center col-xs-12">
            @if( $user->isFollowed() )
                @include('_partials.unfollow_button')
            @else
                @include('_partials.follow_button')
            @endif
        </div>
    </div>



    <div class="single-user row">
        <h4 class="text-center text-primary">Have watched:</h4>
        <div class="col-xs-12  display-users text-center">



            @foreach($user->movies as $movie)
                <a href="{{ action('MoviesController@show', [$movie->id]) }}">
                    <div class="list-recent-movies">
                        <div class="movie-lists-img"><img src="{{$movie->urlPoster}}"></div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
    <div class="row">
    </div>
@stop