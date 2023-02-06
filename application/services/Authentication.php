<?php

namespace application\services;

use application\models\Users;

class Authentication
{
    /**
     * @var string
     */
    public string $message;

    public function __construct (private Users $userModel) {}

    /**
     * Logic to handle attempt authorization.
     *
     * @param array $postData
     * @return bool
     */
    public function login (array $postData): bool
    {
        $user = $this->userModel->getUserByUserName($postData['username']);

        if (is_null($user)) {
            $this->message = 'User not found';
            return false;
        }

        if (!password_verify($postData['password'], $user['password'])) {
            $this->message = 'Password is incorrect';
            return false;
        }

        $this->startSession($user);
        return true;
    }

    /**
     * Starting authorized session.
     *
     * @param array $user
     * @return void
     */
    protected function startSession(array $user): void
    {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
    }
}
