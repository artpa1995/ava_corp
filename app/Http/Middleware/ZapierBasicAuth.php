<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ZapierBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validUsername = 'your-username';
        $validPassword = 'your-password';

        if ($request->getUser() !== $validUsername || $request->getPassword() !== $validPassword) {
            return response('Unauthorized', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
