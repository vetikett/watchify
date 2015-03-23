<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

   	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    public function movies() {
        return $this->belongsToMany('App\Movie')->orderBy('created_at', 'desc')->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany('App\User', 'following_users', 'user_id', 'following_id')->withTimestamps();
    }


    /**
     * Checks to see if a user is being
     * followed by the current user.
     *
     * @return bool
     */
    public function isFollowed() {
        // Is $userId and followingId if a unique match in link table?
        $match = DB::table('following_users')
            ->where('user_id', Auth::user()->id)
            ->where('following_id', $this->id)
            ->get();

        if (count($match) == 1) {
            return true;
        }
    }

    public function hasMovie($movieId) {
        $query = DB::table('movie_user')
            ->where('movie_id', '=', $movieId)
            ->where('user_id', '=', Auth::user()->id)->get();

        if ( count($query) == 1 ) {
            return true;
        }

        return false;
    }

    /**
     * Get all users except the current user.
     *
     * @param array $columns
     * @return collection
     */
    public static function allExceptAuthUser($columns = array('*'))
	{
		$instance = new static;

        return $instance->newQuery()->where('id', '!=', Auth::user()->id);
    }

    /** ======================================
     * Calculate the top matching users
     * Based on what movies they have watched.
     *
     * This is just a first step!!
     * A lot of optimization to be done here!!
     *
     * @return array
     */
    public function findTopTwelveUserMatches() {

        $authenticatedUsersMovieIds = $this->getAuthenticatedMovieIds();

        if ($authenticatedUsersMovieIds) {
            $followingIds = $this->followingIds();

            $usersAndMovieIds = $this->usersAndMovieIds($followingIds);

            $usersWithNumberOfMatchedMovies = $this->usersWithNumberOfMatchedMovies($usersAndMovieIds, $authenticatedUsersMovieIds);

            $topToBottomMatches = $this->topToBottomMatches($usersWithNumberOfMatchedMovies);

            return $this->topTwelveMatches($topToBottomMatches);
        }

        return false;

    }

    /** =========================================
     * Below is private methods used to calculate
     * findTopTwelveUserMatches method:
     */

    // Get movie id's from current user
    private function getAuthenticatedMovieIds() {
        $authUserMovies = Auth::user()->movies;
        if (count($authUserMovies) > 0) {
            $allAuthUserMovies = [];
            foreach($authUserMovies as $authUserMovie) {
                $allAuthUserMovies[] = $authUserMovie->attributes['id'];
            }
            return $allAuthUserMovies;
        }
        return false;
    }

    // get user id's on all users the current user IS following.
    private function followingIds() {
        $followingIds = $this->join('following_users', 'following_users.user_id', '=', 'users.id')
            ->where('following_users.user_id', '=', Auth::user()->id)
            ->get(['following_users.following_id'])
            ->toArray();

        return $followingIds;
    }

    // Get user id's AND movie id's from all users except the current user.
    private function usersAndMovieIds($followingIds) {
        $usersAndMovies = [];

        $users = $this->with('movies')
            ->where('users.id', '!=', Auth::user()->id)
            ->get()
            ->toArray();

        foreach($users as $key => $user) {

            if (count($user['movies']) > 0) {

                foreach($user['movies'] as $movie) {
                    $usersAndMovies[$user['id']][] = $movie['id'];
                }
            }
        }

        foreach($followingIds as $followingId) {
            if ( array_key_exists($followingId['following_id'],$usersAndMovies ) )
                unset($usersAndMovies[$followingId['following_id']]);
        }

        return $usersAndMovies;
    }

    // Get an array och userIds => number of movies matched to
    // current users movies.
    private function usersWithNumberOfMatchedMovies($usersAndMovieIds, $authenticatedUsersMovieIds) {
        $usersWithNumberOfMatchedMovies = [];

        foreach($usersAndMovieIds as $userId => $movies) {
            $moviesMatched = 0;
            foreach($movies as $key => $movie) {
                if ( in_array($movie, $authenticatedUsersMovieIds) ) {
                    $moviesMatched++;
                }
            }

            $usersWithNumberOfMatchedMovies[$userId] = $moviesMatched;
        }

        return $usersWithNumberOfMatchedMovies;
    }

    // Sort the "userIds => number of movies matched" to highest movies matched first.
    private function topToBottomMatches($usersWithNumberOfMatchedMovies) {
        $topToBottomMatches = [];
        uasort($usersWithNumberOfMatchedMovies, function($a, $b) {
            return $b - $a;
        });
        foreach(array_keys($usersWithNumberOfMatchedMovies) as $topMatch) {
            $topToBottomMatches[] = $topMatch;
        }

        return $topToBottomMatches;
    }

    // pick the top twelve matched users.
    // Return: Sorted array of 12. Highest first.
    private function topTwelveMatches($topToBottomMatches) {
        $topTwelveMatches = [];

        if ( count($topToBottomMatches) > 12) {
            $nummerOfMatches = 12;
        }else{
            $nummerOfMatches = count($topToBottomMatches);
        }

        for ($i = 0; $i < $nummerOfMatches; $i++) {
            $topTwelveMatches[] = $this->find($topToBottomMatches[$i]);
        }

        return $topTwelveMatches;

    }


}
