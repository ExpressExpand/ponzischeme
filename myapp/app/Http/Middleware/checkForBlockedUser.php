<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkForBlockedUser
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
        $user = Auth::User();
        if($user->isBlocked == 1) {
            return redirect('/dashboard')->withErrors('Your account has been blocked');
        }
        return $next($request);
    }
}
