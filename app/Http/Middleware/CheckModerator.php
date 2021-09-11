<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckModerator
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
        $user = auth()->user();
        if ($user->isAdmin() || $user->isModerator()) {
            return $next($request);
        }
        abort(403);
    }
}
