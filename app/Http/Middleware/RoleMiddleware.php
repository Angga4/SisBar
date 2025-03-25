<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Pastikan user login dulu
        }

        // Ambil role dari user yang sedang login
        $userRole = Auth::user()->role;

        // Debugging
        \Log::info("User Role: " . $userRole . " | Dibutuhkan: " . $role);

        if ($userRole !== $role) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
