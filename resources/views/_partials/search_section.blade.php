<div class="search-section">
	<h2>
		<label for="search">Search Movie</label>
        <img src="{{ asset('img/ajax-loader.gif')}}" class="spinner" alt="loader"/>
	</h2>
	<input class="form-control" id="search" autocomplete="off" name="search" type="text">
	<ul class="search-result">
	</ul>

    <div class="movie-spec">
        <h2 class="text-primary">Welcome {{$user->username}}!</h2>
        <ul class="welcome-text text-left">
            <li class="welcome-text text-primary"><p><span class="emphasize text-primary">Search</span> a movie or Tv-show you have <span class="emphasize text-primary">watched</span> and want to <span class="emphasize text-primary">recommend</span>.</p></li>
            <li class="welcome-text text-primary"><p>You should <span class="emphasize text-primary">ONLY</span> add it to Watched <span class="emphasize text-primary">if</span> you <span class="emphasize text-primary">liked</span> it!</p></li>
            <li class="welcome-text text-primary"><p>You can <span class="emphasize text-primary">follow</span> people that have <span class="emphasize text-primary">similar taste</span> as you!</p></li>
            <li class="welcome-text text-primary"><p>And others will then be able to <span class="emphasize text-primary">follow</span> you based on what movies you have watched.</p></li>
        </ul>
        <h3 class="text-primary">Enjoy!</h3>

    </div>
</div>