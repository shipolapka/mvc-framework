<?php

namespace core;

use core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    function __construct()
    {
        $arr = require 'config/routes.php';
        foreach ($arr as $key => $val)
        {
            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params)
        {
            if(preg_match($route, $url, $matches))
            {
              $this->params = $params;
              return true;
            }
        }
        return false;
    }

    public function run()
    {
        if($this->match())
        {
            $path = 'controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path))
            {
                $action = $this->params['action'].'Action';
                if(method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
            //echo '<p>controller: <b>' . $this->params['controller'] . '</b></p>';
            //echo '<p>action: <b>' . $this->params['action'] . '</b></p>';
        } else {
            View::errorCode(403);
        }
        //echo "start";
    }
}