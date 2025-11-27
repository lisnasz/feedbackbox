<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
