<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserEmailIsVerified
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
        if ($request->user()->isVerified == 0) {
            return redirect('profile')->withErrors(
                'You need to verify your email before you can Provide Help or Request Help');
        }
        return $next($request);
    }
}
