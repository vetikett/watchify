<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    protected $dates = ['releaseDate'];

    // enable mass assignment on these cullumns
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'rating',
        'director',
        'genres',
        'plot',
        'simplePlot',
        'urlPoster',
        'releaseDate',
        'runtime',
        'year',
        'votes',
        'created_at',
        'updated_at'
    ];

    public function getReleaseDateAttribute($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }


    public function user() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

}
