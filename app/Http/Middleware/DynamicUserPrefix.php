<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DynamicUserPrefix
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $prefix = strtolower(str_replace(' ', '-', "{$user->first_name}-{$user->last_name}"));
            // Store the prefix in the request
            $request->merge(['user_prefix' => $prefix]);
            view()->share('user_prefix', $prefix);
        }

        return $next($request);
    }
}