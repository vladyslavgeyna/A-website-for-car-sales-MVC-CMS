<?php

namespace core;

class Controller
{
    protected string $moduleName;
    protected string $viewPath;
    protected string $actionName;
    public function __construct()
    {
        $this->moduleName = Core::getInstance()->app['moduleName'];
        $this->actionName = Core::getInstance()->app['actionName'];
        $this->viewPath = "views/{$this->moduleName}/{$this->actionName}.php";
    }

    public function redirect($url)
    {
        header("Location: {$url}");
        die();
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

    public function renderByViewName($viewName, $params = null)
    {
        $viewPath = "views/{$this->moduleName}/{$viewName}.php";
        $tpl = new Template($viewPath);
        if (!empty($params))
        {
            $tpl->setParams($params);
        }
        return $tpl->getHTML();
    }
}