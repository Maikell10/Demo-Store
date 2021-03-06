<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->permiso())
            return $next($request);
        return redirect('/')->with('mensajeInfo', __("You do not have permission to enter here") );
    }

    private function permiso()
    {
        return Auth::user()->roles[0]->slug == 'registereduser';
    }
}
