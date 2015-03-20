{!! Form::open(['route' => 'movies.remove', 'class' => 'col-xs-12 add-remove-button']) !!}
    <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>
    <input class="btn btn-xs btn-warning" type="submit" value="Remove"/>
{!! Form::close() !!}
