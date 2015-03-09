<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    // enable mass assignment on these cullumns
    protected $fillable = ['imdbID', 'user_id', 'title', 'imdbRating', 'actors', 'awards', 'country',
        'director', 'genre', 'language', 'metascore', 'plot', 'poster', 'rated', 'released',
        'response', 'runtime', 'type', 'writer', 'year', 'imdbVotes'];


    public function user() {
        return $this->belongsTo('App\User');
    }

}
