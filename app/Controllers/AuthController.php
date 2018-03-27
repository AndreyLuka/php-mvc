<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

/**
 * Class AuthController.
 */
class AuthController extends Controller
{
    /**
     * Login.
     * @throws \Exception
     */
    public function loginAction()
    {
        if (!$this->request->isPost()) {
            header('Location: ' . APP_DIR . '/');
        }

        User::setDb($this->db);

        $user = User::findByUsernameAndPassword(
            $this->request->getRequestParam('login'),
            $this->request->getRequestParam('password')
        );

        if (!$user) {
            throw new \Exception('Incorrect Login or Password');
        }

        $this->auth->login($user->getUsername());

        header('Location: ' . APP_DIR . '/');
    }

    /**
     * Logout.
     */
    public function logoutAction()
    {
        !$this->auth->guest() ? $this->auth->logout() : null;

        header('Location: ' . APP_DIR . '/');
    }
}
