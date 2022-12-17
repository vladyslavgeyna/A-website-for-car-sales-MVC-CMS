<?php

namespace controllers;

use core\Controller;
use models\User;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        if (User::isUserAdmin())
        {
            $data["users_count"] = User::getCountOfUsers();
            return $this->renderAdmin(null, [
                "data" => $data
            ]);
        }
        else
        {
            return $this->render(null, [
                'title' => 'Головна сторінка сайту'
            ]);
        }
    }

    public function errorAction($code = null)
    {
        $viewPath = User::isUserAdmin() ? "views/admin/site/error.php" : "views/site/error.php";
        if(!empty($code))
        {
            switch ($code)
            {
                case 404:
                    return $this->render($viewPath);
                    break;
            }
        }
        else
        {
            return $this->render($viewPath);
        }
    }
}