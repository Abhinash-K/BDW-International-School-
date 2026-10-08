<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 2) {
            return $next($request); // Allow access for teachers
        }

        abort(403, 'You do not have permission to access this page.'); // Block unauthorized users
    }
}
