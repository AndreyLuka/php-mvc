<?php

namespace Core;

/**
 * Class Router.
 */
class Router
{
    /** Controller name.
     * @var string
     */
    private $controller;

    /**
     * Get Controller name.
     * @return string
     * @throws \Exception
     */
    public function getController()
    {
        $controller = null;

        if (array_key_exists('controller', $_GET) && !empty($_GET['controller'])) {
            $controller = $_GET['controller'];
        }

        // if homepage
        if ((!$controller) && (
            ($_SERVER['REQUEST_URI'] == APP_DIR . '/') ||
            ($_SERVER['REQUEST_URI'] == APP_DIR . '/?' . $_SERVER['QUERY_STRING']))
        ) {
            $controller = DEFAULT_CONTROLLER;
        }

        if (!$controller) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            exit('404 Not Found');
        }

        $controller = 'App\Controllers\\' . ucfirst($controller) . 'Controller';

        if (!class_exists($controller)) {
            throw new \Exception(sprintf('Controller class %s not found', $controller));
        }

        $this->controller = $controller;

        return $controller;
    }

    /**
     * Get Action name.
     * @return string
     * @throws \Exception
     */
    public function getAction()
    {
        array_key_exists('action', $_GET) && !empty($_GET['action']) ?
            $action = $_GET['action'] : $action = 'index';

        $action = $action . 'Action';

        if (!method_exists($this->controller, $action)) {
            throw new \Exception(sprintf('Method %s does not exists in %s', $action, $this->controller));
        }

        return $action;
    }
}
