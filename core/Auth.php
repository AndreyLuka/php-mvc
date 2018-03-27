<?php

namespace Core;

use App\Models\User;

/**
 * Class Auth.
 */
class Auth
{
    /**
     * @var User
     */
    private $user;

    /**
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Login user.
     * @param string $username
     */
    public function login($username)
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    }

    /**
     * Logout user.
     */
    public function logout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
    }

    /**
     * Check if user is guest.
     * @return bool
     */
    public function guest()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true &&
            isset($_SESSION['username'])
        ) {
            return false;
        }

        return true;
    }

    /**
     * Get username.
     * @return null|string
     */
    public function getUsername()
    {
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        }

        return null;
    }
}
