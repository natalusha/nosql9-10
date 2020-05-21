<?php

namespace application\core;
use application\core\View;

class Controller
{

    public $route;
    public $url_params;
    public $post_vars;
    public $view;
    public $session_login;
    public $errors;
    public $messages;

    public function __construct($route, $url_params = [], $post_vars = [])
    {
        // dump($route);
        $this->route = $route;
        $this->url_params = $url_params;
        $this->post_vars = $post_vars;
        $this->view = new View($route);

    }

    public function checkSession($user_id)
    {
        if (empty($_SESSION['user_id'])) {
            header("location: /account/login");
        }

    }


}