<nav class="main-nav navbar navbar-default">
    <div class="container-fluid">
            <div class="navbar-header navbar-collapse navbar-left">
                    {!! link_to_route('home', 'Watchify', [], ['class' => "title navbar-brand col-xs-12"]) !!}
            </div>

            <div class="text-center navbar-collapse navbar-nav">
                <ul class="nav navbar-nav text-center nav-middle">
                    <li class="{{ Request::is('inspiration') ? 'active' : '' }}"><a href="{{ action('InspirationsController@index') }}" title="">Inspiration</a></li>
                    <li class="{{ Request::is('users') ? 'active' : '' }}"><a href="{{ action('UsersController@index') }}" title="">Browse Users</a></li>
                    <li class="{{ Request::is('following') ? 'active' : '' }}"><a href="{{ action('FollowingsController@index') }}" title="">Following</a></li>
                    <li class="{{ Request::is('movies') ? 'active' : '' }}"><a href="{{ action('MoviesController@index') }}"  title="">Watched</a></li>
                </ul>
            </div>

            <div class="navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a data-target="#"  id="dropdownMenu1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            {{ Auth::user()->username }}<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </div>
</nav>

