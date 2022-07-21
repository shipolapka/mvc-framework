<?php

namespace core;

use core\View;

abstract class Controller {

    public $route;
    public $view;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        //$_SESSION['admin']['id'] = 1;
        if(!$this->checkAcl()) {
            \core\View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'models\\' . ucfirst($name);
        if(class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl()
    {
        $this->acl = require 'acl/' . $this->route['controller'] . '.php';
        if($this->isAcl('all')) {
            return true;
        }
        elseif(isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        }
        elseif(!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
            return true;
        }
        elseif(isset($_SESSION['admin']['id']) and $this->isAcl('admin')) {
            return true;
        }

        return false;
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}