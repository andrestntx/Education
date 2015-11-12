<?php namespace Education\Http\Middleware;

use Closure, Auth;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {    
        if( Auth::user()->type != $type)
        {
            return redirect()->to('/');
        } 
        
        return $next($request);
    }
}
