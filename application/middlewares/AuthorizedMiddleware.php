<?php

namespace application\middlewares;

use application\interfaces\Middleware;
use application\lib\Auth;

class AuthorizedMiddleware implements Middleware
{
    public function handle (): void
    {
        if (Auth::user()) {
            redirect('/')->go();
        }
    }
}
