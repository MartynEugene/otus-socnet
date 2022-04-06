<?php

namespace App\Http\Middleware;

use App\Components\Userbase\InfoComponent;
use App\Components\Auth\LoginComponent;

use Closure;


class CheckInfo
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
        $info = new InfoComponent();
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $path = $request->path();
        if ($email && !$info->exists($email) && $path != 'info') {
            return redirect()->to('info');
        }

        return $next($request);
    }
}
