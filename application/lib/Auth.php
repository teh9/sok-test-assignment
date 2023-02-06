<?php

namespace application\lib;

class Auth
{
    /**
     * Check is user authorized.
     *
     * @return bool
     */
    public static function user (): bool
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }

        return false;
    }
}
