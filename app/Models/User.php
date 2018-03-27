<?php

namespace App\Models;

use Core\Model;

/**
 * Class User.
 */
class User extends Model
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Roles: user, admin
     * @var string
     */
    private $role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    /**
     * Find User by username.
     * @param string $username
     * @return mixed|self
     */
    public static function findByUsername($username)
    {
        $statement = self::$db->prepare('SELECT * FROM ' . DB_TABLE_PREFIX . 'users WHERE username = :username LIMIT 1');
        $statement->bindValue(':username', $username);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, self::class);

        return $statement->fetch();
    }

    /**
     * Find User by username and password.
     * @param string $username
     * @param string $password
     * @return mixed|self
     */
    public static function findByUsernameAndPassword($username, $password)
    {
        $statement = self::$db->prepare('SELECT * FROM ' . DB_TABLE_PREFIX . 'users WHERE username = :username AND password = :password LIMIT 1');
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, self::class);

        return $statement->fetch();
    }
}
