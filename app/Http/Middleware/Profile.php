<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Profile
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
        if (!$request->user()->profile()->exists()) {
            return redirect()->route('account.create');
        }

        return $next($request);
    }
}
