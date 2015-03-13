<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MoviesController extends Controller {


    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * GET /movies
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('movies.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /movies/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $movieId = $this->createMovie($request);

        $user->movies()->attach($movieId);
    }

    /**
     * Display the specified resource.
     * GET /movies/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /movies/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /movies/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /movies/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * AJAX movie search request
     *
     * @param Request $request
     * @return JSON
     */
    public function movieSearch(Request $request) {
        $search = $request->input('search');

        $requestURL = "http://www.myapifilms.com/imdb?title=".urlencode($search)."&limit=5&token=fc9e6951-2b3b-4785-9553-bfb78754c740";

        $movies = json_decode(file_get_contents($requestURL), true);

        $this->changeToValidPosterUrl($movies);

        return $movies;
    }

    /*private function changeToValidPosterUrl($movies) {
        foreach($movies as &$movie) {
            $poster = json_decode(file_get_contents('http://api.themoviedb.org/3/find/'. $movie['idIMDB'] .'?api_key=60265511ecb1f99c7a29741e65d4ede6&external_source=imdb_id'), true);
            if ( $poster['movie_results'] == [] && $poster['tv_results'] == [] ) {
                $movie['urlPoster'] = '';
            }else{
                if ( $poster['tv_results'] == [] ) {
                    $movie['urlPoster'] = 'http://image.tmdb.org/t/p/w396'.$poster['movie_results'][0]['poster_path'];
                } elseif ( $poster['movie_results'] == [] ) {
                    $movie['urlPoster'] = 'http://image.tmdb.org/t/p/w396'.$poster['tv_results'][0]['poster_path'];
                }
            }
        }

        return $movies;
    }*/

    private function createMovie(Request $request) {
        $data = $request->input('movie')[0];

        if (! isset($data['directors'][0]['name']) ) {
            $data['directors'][0]['name'] = 'unknown';
        }

        $genresAsArray = [];
        foreach($data['genres'] as $genre) {
            $genresArray[] = $genre;
        }

        $genresAsString = join(', ', $genresArray);


        Movie::create([
            'id' => $data['idIMDB'],
            'title' => $data['title'],
            'rating' => $data['rating'],
            'director' => $data['directors'][0]['name'],
            'genres' => $genresAsString,
            'plot' => $data['plot'],
            'simplePlot' => $data['simplePlot'],
            'urlPoster' => $data['urlPoster'],
            'releaseDate' => $data['releaseDate'],
            'runtime' => $data['runtime'][0],
            'year' => $data['year'],
            'votes' => $data['votes']
        ]);

        return $data['idIMDB'];
    }

    private function changeToValidPosterUrl(&$movies) {
        foreach($movies as &$movie) {
            $poster = json_decode(file_get_contents('http://api.themoviedb.org/3/find/'. $movie['idIMDB'] .'?api_key=60265511ecb1f99c7a29741e65d4ede6&external_source=imdb_id'), true);
            if ( $poster['movie_results'] == [] && $poster['tv_results'] == [] ) {
                $movie['urlPoster'] = '';
            }else{
                if ( $poster['tv_results'] == [] ) {
                    $movie['urlPoster'] = 'http://image.tmdb.org/t/p/w396'.$poster['movie_results'][0]['poster_path'];
                } elseif ( $poster['movie_results'] == [] ) {
                    $movie['urlPoster'] = 'http://image.tmdb.org/t/p/w396'.$poster['tv_results'][0]['poster_path'];
                }
            }
        }
    }

}
