@extends('_layouts.auth')

@section('auth-content')
	<div class="login-page">
		<h3>Create</h3>
		{{ Form::open(array('route' => 'users.store')) }}

			<ul>
				<li>
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email') }}
					{{ $errors->first('email', '<p>:message</p>') }}
				</li>
				<li>
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password') }}
					{{ $errors->first('password', '<p>:message</p>') }}
				</li>
				<li>
					{{ Form::submit('create', array('class' => 'auth-button')) }}
					<p class="sign-up-link">{{ link_to_route('home', 'Go Back') }}</p>		
				</li>
				
			</ul>

		{{ Form::close() }}
	</div>
@stop