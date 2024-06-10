<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  string[]  ...$users
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$users)
    {
        if (empty($users)) {
            $users = ['default'];
        }

        foreach ($users as $user) {
            if (
                config("auth.basic.{$user}.username") === $request->getUser() &&
                config("auth.basic.{$user}.password") === $request->getPassword()
            ) {
                return $next($request);
            }
        }

        return response('You shall not pass!', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
