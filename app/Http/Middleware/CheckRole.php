<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Middleware untuk memeriksa role user.
     * Digunakan di routes: middleware('role:admin') atau middleware('role:guest')
     *
     * Mapping dari kode asli:
     *   index.php    → if ($_SESSION['role'] !== 'admin') redirect ke login
     *   homeguest.php → if ($_SESSION['role'] !== 'guest') redirect ke login
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            // Redirect ke halaman sesuai role masing-masing
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('guest.rating.index');
        }

        return $next($request);
    }
}
