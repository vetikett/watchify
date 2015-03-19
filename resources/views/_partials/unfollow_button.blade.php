{!! Form::open(['route' => 'unfollow']) !!}
    <input type="hidden" name="following_id" value="{{ $user->id }}"/>
    <input class="btn btn-xs btn-warning" type="submit" value="unfollow"/>
{!! Form::close() !!}