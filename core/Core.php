<?php

namespace core;


use controllers\SiteController;

class Core
{
    public array $app;
    private function __construct()
    {
        $this->app = [];
    }

    private static ?Core $instance = null;


    public static function getInstance(): ?Core
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
        $moduleName = strtolower(array_shift($routeParts));
        $actionName = strtolower(array_shift($routeParts));
        if(empty($moduleName))
        {
            $moduleName = "site";
        }
        if(empty($actionName))
        {
            $actionName = "index";
        }
        $this->app['moduleName'] = $moduleName;
        $this->app['actionName'] = $actionName;
        $controllerName = '\\controllers\\'.ucfirst($moduleName).'Controller';
        $controllerActionName = $actionName.'Action';
        $statusCode = 200;
        if(class_exists($controllerName))
        {
            $controller = new $controllerName();
            if(method_exists($controller, $controllerActionName))
            {
                $this->app['actionResult'] = $controller->$controllerActionName();
            }
            else
            {
                $statusCode = 404;
            }
        }
        else
        {
            $statusCode = 404;
        }
        $statusCodeType = intval($statusCode / 100);
        if($statusCodeType == 4 || $statusCodeType == 5)
        {
            $siteController = new SiteController();
            $siteController->errorAction($statusCode);
        }
    }

    public function done()
    {
        $pathToLayout = "themes/light/layout.php";
        $tpl = new Template($pathToLayout);
        $tpl->setParam('content', $this->app['actionResult']);
        $html = $tpl->getHTML();
        echo $html;
    }

}