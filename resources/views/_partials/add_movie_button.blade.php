{!! Form::open(['route' => 'movies.add', 'class' => 'col-xs-12 add-remove-button']) !!}
    <input type="hidden" name="movie_id" value="{{ $movie->id }}"/>
    <input class="btn btn-xs btn-primary" type="submit" value="Add"/>
{!! Form::close() !!}