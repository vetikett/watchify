@extends('_layouts.auth')

@section('auth-content')
	<div class="login-page">
		<h2>Login</h2>
		{{ Form::open(array('route' => 'login.post')) }}

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
					{{ Form::submit('Log in', array('class' => 'auth-button')) }}
					<p class="sign-up-link">{{ link_to_route('users.create', 'Sign up') }}</p>
				</li>
			</ul>

		{{ Form::close() }}
	</div>
@stop