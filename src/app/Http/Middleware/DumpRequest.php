<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DumpRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $user)
    {
        // dumpRequest:admin_userが第3引数に入っている
        // (二つはphp artisan make:middlewareで作成される)
        if ($user === 'admin_user') {
            var_dump(htmlspecialchars($request), $user);
        }
        return $next($request);
    }
}
