<?php

namespace core;

class Controller
{
    protected string $viewPath;
    public function __construct()
    {
        $moduleName = Core::getInstance()->app['moduleName'];
        $actionName = Core::getInstance()->app['actionName'];
        $this->viewPath = "views/{$moduleName}/{$actionName}.php";
    }

    public function render($viewPath = null, $params = null)
    {
        if(empty($viewPath))
        {
            $viewPath = $this->viewPath;
        }
        $tpl = new Template($viewPath);
        if(!empty($params))
        {
            $tpl->setParams($params);
        }
        return $tpl->getHTML();
    }
}