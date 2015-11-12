<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller {

	public function index()
	{
		$user = Auth::user()->load(['company']);

		if($user->isAdmin())
		{
			return view('dashboard.pages.companies.show')->with(['user' => $user]);
		}
		else if($user->isRegistered())
		{
			return view('dashboard.pages.companies.users.scores');
		}

		return redirect()->to('companies');
	}

}
