<?php

namespace Education\Http\Middleware;

use Closure, Auth;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }
        else if( ! $this->auth->user()->active){
            Auth::logout();

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } 
            else {
                return redirect()->guest('auth/login')
                    ->withErrors([
                        'username' => 'El Usuario se encuentra deshabilitado',
                    ]);
            }
        }

        return $next($request);
    }
}
