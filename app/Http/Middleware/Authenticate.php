<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $user_route = 'user.login';
    protected $admin_route = 'admin.login';

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectToByGuards($request, $guards)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectToByGuards($request, $guards)
    {
        if (! $request->expectsJson()) {
            /*
            if (Route::is('user.*')) {
                return route($this->user_route);
            } elseif (Route::is('admin.*')) {
                return route($this->admin_route);
            }
            */
            if ($guards[0] === 'admin') {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }
    }
}
