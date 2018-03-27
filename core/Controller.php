<?php

namespace Core;

/**
 * Class Controller.
 */
abstract class Controller
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var View
     */
    protected $view;

    /**
     * Controller constructor.
     * @param \PDO $db
     * @param Request $request
     * @param View $view
     * @param Auth $auth
     */
    public function __construct(\PDO $db, Request $request, View $view, Auth $auth)
    {
        $this->db = $db;
        $this->request = $request;
        $this->view = $view;
        $this->auth = $auth;
    }
}
