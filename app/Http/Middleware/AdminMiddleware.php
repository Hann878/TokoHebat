<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('user_id')) {
            return response()->json([
                'message' => 'Akses ditolak'
            ], 401);
        }

        if (Session::get('role') !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak'
            ], 403);
        }

        return $next($request);
    }
}
