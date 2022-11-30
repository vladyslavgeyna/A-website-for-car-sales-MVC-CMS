<?php

namespace core;


class Core
{
    private function __construct()
    {
    }

    private static $instance = null;


    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function initialize()
    {

    }

    public function run()
    {
        $route = $_GET['route'];
        $routeParts = explode('/', $route);
        $moduleName = array_shift($routeParts);
        $actionName = array_shift($routeParts);
        $controllerName = '\\controllers\\'.ucfirst($moduleName).'Controller';
        $controllerActionName = $actionName.'Action';
        $controller = new $controllerName();
        $controller->$controllerActionName();
    }

    public function done()
    {

    }

}