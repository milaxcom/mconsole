<?php

namespace Milax\Mconsole\Http\Middleware;

use Milax\Mconsole\Core\Mconsole;
use Closure;
use Auth;

class MconsoleMiddleware
{
    /**
     * Check for mconsole access.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Redirect if already authenticated
        if ($request->is('mconsole/login') && Auth::user() && Auth::user()->role_id > 0) {
            return redirect('/mconsole');
        }
        
        // Redirect to login page
        if ((Auth::guest() || Auth::user()->role_id == 0) && !$request->is('mconsole/login')) {
            return redirect('/mconsole/login');
        }
        
        // Build Mconsole UI if authenticated
        if (Auth::check()) {
            Mconsole::boot();
        }
        
        if (!$request->is('mconsole/login') && Auth::user()->role->key != 'root') {
            if (!$this->hasAccess($request)) {
                return response()->view('mconsole::errors.accessdenied');
            }
        }
        
        return $next($request);
    }
    
    protected function hasAccess($request)
    {
        if ($request->is('mconsole/logout')) {
            return true;
        }
        
        $user = Auth::user();
        
        $route = $request->route()->getName();
        $method = $request->method();
        
        // Allow everyone to visit dashboard
        if ($request->path() == 'mconsole') {
            return true;
        }
        
        // Check if route is in user allowed routes
        $menus = $user->role->routes;
        
        // Fix for creating and updating routes
        switch ($method) {
            case 'PUT':
                $route = str_replace('.update', '.edit', $route);
                break;
            case 'POST':
                $route = str_replace('.store', '.create', $route);
        }
        
        if (in_array($menus, $route)) {
            return true;
        }
        
        return false;
    }
}
