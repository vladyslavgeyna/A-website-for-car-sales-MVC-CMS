<?php

namespace core;

use controllers\SiteController;

class Core
{
    public array $app;
    public DB $db;
    public string $requestMethod;
    public array $pageParams;

    private function __construct()
    {
        global $layoutParams;
        $this->app = [];
        $this->pageParams = $layoutParams;
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
        session_start();
        $this->db = new DB(DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSWORD, DATABASE_BASENAME);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
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
                $this->pageParams['content'] = $controller->$controllerActionName();
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
            $this->pageParams["content"] = $siteController->errorAction($statusCode);
        }
    }

    public function done()
    {
        $pathToLayout = "themes/light/layout.php";
        $tpl = new Template($pathToLayout);
        $tpl->setParams($this->pageParams);
        $html = $tpl->getHTML();
        echo $html;
    }

}