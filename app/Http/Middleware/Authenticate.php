<?php

namespace App\Http\Middleware;

use App\Components\Auth\LoginComponent;
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
        $login = new LoginComponent();
        $pathExcept = ['signin', 'signup'];
        $path = $request->path();
        if (!$login->isLoggedIn($request) && !in_array($path, $pathExcept)) {
            return redirect()->to('signin');
        }

        return $next($request);
    }
}
