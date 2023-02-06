<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Auth;
use application\models\Users;
use application\services\Authentication;

class AuthController extends Controller
{
    /**
     * Show login form.
     *
     * @return void
     */
    public function show (): void
    {
        if (Auth::user())
        {
            redirect('/')->go();
        }

        $this->view->setView('auth/login')->render('Login');
    }

    /**
     * Handle authentication attempt.
     *
     * @return void
     */
    public function login (): void
    {
        $auth = new Authentication(new Users());

        if ($auth->login($_POST))
        {
            redirect('/')->go();
        }

        redirect()->back()->withErrors($auth->message)->go();
    }
}
