<?php

namespace application\middlewares;

use application\interfaces\Middleware;
use application\lib\Auth;

class AuthMiddleware implements Middleware
{
    public function handle ()
    {
        if (!Auth::user()) {
            redirect('/login')->go();
        }
    }
}
