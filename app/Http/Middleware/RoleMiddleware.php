<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Middleware ini menerima parameter role yang diizinkan.
     * Contoh penggunaan: ->middleware('role:admin') atau ->middleware('role:admin,teknisi')
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $roles  Role yang diizinkan, dipisahkan koma
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        // Pastikan user sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Parse roles yang diizinkan (bisa lebih dari satu, dipisah koma)
        $allowedRoles = explode(',', $roles);

        // Cek apakah role user ada dalam daftar yang diizinkan
        if (!in_array($request->user()->role, $allowedRoles)) {
            // Jika tidak diizinkan, redirect kembali dengan warning message
            return redirect()->back()
                ->with('warning', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}

