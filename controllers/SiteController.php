<?php

namespace controllers;

use core\Controller;
use models\Carad;
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
            $data = [];
            $data["ads"] = Carad::getAllCarAdsInnered();
            return $this->render("views/carad/index.php", [
                "title" => "Головна сторінка",
                "data" => $data
            ]);
        }
    }

    public function errorAction($code = null)
    {
        $viewPath = User::isUserAdmin() ? "views/admin/site/error-{$code}.php" : "views/site/error-{$code}.php";
        if(!empty($code))
        {
            switch ($code)
            {
                case 404:
                    return $this->render($viewPath);
                    break;
                case 403:
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