<?php

namespace Gertjanroke\Users\Http\Middleware;

use App\User;
use Closure;

class IfAdmin
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
        if (\Auth::user()->hasRoles(['admin', 'super admin'])) {
            return $next($request);
        }
        return redirect()->route('login.index');
    }
}
