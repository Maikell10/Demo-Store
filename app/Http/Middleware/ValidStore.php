<?php

namespace App\Http\Middleware;

use App\StoreProfile;
use Closure;
use Illuminate\Support\Facades\Auth;

class ValidStore
{
    public function handle($request, Closure $next)
    {
        if ($this->permiso())
            return $next($request);
        return redirect('/register/store')->with('mensajeInfo', __("You don't have any plan active right now"));
    }

    private function permiso()
    {
        if (Auth::user()->id == 1) {
            return 1;
        }
        $store_profile = StoreProfile::where('user_id', Auth::user()->id)->first();
        if ($store_profile != '') {
            return $store_profile->date_expiration >= date('Y-m-d');
        }
    }
}
