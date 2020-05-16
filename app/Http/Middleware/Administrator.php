<?php

namespace App\Http\Middleware;

use Closure;

class Administrator
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
        if(auth()->check()) {
            if(auth()->user()->isAdmin()) {
                return $next($request);
            } else {
                session()->flash('error', 'Vous n`êtes pas autorisé à effectuer cette action');
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
