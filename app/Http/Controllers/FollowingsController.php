<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FollowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingsController extends Controller {

    /**
     *  Use auth middleware
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {

        $user = Auth::user();

        return view('users.following', compact('user'));
    }

    /**
     * @param FollowRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function followUser(FollowRequest $request) {

        Auth::user()->following()->attach($request->input('following_id'));

        return redirect()->back();
    }

    /**
     * @param FollowRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unFollowUser(FollowRequest $request){

        Auth::user()->following()->detach($request->input('following_id'));

        return redirect()->back();
    }

}
