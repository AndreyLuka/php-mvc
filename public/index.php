<?php

/**
 * Front Controller.
 */

use App\Models\User;
use Core\Auth;
use Core\Request;
use Core\Router;
use Core\View;

/**
 * Composer Autoload.
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Global config.
 */
require_once __DIR__ . '/../config.php';

session_start();

$request = new Request();

$router = new Router();

$controller = $router->getController();
$action = $router->getAction();

$dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
$db = new \PDO($dsn, DB_USER, DB_PASS);

$view = new View();

$auth = new Auth();
if (!$auth->guest()) {
    User::setDb($db);
    $user = User::findByUsername($auth->getUsername());
    $user ? $auth->setUser($user) : $auth->logout();
}

$controllerObject = new $controller($db, $request, $view, $auth);
$controllerObject->$action();
