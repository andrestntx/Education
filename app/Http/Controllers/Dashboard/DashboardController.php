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
			dd($user->protocols);
			return view('dashboard.pages.companies.show')->with(['user' => $user]);
		}
		else if($user->isRegistered())
		{
			return view('dashboard.pages.user.scores', compact('user'));
		}

		return redirect()->to('companies');
	}

}
