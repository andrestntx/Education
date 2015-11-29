<?php

namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['company']);

        if ($user->isAdmin()) {
            return view('dashboard.pages.companies.show')->with(['user' => $user]);
        } elseif ($user->isRegistered()) {
            $user = Auth::user()->load(['company']);

            return view('dashboard.pages.companies.users.scores', compact('user'));
        }

        return redirect()->to('companies');
    }
}
