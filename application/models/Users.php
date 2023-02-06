<?php

namespace application\models;

use application\core\Model;
use PDOStatement;

class Users extends Model
{
    public function getUserByUserName (string $userName): array|PDOStatement|null
    {
        return $this->db->query('SELECT username, id, password FROM users WHERE username = :username', [
            'username' => $userName
        ]);
    }
}
