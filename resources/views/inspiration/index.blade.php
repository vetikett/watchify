@extends('_layouts.default')

@section('content')
    <h2 class="text-center text-primary">Top Twelve User Matches</h2>
    <div class="row">
        @if($users)
            @foreach($users as $user)

                <div class="col-xs-12 col-md-4 col-sm-6 display-users text-left">
                    <a href="{{ action('UsersController@show', [$user->id]) }}">
                        <div class="row">
                            <div class="follow-buttons col-xs-2">
                                @if( $user->isFollowed() )
                                    @include('_partials.unfollow_button')
                                @else
                                    @include('_partials.follow_button')
                                @endif
                            </div>
                            <h4 class="col-xs-10">{{ $user->username}}</h4>
                        </div>
                    </a>



                    <p class="p-recent-movies">latest movies</p>

                    @foreach($user->movies->slice(0, 4) as $movie)
                        <a href="{{ action('MoviesController@show', [$movie->id]) }}">
                            <div class="list-recent-movies">
                                <div class="movie-lists-img"><img src="{{$movie->urlPoster}}"></div>
                            </div>
                        </a>
                    @endforeach

                </div>

            @endforeach
        @else
            <h3 class="text-center">Add at least one movie bofore you we can match you to users</h3>
        @endif

    </div>
    <div class="row">
    </div>

@stop