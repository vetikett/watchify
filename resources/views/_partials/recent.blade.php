<div class="recent-section">
	<h2>Recent</h2>
	
	<ul class="recent-activities">
		@foreach($user->following->slice(0, 5) as $followedUser)
			<li class="row">
                <a href="{{ action('MoviesController@show', [$followedUser->movies[0]->id]) }}">
                    <h3 class="col-xs-2">{{$followedUser->movies[0]->rating}}</h3>
                    <div class="col-xs-2 list-recent-movies">
                        <div class="movie-lists-img"><img src="{{$followedUser->movies[0]->urlPoster}}"></div>
                    </div>
                </a>
                <div class="col-xs-8">
                    <a href="{{ action('MoviesController@show', [$followedUser->movies[0]->id]) }}">
                        <h4>{{$followedUser->movies[0]->title}}</h4>
                    </a>
                    <h6>added by</h6>
                    <a href="{{ action('UsersController@show', [$followedUser->id]) }}">
                        <h4>{{$followedUser->username}}</h4>
                    </a>
                </div>



            </li>
		@endforeach
	</ul>	
</div>