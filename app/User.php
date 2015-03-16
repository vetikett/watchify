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

    public static function allExceptAuthUser()
    {
        $instance = new static;

        return $instance->where('id', '!=', Auth::user()->id)->get();
    }

    public function movies() {
        return $this->belongsToMany('App\Movie')->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany('App\User', 'following_users', 'user_id', 'following_id')->withTimestamps();
    }


}
