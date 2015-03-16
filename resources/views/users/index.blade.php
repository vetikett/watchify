@extends('_layouts.default')

@section('content')
    <h2>Users</h2>
    <div class="row">
        @foreach($users as $user)

                <div class="col-xs-7 col-md-4 col-sm-6">
                    <h3 class="">{{ $user->username}}</h3>

                    @if( $user->isFollowed() )
                        @include('_partials.unfollow_button')
                    @else
                        @include('_partials.follow_button')
                    @endif


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