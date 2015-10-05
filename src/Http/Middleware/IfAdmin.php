<?php

namespace IntoTheSource\Users\Http\Middleware;

use App\UserManager;
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
        if (UserManager::hasRoles('admin')) {
            return $next($request);
        }
        $request->session()->flash('message', 'U heeft niet de juiste rechten om de gezochte pagina te bekijken.');
        return \Redirect::route('login.index');
    }
}