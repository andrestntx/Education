<?php namespace LaravelAppUi\Http\Controllers;

use LaravelAppUi\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return view('dashboard.pages.home');
	}

}
