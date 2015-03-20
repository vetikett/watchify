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
     * Add movie to Database
     *
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        $this->createMovie($request);

        $this->addMovieToUser($request);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addMovieToUser(Request $request) {

        if ( isset($request->input('movie')[0]['idIMDB']) ) {
            $movieId = $request->input('movie')[0]['idIMDB'];
        }else{
            $movieId = $request->input('movie_id');
        }

        $user = Auth::user();

        $user->movies()->attach($movieId);

        return redirect()->back();
    }

    public function removeMovieFromUser(Request $request) {
        $user = Auth::user();

        $movieId = $request->input('movie_id');

        $user->movies()->detach($movieId);

        return redirect()->back();
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
        $movie = Movie::find($id);

        return view('movies.show', compact('movie'));
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

        $movies = $this->changeToValidPosterUrl($movies);

        return $movies;
    }


    /**
     * Change all urlPoster properties to a valid link.
     * (Sadly IMDB no longer allows you link to their resources.)
     *
     * @param $movies
     * @return array
     */
    private function changeToValidPosterUrl($movies) {
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
    }

    /**
     * Filter through the AJAX request data
     * AND then store the movie to the DB.
     *
     * @param Request $request
     * @return String (example = "tt0306685", IMDB style).
     */
    private function createMovie(Request $request) {

        $data = $request->input('movie')[0];

        if( $this->movieNotInDB($data['idIMDB']) ) {

            // If there is no data on the director, set to unknown.
            if (! isset($data['directors'][0]['name']) ) {
                $data['directors'][0]['name'] = 'unknown';
            }

            // Make a genres string variable from a an array based genres variable
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
        }

    }

    /**
     * Checks if the movie already exists.
     *
     * @param $movieId
     * @return bool
     */
    private function movieNotInDB($movieId) {
        $query = DB::table('movies')->where('id', $movieId)->get();
        if(count($query) == 0) {
            return true;
        }
        return false;
    }

}
