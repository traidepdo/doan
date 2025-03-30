<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            // Nếu không phải admin, chuyển hướng về trang login hoặc trang khác
            return redirect()->route('login');
        }

        return $next($request);
    }
}

