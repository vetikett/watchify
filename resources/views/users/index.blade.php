@extends('_layouts.default')

@section('content')
	<div class="page-container">
		<h2>Users</h2>
		<ul>

			@foreach($users as $user)
				<li class="movie-lists">
					<h3>{{ $user->username}}</h3>
					<div class="movie-lists-plot"><p>{{ $user->email }}</p></div>

				</li>
			@endforeach

		</ul>
	</div>	

@stop