{!! Form::open(['route' => 'follow']) !!}
    <input type="hidden" name="following_id" value="{{ $user->id }}"/>
    <input class="btn btn-xs btn-primary" type="submit" value="Follow"/>
{!! Form::close() !!}