<?php namespace Education\Http\Middleware;

use Closure;
use Log;
use Carbon\Carbon;

use Illuminate\Http\Request;

class AfterLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        Log::info( 'Log Middleware', [
            'user'      => $request->user()->username, 
            'method'    => $request->method(), 
            'url'       => $request->url(),
            'ip'        => $request->ip(),
            'ajax'      => $request->ajax(),
            'date'      => Carbon::now()
        ]);

        return $response;
    }
}
