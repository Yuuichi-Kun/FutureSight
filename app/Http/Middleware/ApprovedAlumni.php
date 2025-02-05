<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedAlumni
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->alumni || auth()->user()->status !== 'approved') {
            return redirect()->route('home')
                ->with('error', 'Anda harus menunggu persetujuan admin sebelum dapat mengakses kuesioner.');
        }

        return $next($request);
    }
} 