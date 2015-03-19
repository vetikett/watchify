<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspirationsController extends Controller {

	public function index() {
        //$users = User::allExceptAuthUser();

        //dd(User::with('movies')->find(16));
        $users = Auth::user()->findTopTwelveUserMatches();




        return view('inspiration.index', compact('users'));

    }

}
