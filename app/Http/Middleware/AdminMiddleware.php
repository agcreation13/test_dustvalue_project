<?php
// Path: app/Http/Middleware/AdminMiddleware.php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User; // Import the User model

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === User::ROLE_ADMIN) {
            return $next($request);
        }

        // Return a 403 Forbidden response
        return response()->json(['error' => 'You do not have access to this page.'], 403);
    }
}