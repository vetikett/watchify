<header>
	<div class="container">
		
		{!! link_to_route('home', 'Watchify', array(), array('class' => "title")) !!}

		<nav class="main-nav">
			<ul>
				<li class="{{ Request::is('inspiration') ? 'active' : '' }}"><a href="" title="">Inspiration</a></li>
				<li class="{{ Request::is('friends') ? 'active' : '' }}"><a href="" title="">My friends</a></li>
				<li class="{{ Request::is('movies') ? 'active' : '' }}"><a href="movies"  title="">My movies</a></li>	
			</ul>
		</nav>

		<div class="user-nav" >
			<a href="#">
				<p>{{ $user->first_name . " " . $user->last_name }}</p>
				<img src="{{ asset('img/arrow-orange.png')}}" alt="">
			</a>
		</div>
	
	</div>
</header>