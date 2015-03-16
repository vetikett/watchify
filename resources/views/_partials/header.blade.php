<header>
	<div class="container">
		
		{!! link_to_route('home', 'Watchify', array(), array('class' => "title")) !!}

		<nav class="main-nav">
			<ul>
				<li class="{{ Request::is('inspiration') ? 'active' : '' }}"><a href="" title="">Inspiration</a></li>
				<li class="{{ Request::is('following') ? 'active' : '' }}"><a href="following" title="">Following</a></li>
				<li class="{{ Request::is('movies') ? 'active' : '' }}"><a href="movies"  title="">Movies</a></li>
			</ul>
		</nav>

		<div class="user-nav">
            <div class="user-menu">
                <p>{{ Auth::user()->username }}</p>
                <img src="{{ asset('img/arrow-orange.png')}}" alt="">
            </div>
		</div>
	
	</div>
</header>