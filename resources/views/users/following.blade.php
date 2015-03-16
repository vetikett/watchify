@extends('_layouts.default')

@section('content')
    <h2>Following</h2>
    <div class="row">
        @foreach($user->following as $user)

            <div class=" text-center col-xs-12 col-md-4 col-sm-6">
                <h3 class="">{{ $user->username}}</h3>

                    @include('_partials.unfollow_button')

                <p class="p-recent-movies">latest movies</p>

                @foreach($user->movies->slice(0, 4) as $movie)
                    <div class="list-recent-movies">
                        <div class="movie-lists-img"><img src="{{$movie->urlPoster}}"></div>
                    </div>
                @endforeach

            </div>

        @endforeach

    </div>

@stop