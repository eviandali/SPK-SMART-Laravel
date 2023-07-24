<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {

        $allowedtugas = ['admin', 'pengguna'];

        if (! $request->user() || ! in_array($request->user()->tugas, $allowedtugas)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
