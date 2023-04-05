<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_email = $request->email;
        $doctor = User::where('email', $user_email)->first()->typeable;
        if (isset($doctor)) {
            if ($doctor && $doctor->is_banned) {
                auth()->logout();
                 return redirect()->route('login')->with('error', 'This account is banned.');
            } else
            return $next($request);
        }
    }
}
