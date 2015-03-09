<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MoviesController extends Controller {


    /**
     * Display a listing of the resource.
     * GET /movies
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        return View::make('movies.index', compact('user'));
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
     * Store a newly created resource in storage.
     * POST /movies
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->input('movie')[0];

        $movie =  Movie::create([
            'imdbID' => $data['imdbID'],
            'user_id' => Auth::user()->id,
            'title' => $data['Title'],
            'imdbRating' => $data['imdbRating'],
            'actors' => $data['Actors'],
            'awards' => $data['Awards'],
            'country' => $data['Country'],
            'director' => $data['Director'],
            'genre' => $data['Genre'],
            'language' => $data['Language'],
            'metascore' => $data['Metascore'],
            'plot' => $data['Plot'],
            'poster' => $data['Poster'],
            'rated' => $data['Rated'],
            'released' => $data['Released'],
            'response' => $data['Response'],
            'runtime' => $data['Runtime'],
            'type' => $data['Type'],
            'writer' => $data['Writer'],
            'year' => $data['Year'],
            'imdbVotes' => $data['imdbVotes']
        ]);

        $movie->save();
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


    public function postMovieSearch(Request $request) {
        $search = $request->input('search');

        $requestURL = "http://www.myapifilms.com/imdb?title=".urlencode($search)."&limit=5&token=fc9e6951-2b3b-4785-9553-bfb78754c740";
        //$requestURL = "http://imdb.wemakesites.net/api/1.0/get/search/?q=" . urlencode($search);
        // $requestURL = "http://www.omdbapi.com/?s=" . urlencode($search);

        $movies = json_decode(file_get_contents($requestURL), true);
        //$poster = json_decode(file_get_contents('http://api.themoviedb.org/3/find/'. $response[0]['idIMDB'] .'?api_key=60265511ecb1f99c7a29741e65d4ede6&external_source=imdb_id'), true);
        foreach($movies as &$movie) {
            $poster = json_decode(file_get_contents('http://api.themoviedb.org/3/find/'. $movie['idIMDB'] .'?api_key=60265511ecb1f99c7a29741e65d4ede6&external_source=imdb_id'), true);
            $movie['urlPoster'] = 'http://image.tmdb.org/t/p/w396'.$poster['movie_results'][0]['poster_path'];
        }

        return $movies;
    }

}
