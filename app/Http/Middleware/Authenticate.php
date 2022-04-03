<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    /**
     * Custom authorization
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pathExcept = ['signin', 'signup'];
        $path = $request->path();
        $loggedIn = false; //$request->session()->get('logged_in');
        if (!$loggedIn && !in_array($path, $pathExcept)) {
            return redirect()->to('signin');
        }

        return $next($request);
    }
}
